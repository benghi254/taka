<?php

session_start();

if(!isset($_SESSION['username']))
{
<<<<<<< HEAD
   //header("location: userLogin.php"); 
   echo "cannot login";
=======
   header("location: userLogin.php"); 
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
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
<<<<<<< HEAD
                    <a href="location.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/monitoring.jpg" alt="monitoring"></a>
                    <div class="item-link">
                       <a href="start.php">Request Trash Pickup</a>
                    </div>                       
                </div>  
                <div class="item">
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/map.jpg" alt="map"></a>
=======
                    <a href="location.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/monitoring.jpg" alt="monitoring"></a>
                    <div class="item-link">
                       <a href="location.php">Request Trash Pickup</a>
                    </div>                       
                </div>  
                <div class="item">
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/map.jpg" alt="map"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="map.php">Completed</a>
                    </div>                       
                </div>
                <div class="item">
<<<<<<< HEAD
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/alert.jpg" alt="alert"></a>
=======
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/alert.jpg" alt="alert"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="alert.php">Account</a>
                    </div>                       
                </div>
               

            </div>    
        </div>
            
    </div>
</body>
</html>