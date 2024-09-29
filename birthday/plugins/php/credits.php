<?php
require("config.php");
session_start();

if (!isset($_SESSION['user id'])) {
    header("Location: ../../index.php");
    echo "You are not logged in";
    exit();
} 
else {

$userid = $_SESSION['user id'];
function addsms() {
    global $conn, $userid;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['num_of_credits'], $_POST['price'])) {
            $num_of_credits = $conn->real_escape_string($_POST['num_of_credits']);
            $price = $conn->real_escape_string($_POST['price']);
            

            // $data = "fname=".$firstname."&lname=".$lastname."&dob=".$dateOfBirth."&cntcd=".$countrycode."&cphone=".$smsNumber ;

                $sql = "INSERT INTO sms (num_of_credits, price) VALUES (?, ?)";
                $stmt = $conn->stmt_init();
                if ($stmt->prepare($sql)) {
                    $stmt->bind_param('id', $num_of_credits, $price);
                    if ($stmt->execute()) {
                        $_SESSION['message'] = "sms added successfully";
                        $em = "sms added successfully";
                        header("Location: ../../admin_sms.php?success=".urlencode($_SESSION['message'])."");
                        exit;// Set session variable for success message
                        
                        // header('Location: ../../admin_sms.php');
                        // exit();
                    } else {
                        $_SESSION['message'] =  "Error executing statement: " . $stmt->error;
                        $em ="Error executing statement: " . $stmt->error;
                        header("Location: ../../admin_sms.php?success=".urlencode($_SESSION['message'])."");
                        exit;
                        
                    }
                    
                } else {
                    $em ="Error preparing statement: " . $conn->error;
                    $_SESSION['message'] =  "Error preparing statement: " . $conn->error;
                    header("Location: ../../admin_sms.php?success=".urlencode($_SESSION['message'])."");
                }
                $stmt->close();
                exit;
        } else {
            $em ="Please fill all fields.";
            $_SESSION['message'] =  "Please fill all fields.";
            header("Location: ../../admin_sms.php?success= Please fill all fields.");
            exit;
        }
        
    }
    
    $conn->close();
}


function deletesms($smsid) {
    global $conn ;
    $sql = "DELETE FROM sms WHERE sms_id= ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("i",$smsid);
    $stmt -> execute();
    
    
    if ($stmt ->affected_rows > 0) {
        // Set session variable for success message
        $_SESSION['message'] = "sms package deleted successfully";
        header('Location: ../../admin_sms.php');
        exit();
    } else {
        $_SESSION['message'] =  "Error deleting sms: " . $conn -> error;
    }
    
    $stmt -> close();
    $conn -> close();
}


/* Function calls */
if (isset($_POST['smslist'])) {
    if ($_POST['smslist'] === "Add") {
        addsms();
        exit();
    } 
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['smslist'];
        header('Location: ../../admin_sms.php');
        
    }
} 

elseif (isset($_GET['action']) && $_GET['action'] == 'delete_sms') {
    // Get the SMS ID from the URL
    $smsid = $_GET['sms_id'];
    
    // Call the function to delete the SMS
    deletesms($smsid);
    
    // Exit the script after the deletion
    exit();

}

else {
   $_SESSION['message'] =  "Form submission error.";
   header('Location: ../../admin_sms.php');
}
}


