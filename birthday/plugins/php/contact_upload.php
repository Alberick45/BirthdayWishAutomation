<?php
/* Here we receive the CSV file and process it into a dictionary format using fetch_assoc.
   We retrieve the first name, last name, DOB, country code (default is +233), 
   phone number (removing the first 0), and randomly assign a message with type
   as either important, special, or love.
*/
require("config.php");
session_start();
if (!isset($_SESSION['user id'])) {
    header("Location: ../../index.html");
    echo "You are not logged in";
    exit();
} 
else {
    $user_id = $_SESSION['user id'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['contact_file']) && isset($_POST['c_stat'])) {
    $contact_status = $_POST['c_stat'];
    $contact_file = $_FILES['contact_file'];

    // Check if the file is uploaded without errors
    if ($contact_file['error'] == 0) {
        $contact_file_path = $contact_file['tmp_name'];

        // Validate file type
        $file_ext = pathinfo($contact_file['name'], PATHINFO_EXTENSION);
        if ($file_ext !== 'csv') {
            die("Invalid file type. Please upload a CSV file.");
        }
        
        // Open the CSV file
        if (($handle = fopen($contact_file_path, "r")) !== FALSE) {
            
            // Get the first row (header) and validate column count and header names
            $headers = fgetcsv($handle, 1000, ",");
            

            // Check if the CSV has exactly 5 columns
            if (count($headers) == 4) {
                $expected_headers = ['First Name', 'Last Name', 'DOB', 'Phone Number'];
                        // Check if the CSV has exactly 5 columns
                    // if (count($headers) == 4) {
                       
                    // Check if the headers match the expected headers
                    if ($headers !== $expected_headers) {
                        die("Invalid CSV format. The file headers must be: 'First Name', 'Last Name', 'DOB',  'Phone Number'.");
                    }

                    // Retrieve all message IDs from the messages table
                    /* $message_ids = [];
                    $result = $conn->query("SELECT m_id FROM messages");
                    while ($row = $result->fetch_assoc()) {
                        $message_ids[] = $row['m_id'];
                    }

                    // Check if there are any message IDs available
                    if (empty($message_ids)) {
                        die("No messages available to assign.");
                    }
 */
                    // Loop through the CSV rows
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $firstname = $conn->real_escape_string($data[0]);
                        $lastname = $conn->real_escape_string($data[1]);
                        $dateOfBirth = $conn->real_escape_string($data[2]);
                        $contactNumber = $conn->real_escape_string($data[3]);
                        
                        // Remove leading zero from phone number
                        if (substr($contactNumber, 0, 1) === '0') {
                            $contactNumber = substr($contactNumber, 1);
                        }


                        // Convert the date format from MM/DD/YYYY to YYYY-MM-DD
                        $dob = DateTime::createFromFormat('m/d/Y', $dateOfBirth);
                        if ($dob) {
                            $dateOfBirth = $dob->format('Y-m-d');
                        } else {
                            die("Invalid date format for DOB: $dateOfBirth. Please use MM/DD/YYYY.");
                        }

                        
                        // Default country code to +233 if none provided
                        $countrycode =  '+233' ;


                        // Randomly assign a message ID from the list
                        // $random_message_id = $message_ids[array_rand($message_ids)];

                        // Insert the data into the contacts table
                        $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_status, c_ruid, m_stat) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
                        $stmt = $conn->stmt_init();
                        if ($stmt->prepare($sql)) {
                            $stmt->bind_param('ssssssi', $firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber, $contact_status, $user_id);
                            if ($stmt->execute()) {
                                $_SESSION['message'] = "Contact added successfully";
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        } else {
                            echo "Error preparing statement: " . $conn->error;
                        }
                    }
                    /* } */
            }
            if (count($headers) == 5) {

            $expected_headers = ['First Name', 'Last Name', 'DOB', 'Country Code', 'Phone Number'];
            // Check if the headers match the expected headers
            if ($headers !== $expected_headers) {
                die("Invalid CSV format. The file headers must be: 'First Name', 'Last Name', 'DOB', 'Country Code', 'Phone Number'.");
            }

            // Retrieve all message IDs from the messages table
            // $message_ids = [];
            // $result = $conn->query("SELECT m_id FROM messages");
            // while ($row = $result->fetch_assoc()) {
            //     $message_ids[] = $row['m_id'];
            // }

            // // Check if there are any message IDs available
            // if (empty($message_ids)) {
            //     die("No messages available to assign.");
            // }

            // Loop through the CSV rows
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $firstname = $conn->real_escape_string($data[0]);
                $lastname = $conn->real_escape_string($data[1]);
                $dateOfBirth = $conn->real_escape_string($data[2]);
                $countrycode = $conn->real_escape_string($data[3]);
                $contactNumber = $conn->real_escape_string($data[4]);
                
                // Remove leading zero from phone number
                if (substr($contactNumber, 0, 1) === '0') {
                    $contactNumber = substr($contactNumber, 1);
                }


                // Convert the date format from MM/DD/YYYY to YYYY-MM-DD
                $dob = DateTime::createFromFormat('m/d/Y', $dateOfBirth);
                if ($dob) {
                    $dateOfBirth = $dob->format('Y-m-d');
                } else {
                    die("Invalid date format for DOB: $dateOfBirth. Please use MM/DD/YYYY.");
                }

                // Default country code to +233 if none provided
                $countrycode = empty($countrycode) ? '+233' : $countrycode;


                // Randomly assign a message ID from the list
                // $random_message_id = $message_ids[array_rand($message_ids)];

                // Insert the data into the contacts table
                $sql = "INSERT INTO contacts (cf_name, cl_name, c_dob, c_cntcode, c_pnum, c_status, c_ruid, m_stat) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
                $stmt = $conn->stmt_init();
                if ($stmt->prepare($sql)) {
                    $stmt->bind_param('ssssssi', $firstname, $lastname, $dateOfBirth, $countrycode, $contactNumber, $contact_status, $user_id);
                    if ($stmt->execute()) {
                        $_SESSION['message'] = "Contact added successfully";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
            }}

            // Close the file and database connection
            fclose($handle);
            $conn->close();

            echo "CSV file data successfully imported!";
            header('Location: ../../admin_contacts.php?message=CSV file data successfully imported!');
        } else {
            echo "Error opening the file.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file was uploaded.";
}
}
exit();
?>
