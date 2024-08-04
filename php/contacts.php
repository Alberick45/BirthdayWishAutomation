<?php
require("config.php");
session_start();

$userid = $_SESSION['user id'];
function addContact() {
    global $conn, $userid;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['cfname'], $_POST['clname'], $_POST['cdob'], $_POST['ccntcd'], $_POST['cphone'], $_POST['cmsgid'])) {
            $firstname = $conn->real_escape_string($_POST['cfname']);
            $lastname = $conn->real_escape_string($_POST['clname']);
            $dateOfBirth = $conn->real_escape_string($_POST['cdob']);
            $countrycode = $conn->real_escape_string($_POST['ccntcd']);
            $contactNumber = $conn->real_escape_string($_POST['cphone']);
            $messageid = $conn->real_escape_string($_POST['cmsgid']);

            $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_mid, c_ruid) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->stmt_init();
            if ($stmt->prepare($sql)) {
                $stmt->bind_param('ssssiii', $firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber, $messageid, $userid);
                if ($stmt->execute()) {
                    echo "Contact added successfully";
                    header('Location: user_account.php');
                    exit();
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "Please fill all fields.";
        }
    }
    $conn->close();
}

function deleteContact($cid) {
    global $conn ;
    $sql = "DELETE FROM contacts WHERE c_id= ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("i",$cid);
    $stmt -> execute();
    
    if ($stmt ->affected_rows > 0) {
        echo "Contact deleted successfully";
        header('Location: user_account.php');
    } else {
        echo "Error deleting contact: " . $conn -> error;
    }
    
    $stmt -> close();
    $conn -> close();
}

/* function updateContact($firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber,$messageid) {
    global $conn ;
    global $userid;
    $sql = "UPDATE contacts SET first_name = ?,last_name = ?, dob = ?, countcode = ? , c_mid = ?, c_ruid = ? WHERE phone =?";
    $stmt =$conn -> stmt_init();
    $stmt -> prepare($sql);
    $stmt -> bind_param('ssssiii',$firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber,$messageid,$userid);
    $stmt -> execute();

    if($stmt -> affected_rows >0){
        echo 'updated successfully';
        header('Location: user_account.php');
    }else{
        echo 'error updating info'. $conn -> error;
    }
    

    $stmt -> close();
    $conn -> close();
}
 */
/* Function calls */
if (isset($_POST['contactlist'])) {
    if ($_POST['contactlist'] === "Add") {
        addContact();
        exit();
    } /* elseif ($_POST['contactlist'] === "Update"){
            updateContact();
            exit();
        
    } */ else {
        echo "Invalid function call: " . $_POST['contactlist'];
    }
} else {
    echo "Form submission error.";
}


if (isset($_GET["action"])) {
    
    if (isset($_GET['cid']) && $_GET["action"] === "delete") {
        $contact = htmlspecialchars($_GET['cid']);
        deleteContact($contact);
        exit();
    }
}

