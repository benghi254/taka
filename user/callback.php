<?php
include_once '../modals/Database.php';

$data = file_get_contents('php://input');
file_put_contents("mpesa_callback.json", $data.PHP_EOL, FILE_APPEND);

$response = json_decode($data, true);

$resultCode = $response['Body']['stkCallback']['ResultCode'];

if ($resultCode == 0) {
    $metadata = $response['Body']['stkCallback']['CallbackMetadata']['Item'];

    foreach ($metadata as $item) {
        if ($item['Name'] == "MpesaReceiptNumber") $receipt = $item['Value'];
        if ($item['Name'] == "Amount") $amount = $item['Value'];
        if ($item['Name'] == "PhoneNumber") $phone = $item['Value'];
    }

    // Get userId from phone number
    $conn = Database::getConnection();
    
    // Format phone number to match database format (remove 254 prefix if present)
    $phoneFormatted = preg_replace('/^254/', '0', $phone);
    
    // Try to find user by phone number
    $stmt = $conn->prepare('SELECT userId FROM user WHERE Mobile = ? OR Mobile = ? LIMIT 1');
    $stmt->execute([$phone, $phoneFormatted]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $user ? $user['userId'] : null;
    
    // Save order to database
    try {
        $stmt = $conn->prepare('INSERT INTO orders (userId, phone, amount, receiptNumber, status, transactionDate) 
                                VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([
            $userId,
            $phone,
            $amount,
            $receipt,
            'completed'
        ]);
        
        // Log success
        file_put_contents("order_success.log", "Order saved: Receipt $receipt, Amount $amount, UserId: " . ($userId ?? 'N/A') . PHP_EOL, FILE_APPEND);
    } catch (PDOException $e) {
        // Log error
        file_put_contents("order_error.log", "Error saving order: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    }
}