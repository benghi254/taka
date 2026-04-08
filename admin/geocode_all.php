<?php
include_once '../commons/auth.php';
include_once '../modals/Database.php';
include_once '../modals/FaddressGeo.php';

$conn = Database::getConnection();

// Get all addresses that either don't exist in address_geo_coordinates OR have NULL latitude
$stmt = $conn->prepare("
    SELECT a.* 
    FROM address a
    LEFT JOIN address_geo_coordinates ag ON a.AddressId = ag.addressId
    WHERE ag.geoId IS NULL OR ag.latitude IS NULL
");
$stmt->execute();
$addressesToGeocode = $stmt->fetchAll(PDO::FETCH_ASSOC);

$successCount = 0;
$failCount = 0;

foreach ($addressesToGeocode as $addr) {
    $result = FaddressGeo::saveAddressWithGeo(
        $addr['AddressId'],
        $addr['userId'],
        $addr['County'],
        $addr['Constituency'],
        $addr['Ward'],
        $addr['Details']
    );
    
    if ($result !== false) {
        // Need to check if latitude actually succeeded
        $checkStmt = $conn->prepare("SELECT latitude FROM address_geo_coordinates WHERE addressId = ?");
        $checkStmt->execute([$addr['AddressId']]);
        $geoRecord = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($geoRecord && !empty($geoRecord['latitude'])) {
            $successCount++;
        } else {
            $failCount++;
        }
    } else {
        $failCount++;
    }
    
    // Add small delay to avoid hitting Nominatim rate limits (absolute max 1 request/second)
    usleep(1100000); // 1.1 seconds
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => "Geocoding complete. Successfully geocoded $successCount addresses. Failed to geocode $failCount addresses.",
    'totalProcessed' => count($addressesToGeocode),
    'successCount' => $successCount,
    'failCount' => $failCount
]);
?>
