<?php
require("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_message']) && !empty($_POST['new_message'])) {
        $new_message = $_POST['new_message'];

        $stmt = $conn->prepare("INSERT INTO messages (m_body,m_ruid,m_type) VALUES (?,?,'custom')");
        $stmt->bind_param("si", $new_message,$_SESSION['user id']);

        if ($stmt->execute()) {
            $_SESSION['message'] = "New message added successfully";
            header("Location: user_account.php"); // Redirect back to the form page
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] =  "No message provided.";
        header("refresh:2 user_account.php"); // Redirect back to the form page
    }
}

$conn->close();

exit();
?>
