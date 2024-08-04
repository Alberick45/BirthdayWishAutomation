<?php
require("config.php");
session_start();

$userid = $_SESSION['user id'];


function deleteMessage($mbody) {
    global $conn ;
    $sql = "DELETE FROM messages WHERE m_body= ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("s",$mbody);
    $stmt -> execute();
    
    if ($stmt ->affected_rows > 0) {
        echo "Message deleted successfully";
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
/* if (isset($_POST['contactlist'])) {
    if ($_POST['contactlist'] === "Add") {
        addContact();
        exit();
    } elseif ($_POST['contactlist'] === "Update"){
            updateContact();
            exit();
        
    } else {
        echo "Invalid function call: " . $_POST['contactlist'];
    }
} else {
    echo "Form submission error.";
} */


if (isset($_GET["action"])) {
    
    if (isset($_GET['mbody']) && $_GET["action"] === "delete") {
        $mbody = htmlspecialchars($_GET['mbody']);
        deleteMessage($mbody);
        exit();
    }
}

