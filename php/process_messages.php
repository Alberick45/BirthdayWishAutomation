<?php
/* connect to database custom messages */
require("config.php");
session_start();



$querymessage = "";
$msg_body = "";
$recipient_name = "";
$recipient_dob = "";
$recipient_phone = "";
$recipient_age = 0;
$message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sample_msg = isset($_POST['select_msg']) ? $_POST['select_msg'] : '';
    $custom_msg = isset($_POST['select_msg2']) ? $_POST['select_msg2'] : '';
    $new_message = isset($_POST['new_message']) ? $_POST['new_message'] : '';
    $recipient_id = isset($_POST['select_contacts']) ? $_POST['select_contacts'] : '';

    // Handle Sample Messages form submission
    if (!empty($sample_msg) && $sample_msg !== '1') {
        $querymessage = "Selected Sample Message ID: " . htmlspecialchars($sample_msg);
        $sql = "SELECT sm_body FROM sample_messages WHERE sm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $sample_msg);
        $stmt->execute();
        $stmt->bind_result($msg_body);
        $stmt->fetch();
        $stmt->close();
    } 

    // Handle Custom Messages form submission
    if ($custom_msg === 'add_new' && !empty($new_message)) {
        $stmt = $conn->prepare("INSERT INTO custom_messages (cm_body) VALUES (?)");
        $stmt->bind_param("s", $new_message);
        if ($stmt->execute()) {
            $querymessage .= " New custom message added successfully.";
            $msg_body = $new_message;
        } else {
            $querymessage .= " Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (!empty($custom_msg) && $custom_msg !== 'add_new' && $custom_msg !== '1') {
        $querymessage .= " Selected Custom Message ID: " . htmlspecialchars($custom_msg);
        $sql = "SELECT cm_body FROM custom_messages WHERE cm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $custom_msg);
        $stmt->execute();
        $stmt->bind_result($msg_body);
        $stmt->fetch();
        $stmt->close();
    } elseif ($custom_msg === 'add_new' && empty($new_message)) {
        $querymessage .= " No custom message provided.";
    }

    // Fetch recipient data
    if (!empty($recipient_id)) {
        $sql = "SELECT cf_name, cl_name, c_dob, CONCAT(c_cntcode, c_pnum) AS phone FROM contacts WHERE c_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $recipient_id);
        $stmt->execute();
        $stmt->bind_result($cf_name, $cl_name, $c_dob, $phone);
        $stmt->fetch();
        $stmt->close();

        if ($cf_name === null) {
            $recipient_name = "no contact selected";
        } else {
            $recipient_name = $cf_name . ' ' . $cl_name;
            $recipient_dob = $c_dob;
            $recipient_phone = $phone;
        }
    } else {
        $recipient_name = "no contact selected";
    }

    // Calculate recipient's age using DateTime
    if ($recipient_dob) {
        // Define date of birth and current date
        $dateofbirth = strtotime($recipient_dob);
        $currentdate = strtotime(date("Y-m-d"));

        // Calculate age in years
        $recipient_age = floor((($currentdate - $dateofbirth) / (365*60*60*24)));
    }

    // Replace placeholders with actual values in the message
    $message = str_ireplace("[Name]", $recipient_name, $msg_body);
    $message = str_ireplace("[Age]", $recipient_age, $message);

    // Display the final message
    echo $message;

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
            'body' => $message
        ]
    );

    echo "Message sent!"; */
}

// Close the database connection
$conn->close();

// Redirect after showing the message
header("Refresh: 5; url=../send_message.html"); // Redirect back to the form page after 5 seconds
exit();