<?php
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

    // Save to DB here
}