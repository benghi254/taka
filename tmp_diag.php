<?php
include_once 'c:/xampp/htdocs/taka/modals/Database.php';

$conn = Database::getConnection();

echo "--- Coordinate Statistics ---\n";
$stmt = $conn->prepare("SELECT COUNT(*) FROM address_geo_coordinates WHERE latitude != '' AND longitude != ''");
$stmt->execute();
echo "Non-empty Address Coordinates: " . $stmt->fetchColumn() . "\n";

$stmt = $conn->prepare("SELECT COUNT(*) FROM address_geo_coordinates WHERE latitude IS NULL OR longitude IS NULL");
$stmt->execute();
echo "NULL Address Coordinates: " . $stmt->fetchColumn() . "\n";

echo "--- Address Fetching Test ---\n";
$stmt = $conn->prepare("SELECT ag.*, u.fullname, u.Email, u.Mobile, a.County, a.Constituency, a.Ward, a.Details 
                        FROM address_geo_coordinates ag
                        LEFT JOIN user u ON ag.userId = u.userId
                        LEFT JOIN address a ON ag.addressId = a.AddressId
                        WHERE ag.latitude IS NOT NULL AND ag.longitude IS NOT NULL");
$stmt->execute();
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Fetched " . count($addresses) . " addresses.\n";
if (!empty($addresses)) {
    echo "Sample adddress: " . $addresses[0]['fullAddress'] . " (" . $addresses[0]['latitude'] . ", " . $addresses[0]['longitude'] . ")\n";
}

echo "\n--- Trash Bins Fetching Test ---\n";
$stmt = $conn->prepare("SELECT * FROM trash ");
$stmt->execute();
$trashBins = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Fetched " . count($trashBins) . " trash bins.\n";
if (!empty($trashBins)) {
    echo "Sample trash bin: ID=" . $trashBins[0]['idTrash'] . " at (" . $trashBins[0]['lat'] . ", " . $trashBins[0]['longi'] . ") Type=" . ($trashBins[0]['typeTrash'] ?? 'N/A') . "\n";
}
?>
