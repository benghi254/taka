<?php

session_start();
include_once '../modals/Database.php';
$conn=Database::getConnection();

// Total Users
$stmt = $conn->prepare("SELECT COUNT(*) FROM user");
$stmt->execute();
$totalUsers = $stmt->fetchColumn();

// Total Pickup Requests
$stmt = $conn->prepare("SELECT COUNT(*) FROM address");
$stmt->execute();
$totalRequests = $stmt->fetchColumn();

// Total Completed Payments
//$stmt = $conn->prepare("SELECT COUNT(*) FROM payments WHERE status='completed'");
//$stmt->execute();
//$totalPayments = $stmt->fetchColumn();

$stmt = $conn->prepare("SELECT IFNULL(SUM(Weight),0) FROM trash WHERE Done='True'");
$stmt->execute();
$totalAmount = $stmt->fetchColumn();

// Total Trash Bins
$stmt = $conn->prepare("SELECT COUNT(*) FROM trash");
$stmt->execute();
$totalTrashBins = $stmt->fetchColumn();

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
            <div class="col-3">
                <div class="item">
                    <h3>Total Users</h3>
                    <p><?php echo $totalUsers; ?></p>
                </div>

                <div class="item">
                    <h3>Pickup Requests</h3>
                    <p><?php echo $totalRequests; ?></p>
                </div>

                <div class="item">
                    <h3>Completed Payments</h3>
                    <p><?php echo "5"; ?></p>
                </div>

                <div class="item">
                    <h3>Trash Bins</h3>
                    <p><?php echo $totalTrashBins; ?></p>
                </div>
            </div>
           
            <div class="col-3">
                <div class="item">
                    <a href="monitoring.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/monitoring.jpg" alt="monitoring"></a>
                    <div class="item-link">
                       <a href="monitoring.php">Monitoring</a>
                    </div>                       
                </div>  
                <div class="item">
                    <a href="map.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/map.jpg" alt="map"></a>
                    <div class="item-link">
                       <a href="map.php">Map</a>
                    </div>                       
                </div>
                <div class="item">
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/alert.jpg" alt="alert"></a>
                    <div class="item-link">
                       <a href="alert.php">Alert</a>
                    </div>                       
                </div>
                <div class="item">
                    <a href="report.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/report.jpg" alt="daily report"></a>
                    <div class="item-link">
                       <a href="report.php">Daily Report</a>
                    </div>                       
                </div>


                <?php if ($_SESSION['role']=="admin"):?> 
                    
                    <div class="item">
                        <a href="trash.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/trash.jpg" alt="trash"></a>
                        <div class="item-link">
                           <a href="trash.php">Trash Bin</a>
                        </div>                       
                    </div>

                <?php endif;?>

                <?php if ($_SESSION['role']=="admin" || $_SESSION['role']=="admin-cont"):?>

                    <div class="item">
                        <a href="partner.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/worker.jpg" alt="partner"></a>
                        <div class="item-link">
                           <a href="partner.php">Worker & Contractor</a>
                        </div>                       
                    </div>
                    <div class="item">
                        <a href="admin.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/user.jpg" alt="admin"></a>
                        <div class="item-link">
                           <a href="admin.php">Admin</a>
                        </div>                       
                    </div>

                <?php endif;?>

            </div>    
        </div>
            
    </div>
</body>
<script>
document.querySelector(".menu-toggle").onclick = function(){
    document.querySelector(".navbar").classList.toggle("active");
};
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){
    const toggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".navbar");

    toggle.addEventListener("click", function(){
        sidebar.classList.toggle("active");
    });
});
</script>
</html>