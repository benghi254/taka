<?php

session_start();

if(!isset($_SESSION['username']))
{
    //header("location: index.php"); 
}

include_once '../modals/Database.php';
include_once 'Faddress.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userId = $_POST['userId'] ?? $_SESSION['userId'] ?? null;
    $county = trim($_POST['county'] ?? '');
    $constituency = trim($_POST['constituency'] ?? '');
    $ward = trim($_POST['ward'] ?? '');
    $details = trim($_POST['details'] ?? '');
    $holder = trim($_POST['holder'] ?? '');
    $isUpdate = isset($_POST['isUpdate']) && $_POST['isUpdate'] == '1';
    
    // Validate inputs
    if(!$userId || !$county || !$constituency || !$ward || !$details || !$holder) {
        $_SESSION['err'] = "All fields are required!";
        header("location: location.php");
        exit();
    }
    
    // Validate holder value
    if(!in_array($holder, ['home', 'business', 'Institution'])) {
        $_SESSION['err'] = "Invalid role selected!";
        header("location: location.php");
        exit();
    }
    
    try {
        $conn = Database::getConnection();
        
        if($isUpdate) {
            // UPDATE existing address
            $stmt = $conn->prepare("
                UPDATE address 
                SET County = ?, Constituency = ?, Ward = ?, Details = ?, Holder = ?
                WHERE userId = ?
            ");
            $result = $stmt->execute([$county, $constituency, $ward, $details, $holder, $userId]);
            $message = "Address updated successfully!";
        } else {
            // INSERT new address
            $stmt = $conn->prepare("
                INSERT INTO address (userId, County, Constituency, Ward, Details, Holder)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $result = $stmt->execute([$userId, $county, $constituency, $ward, $details, $holder]);
            $message = "Address saved successfully!";
        }
        
        if($result) {
            // Set session flag to indicate address is set
            $_SESSION['area'] = true;
            $_SESSION['done'] = $message;
            
            // Redirect to start page or dashboard
            header("location: start.php");
            exit();
        } else {
            $_SESSION['err'] = "Failed to save address. Please try again.";
            header("location: location.php");
            exit();
        }
        
    } catch(PDOException $e) {
        $_SESSION['err'] = "Database error: " . $e->getMessage();
        header("location: location.php");
        exit();
    } catch(Exception $e) {
        $_SESSION['err'] = "Error: " . $e->getMessage();
        header("location: location.php");
        exit();
    }
} else {
    // If not POST request, redirect to location form
    header("location: location.php");
    exit();
}

?>