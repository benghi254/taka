<?php
include_once 'c:/xampp/htdocs/taka/modals/Database.php';
include_once 'c:/xampp/htdocs/taka/modals/FaddressGeo.php';
include_once 'c:/xampp/htdocs/taka/modals/GeocodingService.php';

$conn = Database::getConnection();

// Get all addresses that don't have valid coordinates in address_geo_coordinates
$stmt = $conn->prepare("SELECT a.* FROM address a 
                        LEFT JOIN address_geo_coordinates ag ON a.AddressId = ag.addressId 
                        WHERE ag.latitude IS NULL OR ag.latitude = '' OR ag.longitude IS NULL OR ag.longitude = ''");
$stmt->execute();
$addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Found " . count($addresses) . " addresses to geocode.\n";

foreach ($addresses as $addr) {
    echo "Geocoding: " . $addr['Details'] . ", " . $addr['Ward'] . ", " . $addr['County'] . "... ";
    
    $geoId = FaddressGeo::saveAddressWithGeo(
        $addr['AddressId'], 
        $addr['userId'], 
        $addr['County'], 
        $addr['Constituency'], 
        $addr['Ward'], 
        $addr['Details']
    );
    
    if ($geoId) {
        $res = FaddressGeo::getGeoByAddressId($addr['AddressId']);
        if ($res && !empty($res['latitude'])) {
            echo "SUCCESS: " . $res['latitude'] . ", " . $res['longitude'] . "\n";
        } else {
            echo "FAILED (No coordinates returned)\n";
        }
    } else {
        echo "FAILED (Database error)\n";
    }
    
    // Sleep briefly to respect Nominatim usage policy (1 request per second)
    sleep(1);
}

echo "Finished processing addresses.\n";
?>
