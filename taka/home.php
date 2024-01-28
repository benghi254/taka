<?php
session_start();

if(!isset($_SESSION)){
    header('location: login.php? login!');
}else{
    echo "<h2> welcome ". $_SESSION['uid'] . " </h2>";
    echo "<p> to get started on the taka waste disposal platform <a href='dump.php'>Continue</a></p>";
    echo "<a href='logout.php'>logout</a>";
}


?>
