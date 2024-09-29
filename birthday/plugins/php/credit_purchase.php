<?php
require("config.php");
session_start();

if (!isset($_SESSION['user id'])) {
    header("Location: ../../index.php");
    echo "You are not logged in";
    exit();
} 

$userid = $_SESSION['user id'];

// Accepting purchase info
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm_purchase'])) {
        $customer_phone = isset($_POST['ucntcd']) && isset($_POST['payphone']) 
            ? $conn->real_escape_string($_POST['ucntcd'] . $_POST['payphone']) 
            : $_POST['altphone'];
        
        $smsid = $conn->real_escape_string($_POST['smsid']);
        
        $sql = "INSERT INTO transactions (userid, sms_id) VALUES (?, ?)";
        $stmt = $conn->stmt_init();
        
        if ($stmt->prepare($sql)) {
            $stmt->bind_param('ii', $userid, $smsid);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Transaction added successfully";
                $em = "Contact added successfully";

                // Retrieve amount and number of credits using sms id
                $retrieveSms = "SELECT num_of_credits, price FROM sms WHERE sms_id = ?";
                $retrieve_stmt = $conn->stmt_init();

                if ($retrieve_stmt->prepare($retrieveSms)) {
                    $retrieve_stmt->bind_param('i', $smsid);
                    $retrieve_stmt->execute();
                    $retrieve_stmt->bind_result($num_of_credits, $price);
                    $retrieve_stmt->fetch();
                }

                // Code for transaction goes here
                $clientId = 'your-client-id';
                $clientSecret = 'your-client-secret';
                $amount = $price; // Amount to buy in credit

                $data = array(
                    'total_amount' => $amount,
                    'description' => 'Purchase of credit',
                    'client_reference' => 'unique-transaction-id',
                    'callback_url' => 'https://yourdomain.com/payment_callback',
                    'return_url' => 'https://yourdomain.com/payment_success',
                    'merchant_account_number' => 'your-merchant-account-number',
                    'customer_phone' => $customer_phone // Add this line
                );

                $jsonData = json_encode($data);

                $ch = curl_init('https://api.hubtel.com/v1/merchantaccount/merchants/{your-merchant-id}/checkout/invoice/create');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
                ));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);

                echo $response;

                // Payment callback
                $paymentData = json_decode(file_get_contents('php://input'), true);

                if ($paymentData['status'] == 'completed') {
                    $creditAmount = $paymentData['amount'];
                    addCreditToUser($userid, $creditAmount);
                    sendConfirmationSMS($customer_phone, $creditAmount);
                    updateTransactionStatus($userid, $smsid, 'complete'); // Update status to complete
                    echo "Credit added successfully!";
                }

                // Function to send confirmation SMS
                function sendConfirmationSMS($customer_phone, $amount) {
                    $clientId = 'your-client-id';
                    $clientSecret = 'your-client-secret';

                    $message = "Thank you for your purchase! You've successfully added {$amount} credits to your account.";

                    $data = array(
                        'to' => $customer_phone,
                        'from' => 'YourCompanyName', // Replace with your sender ID
                        'message' => $message
                    );

                    $jsonData = json_encode($data);

                    $ch = curl_init('https://api.hubtel.com/v1/messages/send');
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
                    ));
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $responseData = json_decode($response, true);
                    if (isset($responseData['status']) && $responseData['status'] == 'success') {
                        echo "Confirmation SMS sent successfully!";
                    } else {
                        echo "Failed to send SMS: " . $responseData['message'];
                    }
                }

                // Function to add credits to user
                function addCreditToUser($userId, $creditAmount) {
                    global $conn; // Access the global connection variable
                    $query = "UPDATE users SET credit = credit + ? WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('ii', $creditAmount, $userId);
                    $stmt->execute();
                }

                // Function to update transaction status
                function updateTransactionStatus($userId, $smsId, $status) {
                    global $conn; // Access the global connection variable
                    $query = "UPDATE transactions SET status = ? WHERE userid = ? AND sms_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('sii', $status, $userId, $smsId);
                    $stmt->execute();
                }

                // End of transaction
                header("Location: user_account.php?success=$em&$data");
                $conn->close();
                exit;

            } else {
                $_SESSION['message'] = "Error executing statement: " . $stmt->error;
                $em = "Error executing statement: " . $stmt->error;
                header("Location: user_account.php?success=$em&$data");
                $conn->close();
                exit;
            }
        } else {
            $em = "Error preparing statement: " . $conn->error;
            $_SESSION['message'] = "Error preparing statement: " . $conn->error;
            header("Location: user_account.php?success=$em&$data");
        }
        $stmt->close();
        $conn->close();
        exit;
    } else {
        $em = "Please fill all fields.";
        $_SESSION['message'] = "Please fill all fields.";
        header("Location: user_account.php?success=Please fill all fields.");
        $conn->close();
        exit;
    }
}
?>
 <!-- #endregion -->










 /**
 * Requires libcurl
 */

const mobileNumber = "YOUR_mobileNumber_PARAMETER";
$curl = curl_init();

$payload = array(
  "amount" => 1,
  "title" => "string",
  "description" => "string",
  "clientReference" => "string",
  "callbackUrl" => "http://example.com",
  "cancellationUrl" => "http://example.com",
  "returnUrl" => "http://example.com",
  "logo" => "http://example.com"
);

