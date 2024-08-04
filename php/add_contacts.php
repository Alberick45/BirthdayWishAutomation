<?php
require("config.php");
session_start();

$userid = $_SESSION['user id'];
function addContact() {
    global $conn ;
    global $userid;
    if (isset($_POST['cfname'],$_POST['clname'],$_POST['cdob'],$_POST['ccntcd'],$_POST['cphone'],$_POST['cmsgid'])){
            $firstname = $_POST['cfname'];
            $lastname = $_POST['clname'];
            $dateOfBirth = $_POST['cdob'];
            $countrycode = $_POST['ccntcd'];
            $contactNumber = $_POST['cphone'];
            $messageid = $_POST['cmsgid'];

            /* sanitizing the inputs */
            $firstname = $conn -> real_escape_string($firstname);
            $lastname = $conn -> real_escape_string($lastname);
            $dateOfBirth = $conn -> real_escape_string($dateOfBirth);
            $countrycode = $conn -> real_escape_string($countrycode);
            $contactNumber = $conn -> real_escape_string($contactNumber);
            $messageid = $conn -> real_escape_string($messageid);
            $userid = $conn -> real_escape_string($userid);


            $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum,  c_mid, c_ruid) VALUES (?, ?, ?, ?, ?,?,?)";
            $stmt = $conn -> stmt_init();
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param('ssssiii',$firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber,$messageid,$userid);
            $stmt -> execute();
            
            if ($stmt-> affected_rows > 0) {
                echo "Contact added successfully";
                header('Location: user_account.php');
            } else {
                echo "Error adding contact: " . $conn -> error;
            }
    }
    $stmt -> close();
    $conn -> close();
}

function deleteContact($contactNumber) {
    global $conn ;
    $sql = "DELETE FROM contacts WHERE contact_pn_number = ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("i",$contactNumber);
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

function updateContact($firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber,$messageid) {
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

/* Function calls */


