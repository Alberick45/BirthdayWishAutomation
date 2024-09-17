<?php
require("config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['message_file'])) {
    $message_file = $_FILES['message_file'];

    // Check if the file is uploaded without errors
    if ($message_file['error'] == 0) {
        $message_file_path = $message_file['tmp_name'];

        // Validate file type
        $file_ext = pathinfo($message_file['name'], PATHINFO_EXTENSION);
        if ($file_ext !== 'csv') {
            die("Invalid file type. Please upload a CSV file.");
        }

        // Open the CSV file
        if (($handle = fopen($message_file_path, "r")) !== FALSE) {
            
            // Get the first row (header) and validate column count and header name
            $headers = fgetcsv($handle, 1000, ",");
            $expected_header = ['Message Body'];

            // Check if the CSV has exactly 1 column
            if (count($headers) !== 1) {
                die("Invalid CSV format. The file must have exactly 1 column.");
            }

            // Check if the header matches the expected header
            if ($headers !== $expected_header) {
                die("Invalid CSV format. The file header must be: 'Message Body'.");
            }

            // Loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $message_body = $conn->real_escape_string($data[0]);
                $user_id = $_SESSION['user id']; // Assuming user ID is stored in session
                $message_type = ''; // This will be randomly assigned

                // Randomly assign a message type
                $message_types = ["special", "sample", "love", "important"];
                $random_key = array_rand($message_types);
                $message_type = $message_types[$random_key];

                // Format the message body (if needed)

                // Insert the data into the messages table
                $query = "INSERT INTO messages (m_body, m_ruid, m_type) VALUES ('$message_body', '$user_id', '$message_type')";

                // Execute the query
                if (!$conn->query($query)) {
                    echo "Error: " . $conn->error;
                }
            }

            // Close the file and database connection
            fclose($handle);
            $conn->close();

            echo "CSV file data successfully imported!";
            header('Location: ../../admin_messages.php?CSV file data successfully imported!');
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file was uploaded.";
}

exit();
?>
