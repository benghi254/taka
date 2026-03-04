<?php
include_once '../modals/Database.php';

$data = file_get_contents('php://input');
file_put_contents("mpesa_callback.json", $data.PHP_EOL, FILE_APPEND);

$response = json_decode($data, true);

$resultCode = $response['Body']['stkCallback']['ResultCode'];

if ($resultCode == 0) {
    $metadata = $response['Body']['stkCallback']['CallbackMetadata']['Item'];

    foreach ($metadata as $item) {
        if ($item['Name'] == "MpesaReceiptNumber") $MpesaCode = $item['Value'];
        if ($item['Name'] == "Amount") $Amount = $item['Value'];
        if ($item['Name'] == "PhoneNumber") $PhoneNumber = $item['Value'];
        if ($item['Name'] == "TransactionDate") $TransactionDate = $item['Value'];
    }

    // Get from the M-Pesa callback
    $MerchantRequestID = $response['Body']['stkCallback']['MerchantRequestID'];
    $CheckoutRequestID = $response['Body']['stkCallback']['CheckoutRequestID'];
    $ResultDesc = $response['Body']['stkCallback']['ResultDesc'];

    $conn = Database::getConnection();
    
    // Update the existing order record using CheckoutRequestID
    try {
        $stmt = $conn->prepare('UPDATE orders SET 
                                TransactionDate = ?, 
                                ResultCode = ?, 
                                ResultDesc = ?, 
                                MpesaCode = ? 
                                WHERE CheckoutRequestID = ?');
        
        // Format M-Pesa date (YmdHis) to DB format (Y-m-d)
        $dt = DateTime::createFromFormat('YmdHis', $TransactionDate);
        $finalDate = $dt ? $dt->format('Y-m-d') : date('Y-m-d');

        $stmt->execute([
            $finalDate,
            $resultCode,
            $ResultDesc,
            $MpesaCode,
            $CheckoutRequestID
        ]);
        
        // Log success
        file_put_contents("order_success.log", "Order updated: Receipt $MpesaCode, Phone: $PhoneNumber, CheckoutID: $CheckoutRequestID" . PHP_EOL, FILE_APPEND);
    } catch (PDOException $e) {
        // Log error
        file_put_contents("order_error.log", "Error updating order: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    }
}
?>