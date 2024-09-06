<?php
require("config.php");
function deleteuser($userid){
    global $conn;
    // Get the user ID from the URL
    $userid = $_GET['userid'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM registered_users WHERE ru_id = ?");
    $stmt->bind_param("i", $userid);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: ../admin_users.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    }



    function deleteMessage($mid) {
        global $conn ;
        $sql = "DELETE FROM messages WHERE m_id= ?";
        $stmt = $conn -> stmt_init();
        $stmt ->prepare($sql);
        $stmt -> bind_param("i",$mid);
        $stmt -> execute();
        
        if ($stmt ->affected_rows > 0) {
            $_SESSION['message'] = "Message deleted successfully";
            header('refresh:1 ../admin_messages.php'); // Redirect to a specific page after updating
            exit();
        } else {
            $_SESSION['message'] =  "Error deleting message: " . $conn -> error;
            header('refresh:1 ../admin_messages.php'); // Redirect to a specific page after updating
            exit();
        }
        
        $stmt -> close();
        $conn -> close();
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
            header('Location: ../admin_contacts.php');
            exit();
        } else {
            $_SESSION['message'] =  "Error deleting contact: " . $conn -> error;
        }
        
        $stmt -> close();
        $conn -> close();
    }
// Main code


if (isset($_GET["action"])) {
    
    if (isset($_GET['userid']) && $_GET["action"] === "deleteuser") {
        $userid = htmlspecialchars($_GET['userid']);
        deleteuser($userid);
        exit();
    } elseif (isset($_GET['msgid']) && $_GET["action"] === "deletemsg") {
        $messageid = htmlspecialchars($_GET['msgid']);
        deleteMessage($messageid);
        exit();
    } elseif (isset($_GET['cid']) && $_GET["action"] === "deletecontact") {
        $contactid = htmlspecialchars($_GET['cid']);
        deleteContact($contactid);
        exit();
    }
    
}
// Close connection
$conn->close();

