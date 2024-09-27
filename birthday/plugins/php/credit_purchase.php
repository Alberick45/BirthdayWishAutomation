<!-- Yet to work on -->
<?php
$clientId = 'your-client-id';
$clientSecret = 'your-client-secret';

$data = array(
    'items' => array(
        array(
            'name' => 'Product Name',
            'quantity' => 1,
            'unit_price' => 10.00
        )
    ),
    'total_amount' => 10.00,
    'description' => 'Purchase Description',
    'client_reference' => 'unique-transaction-id',
    'callback_url' => 'https://yourdomain.com/payment_callback', // Handle callback here
    'return_url' => 'https://yourdomain.com/payment_success',
    'cancellation_url' => 'https://yourdomain.com/payment_cancelled',
    'merchant_account_number' => 'your-merchant-account-number'
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
?>


<?php
$data = json_decode(file_get_contents('php://input'), true);

if ($data['status'] === 'completed') {
    // Update your order status as successful
} else {
    // Handle failed or pending payment
}
?>


// Automate credit purchase using Hubtel API (Example in PHP)
$clientId = 'your-client-id';
$clientSecret = 'your-client-secret';
$amount = 10.00; // Amount to buy in credit

$data = array(
    'total_amount' => $amount,
    'description' => 'Purchase of credit',
    'client_reference' => 'unique-transaction-id',
    'callback_url' => 'https://yourdomain.com/payment_callback',
    'return_url' => 'https://yourdomain.com/payment_success',
    'merchant_account_number' => 'your-merchant-account-number'
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


// Add credit to user's account upon successful payment
function addCreditToUser($userId, $creditAmount) {
    // Assuming you have a users table with a credit field
    $query = "UPDATE users SET credit = credit + ? WHERE user_id = ?";
    // Execute query using prepared statements to avoid SQL injection
    // Example using PDO:
    $stmt = $pdo->prepare($query);
    $stmt->execute([$creditAmount, $userId]);
}

// Payment callback
$paymentData = json_decode(file_get_contents('php://input'), true);

if ($paymentData['status'] == 'completed') {
    $userId = $paymentData['user_id']; // Assuming you pass user_id in the payment request
    $creditAmount = $paymentData['amount'];
    addCreditToUser($userId, $creditAmount);
    echo "Credit added successfully!";
}
