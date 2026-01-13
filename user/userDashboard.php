<?php

session_start();

if(!isset($_SESSION['username']))
{
   //header("location: userLogin.php"); 
   echo "cannot login";
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBoard</title>
    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
   
</head>
<body>

    <?php include_once 'userMenu.php';?>
        
    <?php include_once 'userHeader.php';?>  

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>HOME</p>         
            </div>
            <div class="col-3">
                <div class="item">
                    <a href="location.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/monitoring.jpg" alt="monitoring"></a>
                    <div class="item-link">
                       <a href="start.php">Request Trash Pickup</a>
                    </div>                       
                </div>  
                <div class="item">
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/map.jpg" alt="map"></a>
                    <div class="item-link">
                       <a href="map.php">Completed</a>
                    </div>                       
                </div>
                <div class="item">
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/alert.jpg" alt="alert"></a>
                    <div class="item-link">
                       <a href="alert.php">Account</a>
                    </div>                       
                </div>
               

            </div>    
        </div>
            
    </div>
</body>
</html>