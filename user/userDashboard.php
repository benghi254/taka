<?php

session_start();

if(!isset($_SESSION['username']))
{
 //  header("location: index.php"); 
}

include_once '../modals/Database.php';
include_once 'Fuser.php';
include_once 'Faddress.php';
include_once '../modals/FaddressGeo.php';

$conn = Database::getConnection();
$userId = $_SESSION['userId'] ?? null;

// Get user information
$userInfo = null;
$addressInfo = null;
$geoInfo = null;

if($userId) {
    $userInfo = Fuser::getInfoUserById($userId);
    $addressInfo = Faddress::getAddressInfoById($userId);
    $geoInfo = FaddressGeo::getGeoByUserId($userId);
    
    // Get user statistics
    // Total orders/payments
    $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE userId = ?");
    $stmt->execute([$userId]);
    $totalOrders = $stmt->fetchColumn();
    
    // Total amount spent
    $stmt = $conn->prepare("SELECT IFNULL(SUM(amount), 0) FROM orders WHERE userId = ? ");
    $stmt->execute([$userId]);
    $totalSpent = $stmt->fetchColumn();
    
    // Total trash pickup requests
    $stmt = $conn->prepare("SELECT COUNT(*) FROM trash WHERE userId = ?");
    $stmt->execute([$userId]);
    $totalPickups = $stmt->fetchColumn();
    
    // Completed pickups
    $stmt = $conn->prepare("SELECT COUNT(*) FROM trash WHERE userId = ? AND Done = 'True'");
    $stmt->execute([$userId]);
    $completedPickups = $stmt->fetchColumn();
    
    // Recent orders (last 5)
    $stmt = $conn->prepare("SELECT * FROM orders WHERE userId = ? ORDER BY transactionDate DESC LIMIT 5");
    $stmt->execute([$userId]);
    $recentOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <style>
        .profile-section {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            margin-right: 20px;
        }
        .profile-info h2 {
            margin: 0 0 5px 0;
            color: #333;
        }
        .profile-info p {
            margin: 5px 0;
            color: #666;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-card h3 {
            margin: 0 0 10px 0;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }
        .stat-card .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
        }
        .info-section {
            margin-top: 20px;
        }
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .recent-orders {
            margin-top: 20px;
        }
        .order-item {
            padding: 10px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-date {
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <?php include_once 'userMenu.php';?>
        
    <?php include_once 'userHeader.php';?>  

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>HOME</p>         
            </div>
            
            <!-- User Profile Section -->
            <?php if($userInfo): ?>
            <div class="profile-section">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <?php echo strtoupper(substr($userInfo['fullname'] ?? 'U', 0, 1)); ?>
                    </div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($userInfo['fullname'] ?? 'User'); ?></h2>
                        <p><?php echo htmlspecialchars($userInfo['Email'] ?? ''); ?></p>
                        <p><?php echo htmlspecialchars($userInfo['Mobile'] ?? ''); ?></p>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Orders</h3>
                        <div class="stat-value"><?php echo $totalOrders ?? 0; ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Spent</h3>
                        <div class="stat-value">KES <?php echo number_format($totalSpent ?? 0, 2); ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Pickup Requests</h3>
                        <div class="stat-value"><?php echo $totalPickups ?? 0; ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Completed Pickups</h3>
                        <div class="stat-value"><?php echo $completedPickups ?? 0; ?></div>
                    </div>
                </div>
                
                <!-- Address Information -->
                <?php if($addressInfo): ?>
                <div class="info-section">
                    <h3 style="margin-bottom: 15px;">Address Information</h3>
                    <div class="info-row">
                        <span class="info-label">County:</span>
                        <span class="info-value"><?php echo htmlspecialchars($addressInfo['County'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Constituency:</span>
                        <span class="info-value"><?php echo htmlspecialchars($addressInfo['Constituency'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Ward:</span>
                        <span class="info-value"><?php echo htmlspecialchars($addressInfo['Ward'] ?? 'N/A'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Details:</span>
                        <span class="info-value"><?php echo htmlspecialchars($addressInfo['Details'] ?? 'N/A'); ?></span>
                    </div>
                    <?php if($geoInfo && $geoInfo['latitude'] && $geoInfo['longitude']): ?>
                    <div class="info-row">
                        <span class="info-label">Coordinates:</span>
                        <span class="info-value"><?php echo htmlspecialchars($geoInfo['latitude'] . ', ' . $geoInfo['longitude']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Recent Orders -->
                <?php if(!empty($recentOrders)): ?>
                <div class="recent-orders">
                    <h3 style="margin-bottom: 15px;">Recent Orders</h3>
                    <?php foreach($recentOrders as $order): ?>
                    <div class="order-item">
                        <div>
                            <strong>KES <?php echo number_format($order['amount'], 2); ?></strong>
                            <div class="order-date"><?php echo date('M d, Y H:i', strtotime($order['transactionDate'])); ?></div>
                        </div>
                        <div>
                            <span style="color: #22c55e; font-weight: bold;"><?php echo strtoupper($order['status']); ?></span>
                            <?php if($order['receiptNumber']): ?>
                            <div style="font-size: 12px; color: #666;">Receipt: <?php echo htmlspecialchars($order['receiptNumber']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Quick Actions -->
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
                       <a href="listTrash.php">Completed</a>
                    </div>                       
                </div>
                <div class="item">
                    <a href="alert.php"><img style="width: 100%; height: 180px; padding: 0px" src="../assets/img/alert.jpg" alt="alert"></a>
                    <div class="item-link">
                       <a href="editUser.php">Account</a>
                    </div>                       
                </div>
            </div>    
        </div>
    </div>
</body>
</html>