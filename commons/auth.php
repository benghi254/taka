<?php
// Set session cookie parameters to expire when the browser is closed
session_set_cookie_params(0);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inactivity timeout period in seconds (30 minutes)
$timeout_duration = 1800;

// Determine where to redirect based on current path
$current_path = $_SERVER['PHP_SELF'];
$is_admin = strpos($current_path, '/admin/') !== false;
$is_user = strpos($current_path, '/user/') !== false;

if ($is_admin) {
    $login_page = "../admin/login.php";
} elseif ($is_user) {
    $login_page = "../user/userLogin.php";
} else {
    $login_page = "public/login.php"; // Default fallback
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: $login_page");
    exit();
}

// Check for inactivity
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    // Last request was more than X seconds ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header("Location: $login_page?timeout=1");
    exit();
}

// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();
?>
