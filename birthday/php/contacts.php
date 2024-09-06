<?php
require("config.php");
session_start();

if (!isset($_SESSION['user id'])) {
    header("Location: ../index.php");
    echo "You are not logged in";
    exit();
} 
else {

$userid = $_SESSION['user id'];
function addContact() {
    global $conn, $userid;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['cfname'], $_POST['clname'], $_POST['cdob'], $_POST['ccntcd'], $_POST['cphone'])) {
            $firstname = $conn->real_escape_string($_POST['cfname']);
            $lastname = $conn->real_escape_string($_POST['clname']);
            $dateOfBirth = $conn->real_escape_string($_POST['cdob']);
            $countrycode = $conn->real_escape_string($_POST['ccntcd']);
            $contactNumber = $conn->real_escape_string($_POST['cphone']);
            // $messageid = $conn->real_escape_string($_POST['cmsgid']);
            $message_ids = [];
            $result = $conn->query("SELECT m_id FROM messages");
            while ($row = $result->fetch_assoc()) {
                $message_ids[] = $row['m_id'];
            }
            $data = "fname=".$firstname."&lname=".$lastname."&dob=".$dateOfBirth."&cntcd=".$countrycode."&cphone=".$contactNumber ;

            // Check if there are any message IDs available
            if (empty($message_ids)) {
                die("No messages available to assign.");
            }

            $random_message_id = $message_ids[array_rand($message_ids)];
            if (strlen($contactNumber ) != 10) {
                // User already exists 
                // echo "<script>
                //         alert('Username already taken');
                //         window.location.href = '../index.php';
                //       </script>";
                $em = "Phone number must be 10 digits starting from 0";
                header("Location: user_account.php?error=$em&$data");
                exit;
            }
            
                $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_mid, c_ruid) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->stmt_init();
                if ($stmt->prepare($sql)) {
                    $stmt->bind_param('ssssiii', $firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber, $random_message_id, $userid);
                    if ($stmt->execute()) {
                        $em = "Contact added successfully";
                        header("Location: user_account.php?success=$em&$data");
                        exit;// Set session variable for success message
                        $_SESSION['message'] = "Contact added successfully";
                        // header('Location: user_account.php');
                        // exit();
                    } else {
                        $em ="Error executing statement: " . $stmt->error;
                        header("Location: user_account.php?success=$em&$data");
                        exit;
                        $_SESSION['message'] =  "Error executing statement: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $em ="Error preparing statement: " . $conn->error;
                    header("Location: user_account.php?success=$em&$data");
                    exit;
                    $_SESSION['message'] =  "Error preparing statement: " . $conn->error;
                }
        } else {
            $em ="Please fill all fields.";
            header("Location: user_account.php?success=$em&$data");
            exit;
            $_SESSION['message'] =  "Please fill all fields.";
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
        // Set session variable for success message
        $_SESSION['message'] = "Contact deleted successfully";
        header('Location: user_account.php');
        exit();
    } else {
        $_SESSION['message'] =  "Error deleting contact: " . $conn -> error;
    }
    
    $stmt -> close();
    $conn -> close();
}

function updateContact() {
    global $conn, $userid;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['u_cfname'], $_POST['u_clname'], $_POST['u_cdob'], $_POST['u_ccntcd'], $_POST['u_cphone'], $_POST['ucid'])) {
            $updated_firstname = $conn->real_escape_string($_POST['u_cfname']);
            $updated_lastname = $conn->real_escape_string($_POST['u_clname']);
            $updated_dateOfBirth = $conn->real_escape_string($_POST['u_cdob']);
            $updated_countrycode = $conn->real_escape_string($_POST['u_ccntcd']);
            $updated_contactNumber = $conn->real_escape_string($_POST['u_cphone']);
            // $updated_messageid = $conn->real_escape_string($_POST['u_cmsgid']);
            $conid = $conn->real_escape_string($_POST['ucid']);
            $message_ids = [];
            $result = $conn->query("SELECT m_id FROM messages");
            while ($row = $result->fetch_assoc()) {
                $message_ids[] = $row['m_id'];
            }
            $data = "u_cfname=".$firstname."&u_clname=".$lastname."&u_cdob=".$dateOfBirth."&u_ccntcd=".$countrycode."&u_cphone=".$contactNumber ;
            // Check if there are any message IDs available
            if (empty($message_ids)) {
                die("No messages available to assign.");
            }
            if (strlen($updated_contactNumber ) != 10) {
                // User already exists 
                // echo "<script>
                //         alert('Username already taken');
                //         window.location.href = '../index.php';
                //       </script>";
                $em = "Phone number must be 10 digits starting from 0";
                header("Location: user_account.php?error=$em&$data");
                exit;
            }
            $random_message_id = $message_ids[array_rand($message_ids)];

            $sql = "UPDATE contacts SET cf_name = ?,cl_name = ?, c_dob = ?, c_cntcode = ? , c_pnum =?, c_mid = ?, c_ruid = ? WHERE c_id = ?";
            $stmt =$conn -> stmt_init();
            
            if ($stmt->prepare($sql)) {
                $stmt->bind_param('ssssiiii', $updated_firstname, $updated_lastname, $updated_dateOfBirth, $updated_countrycode, $updated_contactNumber, $random_message_id, $userid,$conid);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Contact updated successfully";
                    $em = "Phone number must be 10 digits starting from 0";
                    header("Location: user_account.php?success=$em&$data");
                    exit;
                } else {
                    $em =  "Error executing statement: " . $stmt->error;
                    header("Location: user_account.php?error=$em&$data");
                    $_SESSION['message'] =  "Error executing statement: " . $stmt->error;
                    exit;
                
                }
                $stmt->close();
            } else {
                $em =  "Error preparing statement: " . $conn->error;
                    header("Location: user_account.php?error=$em&$data");
                    $_SESSION['message'] =   "Error preparing statement: " . $conn->error;
            }
        } else {
            $em =  "Please fill all fields.";
            header("Location: user_account.php?error=$em&$data");
            $_SESSION['message'] =  "Please fill all fields.";
        }
    }
    $conn->close();
}
    
   


/* Function calls */
if (isset($_POST['contactlist'])) {
    if ($_POST['contactlist'] === "Add") {
        addContact();
        exit();
    } elseif ($_POST['contactlist'] === "Update"){
            updateContact();
            exit();
        
    } 
    else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['contactlist'];
        header('Location: user_account.php');
        
    }
} 

elseif (isset($_POST['delete_contact'])){
    $mid = $_POST['contact_id'];
    $sql = "DELETE FROM contacts WHERE c_id= ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("i",$mid);
    $stmt -> execute();
    
    if ($stmt ->affected_rows > 0) {
        $_SESSION['message'] = "Message deleted successfully";
        header('refresh:1 user_account.php'); // Redirect to a specific page after updating
        exit();
    } else {
        $_SESSION['message'] =  "Error deleting message: " . $conn -> error;
        header('refresh:1 user_account.php'); // Redirect to a specific page after updating
        exit();
    }
    
    $stmt -> close();
    $conn -> close();
}

else {
   $_SESSION['message'] =  "Form submission error.";
   header('Location: user_account.php');
}
}

// if (isset($_GET["action"])) {
    
//     if (isset($_GET['cid']) && $_GET["action"] === "delete") {
//         $contact = htmlspecialchars($_GET['cid']);
//         deleteContact($contact);
//         exit();
//     }else {
//         $_SESSION['message'] =  "Invalid function call: " . $_POST['contactlist'];
//     }
// } else {
//    $_SESSION['message'] =  "Form submission error.";
// }

