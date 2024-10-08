
<?php
require("config.php");

// Initialize variables
$recipient_name = "";
$recipient_dob = "";
$recipient_phone = "";
$recipient_age = 0;
$message = "";
$recipients = [];


/* $message_ids = [];
            $result = $conn->query("SELECT m_id FROM messages");
            while ($row = $result->fetch_assoc()) {
                $message_ids[] = $row['m_id'];
            }
            
            // Check if there are any message IDs available
            if (empty($message_ids)) {
                die("No messages available to assign.");
            }

            $random_message_id = $message_ids[array_rand($message_ids)]; */



// Fetch contacts whose date of birth matches today's day and month
$sql = "SELECT *, CONCAT(c_cntcode, c_pnum) AS phone 
        FROM contacts 
        WHERE MONTH(c_dob) = MONTH(CURDATE()) AND DAY(c_dob) = DAY(CURDATE()) AND m_stat = 0";

$recipient_result = $conn->query($sql);

if ($recipient_result && $recipient_result->num_rows > 0) {
    while ($recipient_row = $recipient_result->fetch_assoc()) {
        $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
        $recipient_dob = $recipient_row['c_dob'];
        $recipient_id = $recipient_row['c_id'];
        $recipient_phone = $recipient_row['phone'];
        $registererid = $recipient_row['c_ruid'];
        // $recipient_messageid = $recipient_row['c_mid'];

        /* randomisation */
        $message_ids = [];
            $result = $conn->query("SELECT m_id FROM messages");
            while ($row = $result->fetch_assoc()) {
                $message_ids[] = $row['m_id'];
            }
            
            // Check if there are any message IDs available
            if (empty($message_ids)) {
                die("No messages available to assign.");
            }

            $random_message_id = $message_ids[array_rand($message_ids)];
            /* End of randmisation */
            
            $recipient_messageid = $random_message_id;
        // if($recipient_row['c_mid'] != NULL){$recipient_messageid = $recipient_row['c_mid'];} else{$recipient_messageid = $random_message_id;}

        $message_status = $recipient_row['m_stat'];
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
            $msg_body = $msg_row['m_body'].' visit us: http://localhost/final/birthday/index.php';
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

        // added what is below to bypass ssl verification error code - cURL error: SSL certificate problem: unable to get local issuer certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // end of addition

        
        // Execute the request and get the response
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo '<p>cURL error: ' . curl_error($ch).'</p>';
            header('refresh:10 automatic_message_sending.php'); 
        } 
        else {
            echo '<p>Response: ' . $response.'</p>';
            $sql = "UPDATE contacts set m_stat = 1 where c_id = $recipient_id";
            $results= mysqli_query($conn,$sql);
            if ($results){
                // Close cURL
                curl_close($ch);
                echo 'successful';
                header('refresh:10 automatic_message_sending.php'); 

            }
            else{
                echo 'not successful'.$results;
                header('refresh:10 automatic_message_sending.php'); 
            }
        }
    }
} 
else {
    echo "<h1>All Wishes for today have being sent successfully✅🥳🥳🥳🎂🎂.</h1>";
    header('refresh:10 automatic_message_sending.php'); 
}
?>

<!--also in addition to message auomated it subtracts a specified amount of credits maybe 1 for each known as charge from the total number wheer user id  so when you want to find the amount multiply the charge by number of credits 
 so randomisation of messages takes place here if you want to add a premium feature where user can add message then the sql statement will be like where c_mid is empty  since only paid will have something in message id -->



 <?php
// require("config.php");

// Initialize variables
// $recipient_name = "";
// $recipient_dob = "";
// $recipient_phone = "";
// $recipient_age = 0;
// $message = "";
// $recipients = [];

// Fetch contacts whose date of birth matches today's day and month
// $sql = "SELECT *, CONCAT(c_cntcode, c_pnum) AS phone 
//         FROM contacts 
//         WHERE MONTH(c_dob) = MONTH(CURDATE()) AND DAY(c_dob) = DAY(CURDATE()) AND m_stat = 0";

// $recipient_result = $conn->query($sql);

