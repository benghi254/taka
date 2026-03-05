<?php
include_once 'c:/xampp/htdocs/taka/modals/Database.php';

$conn = Database::getConnection();

echo "Adding missing columns to 'trash' table...\n";
try {
    $conn->exec("ALTER TABLE trash 
                 ADD COLUMN lat DECIMAL(10,8) NULL, 
                 ADD COLUMN longi DECIMAL(11,8) NULL, 
                 ADD COLUMN address TEXT NULL, 
                 ADD COLUMN area VARCHAR(100) NULL, 
                 ADD COLUMN idTrash VARCHAR(100) NULL");
    echo "Columns added successfully.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Columns already exist.\n";
    } else {
        echo "Error adding columns: " . $e->getMessage() . "\n";
    }
}

echo "Populating 'trash' table coordinates from 'address_geo_coordinates'...\n";
// Update trash pins based on userId mapping
$stmt = $conn->prepare("UPDATE trash t 
                        JOIN address_geo_coordinates ag ON t.userId = ag.userId 
                        SET t.lat = ag.latitude, 
                            t.longi = ag.longitude, 
                            t.address = ag.fullAddress, 
                            t.area = ag.ward, 
                            t.idTrash = CAST(t.trashId AS CHAR)
                        WHERE (t.lat IS NULL OR t.lat = '') AND ag.latitude != ''");
$stmt->execute();
echo "Updated " . $stmt->rowCount() . " trash records with coordinates.\n";

echo "Renaming columns for consistency with Ftrash.php...\n";
try {
    // Rename trashType to typeTrash
    $conn->exec("ALTER TABLE trash CHANGE COLUMN trashType typeTrash VARCHAR(45)");
    echo "Column 'trashType' renamed to 'typeTrash'.\n";
} catch (PDOException $e) {
    echo "Info/Error renaming trashType: " . $e->getMessage() . "\n";
}

try {
    // Rename trashId to _idTrash
    $conn->exec("ALTER TABLE trash CHANGE COLUMN trashId _idTrash INT(11) AUTO_INCREMENT");
    echo "Column 'trashId' renamed to '_idTrash'.\n";
} catch (PDOException $e) {
    echo "Info/Error renaming trashId: " . $e->getMessage() . "\n";
}

echo "Final check of trash table data...\n";
$stmt = $conn->prepare("SELECT _idTrash, lat, longi, address, typeTrash FROM trash LIMIT 5");
$stmt->execute();
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
