<?php
session_start();
$user_id = $_SESSION['user id'];
require("config.php");

if (isset($_GET['new_message']) && !empty($_GET['new_message'])) {
    $new_message = htmlspecialchars($_GET['new_message']); // Ensure this is properly sanitized
    $userid = ''; // Retrieve the current user ID
    
    $sql_insert = "INSERT INTO messages (m_body, m_type, m_ruid) VALUES ('$new_message', 'custom', '$user_id')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "New message added successfully";
        // Redirect back to your form or a success page
        header("Location: your_form_page.php");
        exit();
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "No message provided.";
}