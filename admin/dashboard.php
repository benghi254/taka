<?php

include_once '../commons/auth.php';
include_once '../modals/Database.php';
$conn = Database::getConnection();

// Total Users
$stmt = $conn->prepare("SELECT COUNT(*) FROM user");
$stmt->execute();
$totalUsers = $stmt->fetchColumn();

// Total Pickup Requests
$stmt = $conn->prepare("SELECT COUNT(*) FROM address");
$stmt->execute();
$totalRequests = $stmt->fetchColumn();

// Total Completed Payments
$stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE ResultCode=0");
$stmt->execute();
$totalPayments = $stmt->fetchColumn();

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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            gap: 20px;
            border-left: 5px solid #ccc;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 12px;
            flex-shrink: 0;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .stat-icon {
            font-size: 32px;
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

        .stat-card.users {
            border-color: #2980b9;
        }
        .stat-card.users .icon-wrapper {
            background-color: #2980b9;
        }

        .stat-card.requests {
            border-color: #d35400;
        }
        .stat-card.requests .icon-wrapper {
            background-color: #d35400;
        }

        .stat-card.payments {
            border-color: #27ae60;
        }
        .stat-card.payments .icon-wrapper {
            background-color: #27ae60;
        }

        .stat-card.bins {
            border-color: #8e44ad;
        }
        .stat-card.bins .icon-wrapper {
            background-color: #8e44ad;
        }

        .action-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
            gap: 15px;
            border: 1px solid #eaeaea;
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #3498db;
            color: #3498db;
        }
        .action-card i {
            font-size: 40px;
            color: inherit;
        }
        .action-card span {
            font-size: 16px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <?php include_once '../commons/menu.php'; ?>

    <?php include_once '../commons/header.php'; ?>

    <div class="body-container">
        <div class="ml-24">
            <div class="col-3">
                <div class="stat-card users">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-users stat-icon"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Users</h3>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                </div>

                <div class="stat-card requests">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-truck-pickup stat-icon"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Pickup Requests</h3>
                        <p><?php echo $totalRequests; ?></p>
                    </div>
                </div>

                <div class="stat-card payments">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-money-bill-wave stat-icon"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Completed Payments</h3>
                        <p><?php echo $totalPayments; ?></p>
                    </div>
                </div>

                <div class="stat-card bins">
                    <div class="icon-wrapper">
                        <i class="fa-solid fa-trash-can stat-icon"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Trash Bins</h3>
                        <p><?php echo $totalTrashBins; ?></p>
                    </div>
                </div>
            </div>

            <h2 style="margin-top: 40px; margin-bottom: 20px; color: #333; font-size: 22px;">Quick Navigation</h2>
            <div class="col-3">
                <a href="monitoring.php" class="action-card">
                    <i class="fa-solid fa-desktop"></i>
                    <span>Monitoring</span>
                </a>
                <a href="map.php" class="action-card">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>Map View</span>
                </a>
                <a href="alert.php" class="action-card">
                    <i class="fa-solid fa-bell"></i>
                    <span>Alerts</span>
                </a>
                <a href="report.php" class="action-card">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Daily Report</span>
                </a>
                
                <?php if ($_SESSION['role']=="admin"):?> 
                <a href="trash.php" class="action-card">
                    <i class="fa-solid fa-dumpster"></i>
                    <span>Trash Bins</span>
                </a>
                <?php endif;?>
                
                <?php if ($_SESSION['role']=="admin" || $_SESSION['role']=="admin-cont"):?>
                <a href="partner.php" class="action-card">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Worker & Contractor</span>
                </a>
                <a href="admin.php" class="action-card">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Admin</span>
                </a>
                <?php endif;?>
            </div>
        </div>

    </div>
</body>
<script>
    document.querySelector(".menu-toggle").onclick = function () {
        document.querySelector(".navbar").classList.toggle("active");
    };
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggle = document.querySelector(".menu-toggle");
        const sidebar = document.querySelector(".navbar");

        toggle.addEventListener("click", function () {
            sidebar.classList.toggle("active");
        });
    });
</script>

</html>