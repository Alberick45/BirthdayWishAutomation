<?php
// API Key and Endpoint
$apiKey = 'api_key'; // Replace with your actual API key
$apiUrl = 'https://apps.mnotify.net/smsapi'; // Endpoint URL

// Message details
$recipient = '+233541686805'; // Replace with the recipient's phone number
$message = 'This is a test message from MNotify BMS';
$senderId = 'sender_id'; // Optional: Replace with your sender ID if required

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













/* 
// Your Hubtel credentials
$clientId = 'kcaliqtv';
$clientSecret = 'kzaxioop';

// Message details
$from = 'SalemInc';
$to = '233509146861'; // Ensure the number is in international format without the '+'
$message = 'hello';

// Prepare the payload
$data = array(
    'From' => $from,
    'To' => $to,
    'Content' => $message,
    // 'ClientReference' => $registererid // Optional
);

$data_string = json_encode($data);

// Initialize cURL
$ch = curl_init('https://smsc.hubtel.com/v1/messages/send');

// Set cURL options
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die('cURL error: ' . $error);
}

// Close cURL
curl_close($ch);

// Decode and handle the response
$responseData = json_decode($response, true);

// Print the full response for debugging
// var_dump($responseData); // Uncomment this line if you need to debug the response

// Check the response status
if (isset($responseData['status']) && $responseData['status'] === 0) {
    echo 'Message sent successfully!';
} else {
    echo 'Failed to send message: ' . (isset($responseData['statusDescription']) ? $responseData['statusDescription'] : 'Unknown error');
} */
