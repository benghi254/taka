<?php
include_once '../commons/auth.php';

function formatPhoneNumber($phone)
{
    // Remove spaces, hyphens, brackets, +
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // If starts with 0 e.g 0797...
    if (preg_match('/^0[17][0-9]{8}$/', $phone)) {
        return '254' . substr($phone, 1);
    }

    // If starts with 7 or 1 e.g 797...
    if (preg_match('/^[17][0-9]{8}$/', $phone)) {
        return '254' . $phone;
    }

    // If already in 254 format
    if (preg_match('/^254[17][0-9]{8}$/', $phone)) {
        return $phone;
    }

    return false; // invalid number
}
$consumerKey = "t4YmLSVSZ6jrDvyzcdqGec9Bw1MJpA5i6fq7PEGHpMhScgCN";
$consumerSecret = "eMG3UB6yFpR2CAIAITzPsaGKKaNYIEvU5jYDFyVpR1c2CGb8vgXfek422RjevhS8";
$shortcode = "174379";
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$callbackUrl = "https://factorable-alyvia-unwillingly.ngrok-free.dev/taka/user/callback.php";

$phone = formatPhoneNumber($_POST['phone']);
$amount = $_POST['amount'];

// Direct order insertion as requested
include_once '../modals/Database.php';
$conn = Database::getConnection();
$orderId = null;
try {
    $stmt = $conn->prepare('INSERT INTO orders (PhoneNumber, Amount, userId, TransactionDate) VALUES (?, ?, ?, NOW())');
    $stmt->execute([$_POST['phone'], $_POST['amount'], $_SESSION['userId']]);
    $orderId = $conn->lastInsertId();
} catch (PDOException $e) {
    // Fail silently or log error
}

$timestamp = date('YmdHis');
$password = base64_encode($shortcode . $passkey . $timestamp);

#---------------- GET ACCESS TOKEN ----------------#
$tokenUrl = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

$credentials = base64_encode($consumerKey . ':' . $consumerSecret);

$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic $credentials"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$accessToken = json_decode($response)->access_token;

#---------------- STK PUSH ----------------#
$stkUrl = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

$stkData = [
    "BusinessShortCode" => $shortcode,
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => $amount,
    "PartyA" => $phone,
    "PartyB" => $shortcode,
    "PhoneNumber" => $phone,
    "CallBackURL" => $callbackUrl,
    "AccountReference" => "WasteCollection",
    "TransactionDesc" => "Website Payment"
];

$ch = curl_init($stkUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stkData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$res = json_decode($result);
if (isset($res->ResponseCode) && $res->ResponseCode == "0") {
    $checkoutRequestID = $res->CheckoutRequestID;
    $merchantRequestID = $res->MerchantRequestID;

    // Update the record we inserted earlier
    if ($orderId) {
        $stmt = $conn->prepare('UPDATE orders SET MerchantRequestID = ?, CheckoutRequestID = ? WHERE orderId = ?');
        $stmt->execute([$merchantRequestID, $checkoutRequestID, $orderId]);
    }
}

header("location: checkout_succes.php");