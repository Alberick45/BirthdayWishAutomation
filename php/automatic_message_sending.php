
<?php
require("config.php");


// Initialize variables
$recipient_name = "";
$recipient_dob = "";
$recipient_phone = "";
$recipient_age = 0;
$message = "";
$recipients = [];

// Fetch contacts whose date of birth matches today's day and month
$sql = "SELECT cf_name, c_ruid, cl_name, c_dob, c_mid, CONCAT(c_cntcode, c_pnum) AS phone 
        FROM contacts 
        WHERE MONTH(c_dob) = MONTH(CURDATE()) AND DAY(c_dob) = DAY(CURDATE())";

$recipient_result = $conn->query($sql);

if ($recipient_result && $recipient_result->num_rows > 0) {
    while ($recipient_row = $recipient_result->fetch_assoc()) {
        $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
        $recipient_dob = $recipient_row['c_dob'];
        $recipient_phone = $recipient_row['phone'];
        $registererid = $recipient_row['c_ruid'];
        $recipient_messageid = $recipient_row['c_mid'];

        // Fetch the message creator using registererid
        $stmt = $conn->prepare("SELECT ruf_name FROM registered_users WHERE ru_id = ?");
        $stmt->bind_param("i", $registererid);
        $stmt->execute();
        $usr_result = $stmt->get_result();
        if ($usr_result && $usr_result->num_rows > 0) {
            $usr_row = $usr_result->fetch_assoc();
            $sender = $usr_row['ruf_name'];
        }
        $stmt->close();

        // Fetch the message body using message_id
        $stmt = $conn->prepare("SELECT m_body FROM messages WHERE m_id = ?");
        $stmt->bind_param("i", $recipient_messageid);
        $stmt->execute();
        $msg_result = $stmt->get_result();
        $msg_body = "";
        if ($msg_result && $msg_result->num_rows > 0) {
            $msg_row = $msg_result->fetch_assoc();
            $msg_body = $msg_row['m_body'];
        }
        $stmt->close();

        // Calculate recipient's age using DateTime
        if ($recipient_dob) {
            $dob = new DateTime($recipient_dob);
            $now = new DateTime();
            $recipient_age = $now->diff($dob)->y;
        }

        // Replace placeholders with actual values in the message
        $personalized_message = str_ireplace("[Name]", htmlspecialchars($recipient_name), $msg_body);
        $personalized_message = str_ireplace("[Age]", htmlspecialchars($recipient_age), $personalized_message);
        $personalized_message = str_ireplace("[Your Name]", htmlspecialchars($sender), $personalized_message);

        // Display the final message
        echo htmlspecialchars($personalized_message) . "<br>";
        echo htmlspecialchars($recipient_phone) . "<br>";

        // Optionally, store each recipient's message
        $recipients[] = [
            'name' => $recipient_name,
            'phone' => $recipient_phone,
            'message' => $personalized_message
        ];



                // using Mnotify credentials
                // API Key and Endpoint
                $apiKey = '1Tr9eN1Sxjo2BZvwbKByue5QL'; // Replace with your actual API key
                $apiUrl = 'https://apps.mnotify.net/smsapi'; // Endpoint URL
                
                // Message details
                $recipient = $recipient_phone; // Replace with the recipient's phone number
                $message = $personalized_message;
                $senderId = 'Bdaywishers'; // Optional: Replace with your sender ID if required
                
                // Prepare the URL with query parameters
                $url = $apiUrl . '?key=' . $apiKey . '&to=' . urlencode($recipient) . '&msg=' . urlencode($message) . '&sender_id=' . urlencode($senderId);
                
                // Initialize cURL
                $ch = curl_init();
                
                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                // Execute the request and get the response
                $response = curl_exec($ch);
                
                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL error: ' . curl_error($ch);
                } else {
                    echo 'Response: ' . $response;
                }
                
                // Close cURL
                curl_close($ch);
                    
            }
        } else {
                echo "No contacts have a birthday today.";
            }



?>