curl_setopt_array($curl, [
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode("<username>:<password>")
  ],
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_URL => "https://devp-reqsendmoney-230622-api.hubtel.com/request-money/" . mobileNumber,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  echo "cURL Error #:" . $error;
} else {
  echo $response;
} this is for requesting money right  and this <?php
require("config.php");
session_start();

if (!isset($_SESSION['user id'])) {
    header("Location: ../../index.php");
    echo "You are not logged in";
    exit();
} 

$userid = $_SESSION['user id'];

// Accepting purchase info
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm_purchase'])) {
        $customer_phone = isset($_POST['ucntcd']) && isset($_POST['payphone']) 
            ? $conn->real_escape_string($_POST['ucntcd'] . $_POST['payphone']) 
            : $_POST['altphone'];
        
        $smsid = $conn->real_escape_string($_POST['smsid']);
        
        $sql = "INSERT INTO transactions (userid, sms_id) VALUES (?, ?)";
        $stmt = $conn->stmt_init();
        
        if ($stmt->prepare($sql)) {
            $stmt->bind_param('ii', $userid, $smsid);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Transaction added successfully";
                $em = "Contact added successfully";

                // Retrieve amount and number of credits using sms id
                $retrieveSms = "SELECT num_of_credits, price FROM sms WHERE sms_id = ?";
                $retrieve_stmt = $conn->stmt_init();

                if ($retrieve_stmt->prepare($retrieveSms)) {
                    $retrieve_stmt->bind_param('i', $smsid);
                    $retrieve_stmt->execute();
                    $retrieve_stmt->bind_result($num_of_credits, $price);
                    $retrieve_stmt->fetch();
                }

                // Code for transaction goes here
                $clientId = 'your-client-id';
                $clientSecret = 'your-client-secret';
                $amount = $price; // Amount to buy in credit

                $data = array(
                    'total_amount' => $amount,
                    'description' => 'Purchase of credit',
                    'client_reference' => 'unique-transaction-id',
                    'callback_url' => 'https://yourdomain.com/payment_callback',
                    'return_url' => 'https://yourdomain.com/payment_success',
                    'merchant_account_number' => 'your-merchant-account-number',
                    'customer_phone' => $customer_phone // Add this line
                );

                $jsonData = json_encode($data);

                $ch = curl_init('https://api.hubtel.com/v1/merchantaccount/merchants/{your-merchant-id}/checkout/invoice/create');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
                ));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);

                echo $response;

                // Payment callback
                $paymentData = json_decode(file_get_contents('php://input'), true);

                if ($paymentData['status'] == 'completed') {
                    $creditAmount = $paymentData['amount'];
                    addCreditToUser($userid, $creditAmount);
                    sendConfirmationSMS($customer_phone, $creditAmount);
                    updateTransactionStatus($userid, $smsid, 'complete'); // Update status to complete
                    echo "Credit added successfully!";
                }

                // Function to send confirmation SMS
                function sendConfirmationSMS($customer_phone, $amount) {
                    $clientId = 'your-client-id';
                    $clientSecret = 'your-client-secret';

                    $message = "Thank you for your purchase! You've successfully added {$amount} credits to your account.";

                    $data = array(
                        'to' => $customer_phone,
                        'from' => 'YourCompanyName', // Replace with your sender ID
                        'message' => $message
                    );

                    $jsonData = json_encode($data);

                    $ch = curl_init('https://api.hubtel.com/v1/messages/send');
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
                    ));
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $responseData = json_decode($response, true);
                    if (isset($responseData['status']) && $responseData['status'] == 'success') {
                        echo "Confirmation SMS sent successfully!";
                    } else {
                        echo "Failed to send SMS: " . $responseData['message'];
                    }
                }

                // Function to add credits to user
                function addCreditToUser($userId, $creditAmount) {
                    global $conn; // Access the global connection variable
                    $query = "UPDATE users SET credit = credit + ? WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('ii', $creditAmount, $userId);
                    $stmt->execute();
                }

                // Function to update transaction status
                function updateTransactionStatus($userId, $smsId, $status) {
                    global $conn; // Access the global connection variable
                    $query = "UPDATE transactions SET status = ? WHERE userid = ? AND sms_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('sii', $status, $userId, $smsId);
                    $stmt->execute();
                }

                // End of transaction
                header("Location: user_account.php?success=$em&$data");
                $conn->close();
                exit;

            } else {
                $_SESSION['message'] = "Error executing statement: " . $stmt->error;
                $em = "Error executing statement: " . $stmt->error;
                header("Location: user_account.php?success=$em&$data");
                $conn->close();
                exit;
            }
        } else {
            $em = "Error preparing statement: " . $conn->error;
            $_SESSION['message'] = "Error preparing statement: " . $conn->error;
            header("Location: user_account.php?success=$em&$data");
        }
        $stmt->close();
        $conn->close();
        exit;
    } else {
        $em = "Please fill all fields.";
        $_SESSION['message'] = "Please fill all fields.";
        header("Location: user_account.php?success=Please fill all fields.");
        $conn->close();
        exit;
    }
}
?>
 <!-- #endregion -->
   was for doing the purchase i want to accept persons phone and allow him or her to pay on