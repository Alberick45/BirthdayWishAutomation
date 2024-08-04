<?php
require("config.php");
session_start();

$userid = $_SESSION['user id'];


function deleteMessage($mid) {
    global $conn ;
    $sql = "DELETE FROM messages WHERE m_id= ?";
    $stmt = $conn -> stmt_init();
    $stmt ->prepare($sql);
    $stmt -> bind_param("i",$mid);
    $stmt -> execute();
    
    if ($stmt ->affected_rows > 0) {
        echo "Message deleted successfully";
        header('Location: user_account.php');
    } else {
        echo "Error deleting message: " . $conn -> error;
    }
    
    $stmt -> close();
    $conn -> close();
}


function updateMessage(){
    global $conn;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Update_message'])) {
            $updatedMessage = $conn->real_escape_string($_POST['changed_message']);
            $umsgid = $conn->real_escape_string($_POST['umsgid']);

            $sql_update = "UPDATE messages SET m_body = ? WHERE m_id = ?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param('si', $updatedMessage, $umsgid);

            if ($stmt->execute()) {
                echo "Message updated successfully";
                header('Location: user_account.php'); // Redirect to a specific page after updating
                exit();
            } else {
                echo "Error updating message: " . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }}



/* Function calls */
 if (isset($_POST['updatemessage'])) {
    if ($_POST['updatemessage'] === "Update") {
        updateMessage();
        exit();
    } else {
        echo "Invalid function call: " . $_POST['updatemessage'];
    }
} else {
    echo "Form submission error.";
} 


if (isset($_GET["action"])) {
    
    if (isset($_GET['mid']) && $_GET["action"] === "delete") {
        $mid = htmlspecialchars($_GET['mid']);
        deleteMessage($mid);
        exit();
    }
}

?>