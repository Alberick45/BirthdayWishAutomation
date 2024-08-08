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
                    // Set session variable for success message
                    $_SESSION['message'] = "Contact added successfully";
                    header('Location: user_account.php');
                    exit();
                } else {
                    $_SESSION['message'] =  "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['message'] =  "Error preparing statement: " . $conn->error;
            }
        } else {
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
        if (isset($_POST['u_cfname'], $_POST['u_clname'], $_POST['u_cdob'], $_POST['u_ccntcd'], $_POST['u_cphone'], $_POST['u_cmsgid'], $_POST['ucid'])) {
            $updated_firstname = $conn->real_escape_string($_POST['u_cfname']);
            $updated_lastname = $conn->real_escape_string($_POST['u_clname']);
            $updated_dateOfBirth = $conn->real_escape_string($_POST['u_cdob']);
            $updated_countrycode = $conn->real_escape_string($_POST['u_ccntcd']);
            $updated_contactNumber = $conn->real_escape_string($_POST['u_cphone']);
            $updated_messageid = $conn->real_escape_string($_POST['u_cmsgid']);
            $conid = $conn->real_escape_string($_POST['ucid']);
            
            $sql = "UPDATE contacts SET cf_name = ?,cl_name = ?, c_dob = ?, c_cntcode = ? , c_pnum =?, c_mid = ?, c_ruid = ? WHERE c_id = ?";
            $stmt =$conn -> stmt_init();
            
            if ($stmt->prepare($sql)) {
                $stmt->bind_param('ssssiiii', $updated_firstname, $updated_lastname, $updated_dateOfBirth, $updated_countrycode, $updated_contactNumber, $updated_messageid, $userid,$conid);
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Contact updated successfully";
                    header('Location: user_account.php');
                    exit();
                } else {
                    $_SESSION['message'] =  "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['message'] =  "Error preparing statement: " . $conn->error;
            }
        } else {
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
        
    } else {
        $_SESSION['message'] =  "Invalid function call: " . $_POST['contactlist'];
    }
} else {
   $_SESSION['message'] =  "Form submission error.";
}


if (isset($_GET["action"])) {
    
    if (isset($_GET['cid']) && $_GET["action"] === "delete") {
        $contact = htmlspecialchars($_GET['cid']);
        deleteContact($contact);
        exit();
    }
}

