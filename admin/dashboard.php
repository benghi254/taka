<?php

include_once '../commons/auth.php';
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBoard</title>
    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .col-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            display: flex;
            align-items: center;
            padding: 25px 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            gap: 20px;
            border-left: 5px solid #ccc;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .stat-icon {
            font-size: 45px;
            opacity: 0.9;
        }
        .stat-content {
            flex-grow: 1;
        }
        .stat-content h3 {
            margin: 0 0 5px 0;
            font-size: 15px;
            color: #7f8c8d;
            text-transform: uppercase;
        }
        .stat-content p {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .stat-card.users { border-color: #3498db; }
        .stat-card.users .stat-icon { color: #3498db; }
        
        .stat-card.requests { border-color: #e67e22; }
        .stat-card.requests .stat-icon { color: #e67e22; }
        
        .stat-card.payments { border-color: #2ecc71; }
        .stat-card.payments .stat-icon { color: #2ecc71; }
        
        .stat-card.bins { border-color: #9b59b6; }
        .stat-card.bins .stat-icon { color: #9b59b6; }
    </style>
</head>
<body>

    <?php include_once '../commons/menu.php';?>
        
    <?php include_once '../commons/header.php';?>  

    <div class="body-container">
        <div class="ml-24">
            <div class="col-3">
                <div class="stat-card users">
                    <i class="fa-solid fa-users stat-icon"></i>
                    <div class="stat-content">
                        <h3>Total Users</h3>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                </div>

                <div class="stat-card requests">
                    <i class="fa-solid fa-truck-pickup stat-icon"></i>
                    <div class="stat-content">
                        <h3>Pickup Requests</h3>
                        <p><?php echo $totalRequests; ?></p>
                    </div>
                </div>

                <div class="stat-card payments">
                    <i class="fa-solid fa-money-bill-wave stat-icon"></i>
                    <div class="stat-content">
                        <h3>Completed Payments</h3>
                        <p><?php echo "5"; ?></p>
                    </div>
                </div>

                <div class="stat-card bins">
                    <i class="fa-solid fa-trash-can stat-icon"></i>
                    <div class="stat-content">
                        <h3>Trash Bins</h3>
                        <p><?php echo $totalTrashBins; ?></p>
                    </div>
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