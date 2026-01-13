<?php

session_start();

if(!isset($_SESSION['username']))
{
   header("location: index.php"); 
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

    <?php include_once '../commons/menu.php';?>
        
    <?php include_once '../commons/header.php';?>  

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>HOME</p>         
            </div>
            <div class="col-3">
                <div class="item">
<<<<<<< HEAD
                    <a href="monitoring.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/monitoring.jpg" alt="monitoring"></a>
=======
                    <a href="monitoring.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/monitoring.jpg" alt="monitoring"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="monitoring.php">Monitoring</a>
                    </div>                       
                </div>  
                <div class="item">
<<<<<<< HEAD
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/map.jpg" alt="map"></a>
=======
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/map.jpg" alt="map"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="map.php">Map</a>
                    </div>                       
                </div>
                <div class="item">
<<<<<<< HEAD
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/alert.jpg" alt="alert"></a>
=======
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/alert.jpg" alt="alert"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="alert.php">Alert</a>
                    </div>                       
                </div>
                <div class="item">
<<<<<<< HEAD
                    <a href="report.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/report.jpg" alt="daily report"></a>
=======
                    <a href="report.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/report.jpg" alt="daily report"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="item-link">
                       <a href="report.php">Daily Report</a>
                    </div>                       
                </div>


                <?php if ($_SESSION['role']=="admin"):?> 
                    
                    <div class="item">
<<<<<<< HEAD
                        <a href="trash.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/trash.jpg" alt="trash"></a>
=======
                        <a href="trash.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/trash.jpg" alt="trash"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                        <div class="item-link">
                           <a href="trash.php">Trash Bin</a>
                        </div>                       
                    </div>

                <?php endif;?>

                <?php if ($_SESSION['role']=="admin" || $_SESSION['role']=="admin-cont"):?>

                    <div class="item">
<<<<<<< HEAD
                        <a href="partner.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/worker.jpg" alt="partner"></a>
=======
                        <a href="partner.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/worker.jpg" alt="partner"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                        <div class="item-link">
                           <a href="partner.php">Worker & Contractor</a>
                        </div>                       
                    </div>
                    <div class="item">
<<<<<<< HEAD
                        <a href="admin.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/user.jpg" alt="admin"></a>
=======
                        <a href="admin.php"><img style="width: 100%; height: 180px; padding: 0px" src="assets/img/user.jpg" alt="admin"></a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                        <div class="item-link">
                           <a href="admin.php">Admin</a>
                        </div>                       
                    </div>

                <?php endif;?>

            </div>    
        </div>
            
    </div>
</body>
</html>