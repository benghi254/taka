<?php
include_once 'modals/Database.php';
$conn = Database::getConnection();
$stmt = $conn->query("DESCRIBE trash;");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