// if ($recipient_result && $recipient_result->num_rows > 0) {
//     while ($recipient_row = $recipient_result->fetch_assoc()) {
//         $recipient_name = $recipient_row['cf_name'] . ' ' . $recipient_row['cl_name'];
//         $recipient_dob = $recipient_row['c_dob'];
//         $recipient_id = $recipient_row['c_id'];
//         $recipient_phone = $recipient_row['phone'];
//         $registererid = $recipient_row['c_ruid'];

        /* Random message selection */
        // $message_ids = [];
        // $result = $conn->query("SELECT m_id FROM messages");
        // while ($row = $result->fetch_assoc()) {
        //     $message_ids[] = $row['m_id'];
        // }
        
        // Check if there are any message IDs available
        // if (empty($message_ids)) {
        //     die("No messages available to assign.");
        // }

        // $random_message_id = $message_ids[array_rand($message_ids)];

        // Fetch the message creator using registererid
        // $stmt = $conn->prepare("SELECT ruf_name, total_credits FROM registered_users WHERE ru_id = ?");
        // $stmt->bind_param("i", $registererid);
        // $stmt->execute();
        // $usr_result = $stmt->get_result();
        // if ($usr_result && $usr_result->num_rows > 0) {
        //     $usr_row = $usr_result->fetch_assoc();
        //     $sender = $usr_row['ruf_name'];
        //     $total_credits = $usr_row['total_credits'];
        // }
        // $stmt->close();

        // Fetch the message body using message_id
        // $stmt = $conn->prepare("SELECT m_body FROM messages WHERE m_id = ?");
        // $stmt->bind_param("i", $random_message_id);
        // $stmt->execute();
        // $msg_result = $stmt->get_result();
        // $msg_body = "";
        // if ($msg_result && $msg_result->num_rows > 0) {
        //     $msg_row = $msg_result->fetch_assoc();
        //     $msg_body = $msg_row['m_body'] . ' visit us: http://localhost/final/birthday/index.php';
        // }
        // $stmt->close();

        // Calculate recipient's age using DateTime
        // if ($recipient_dob) {
        //     $dob = new DateTime($recipient_dob);
        //     $now = new DateTime();
        //     $recipient_age = $now->diff($dob)->y;
        // }

        // Replace placeholders with actual values in the message
        // $personalized_message = str_ireplace("[Name]", htmlspecialchars($recipient_name), $msg_body);
        // $personalized_message = str_ireplace("[Age]", htmlspecialchars($recipient_age), $personalized_message);
        // $personalized_message = str_ireplace("[Your Name]", htmlspecialchars($sender), $personalized_message);

        // // Display the final message
        // echo htmlspecialchars($personalized_message) . "<br>";
        // echo htmlspecialchars($recipient_phone) . "<br>";

        // Prepare to send SMS using Mnotify
//         $apiKey = '1Tr9eN1Sxjo2BZvwbKByue5QL'; // Replace with your actual API key
//         $apiUrl = 'https://apps.mnotify.net/smsapi'; // Endpoint URL
        
//         // Message details
//         $recipient = $recipient_phone; // Replace with the recipient's phone number
//         $message = $personalized_message;
//         $senderId = 'Bdaywishers'; // Optional: Replace with your sender ID if required
        
//         // Prepare the URL with query parameters
//         $url = $apiUrl . '?key=' . $apiKey . '&to=' . urlencode($recipient) . '&msg=' . urlencode($message) . '&sender_id=' . urlencode($senderId);

//         // Initialize cURL
//         $ch = curl_init();
//         // Set cURL options
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
//         // Execute the request and get the response
//         $response = curl_exec($ch);
        
//         // Check for cURL errors
//         if (curl_errno($ch)) {
//             echo '<p>cURL error: ' . curl_error($ch) . '</p>';
//             header('refresh:10 automatic_message_sending.php'); 
//         } 
//         else {
//             echo '<p>Response: ' . $response . '</p>';

//             // Update the contact status to complete and subtract credits
//             $charge = 1; // Specify the charge per message sent
//             if ($total_credits >= $charge) {
//                 $sql = "UPDATE contacts SET m_stat = 1 WHERE c_id = $recipient_id";
//                 $results = mysqli_query($conn, $sql);
                
//                 if ($results) {
//                     // Update user credits
//                     $new_credits = $total_credits - $charge;
//                     $update_credits_sql = "UPDATE registered_users SET total_credits = ? WHERE ru_id = ?";
//                     $stmt = $conn->prepare($update_credits_sql);
//                     $stmt->bind_param("ii", $new_credits, $registererid);
//                     $stmt->execute();
//                     $stmt->close();
                    
//                     curl_close($ch);
//                     echo 'Message sent successfully. Credits updated.';
//                     header('refresh:10 automatic_message_sending.php'); 
//                 } else {
//                     echo 'Failed to update contact status: ' . mysqli_error($conn);
//                     header('refresh:10 automatic_message_sending.php'); 
//                 }
//             } else {
//                 echo 'Not enough credits to send message.';
//                 header('refresh:10 automatic_message_sending.php'); 
//             }
//         }
//     }
// } 
// else {
//     echo "<h1>All Wishes for today have been sent successfully✅🥳🥳🥳🎂🎂.</h1>";
//     header('refresh:10 automatic_message_sending.php'); 
// }
?>
