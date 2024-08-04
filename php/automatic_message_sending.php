
<?php
require("config.php");


$recipient_name = "";
$recipient_dob = "";
$recipient_phone = "";
$recipient_age = 0;
$message = "";
$recipients = [];

//  check today's date and retrieve from databse anyone's id whose date is equal to this date



// Initialize variables
$recipient_name = "no contact selected";
$recipient_dob = "";
$recipient_phone = "";
$recipient_age = 0;
$message = "";
$recipients = [];

// Fetch contacts whose date of birth matches today's day and month
$sql = "SELECT cf_name,c_ruid, cl_name, c_dob,c_mid CONCAT(c_cntcode, c_pnum) AS phone 
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

        
        // Fetch the  message creator using registererid
        $sql = "SELECT ruf_name FROM registered_users WHERE ru_id = $registererid";
        $usr_result = $conn->query($sql);
        if ($usr_result && $usr_result->num_rows > 0) {
            $usr_row = $usr_result->fetch_assoc();
            $sender = $usr_row['ruf_name'];
        }

        // Fetch the  message body using message_id
        $sql = "SELECT m_body FROM messages WHERE m_id = $recipient_messageid";
        $msg_result = $conn->query($sql);
        $msg_body = "";
        if ($msg_result && $msg_result->num_rows > 0) {
            $msg_row = $msg_result->fetch_assoc();
            $msg_body = $msg_row['m_body'];
        }

        // Calculate recipient's age using DateTime
        if ($recipient_dob) {
            $dob = new DateTime($recipient_dob);
            $now = new DateTime();
            $recipient_age = $now->diff($dob)->y;
        }

        // Replace placeholders with actual values in the message
        $personalized_message = str_ireplace("[Name]", $recipient_name, $msg_body);
        $personalized_message = str_ireplace("[Age]", $recipient_age, $personalized_message);
        $personalized_message = str_ireplace("[Your Name]", $sender, $personalized_message);

        // Display the final message
        echo $personalized_message . "<br>";
        echo $recipient_phone;

        // Optionally, store each recipient's message
        $recipients[] = [
            'name' => $recipient_name,
            'phone' => $recipient_phone,
            'message' => $personalized_message
        ];
    }
} else {
    echo "No contacts have a birthday today.";
}

/* Send message function */
// Include Twilio PHP library
/* require_once 'vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC05bfd9499c87f3d78f952369ab6243c2';
$token = '8fc5aa4ba108b942e641d60f54a918c9';
$client = new Client($sid, $token);

// Your Twilio phone number and the recipient's phone number
$from = '+19127375668';
$to = $recipient_phone;

// Send the SMS
$client->messages->create(
    $to,
    [
        'from' => $from,
        'body' => $personalized_message
    ]
);

echo "Message sent!"; */

