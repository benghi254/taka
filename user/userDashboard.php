<?php
include_once '../commons/auth.php';

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
    $stmt = $conn->prepare("SELECT IFNULL(SUM(Amount), 0) FROM orders WHERE userId = ? ");
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
    $stmt = $conn->prepare("SELECT * FROM orders WHERE userId = ? ORDER BY TransactionDate DESC LIMIT 5");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-section {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        .profile-avatar {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            margin-right: 20px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        .profile-info h2 {
            margin: 0 0 5px 0;
            color: #2c3e50;
            font-size: 24px;
        }
        .profile-info p {
            margin: 3px 0;
            color: #7f8c8d;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            display: flex;
            align-items: center;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            gap: 15px;
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
            width: 60px;
            height: 60px;
            border-radius: 12px;
            flex-shrink: 0;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        .stat-icon {
            font-size: 24px;
        }
        .stat-content {
            flex-grow: 1;
        }
        .stat-content h3 {
            margin: 0 0 5px 0;
            font-size: 13px;
            color: #7f8c8d;
            text-transform: uppercase;
            font-weight: 600;
        }
        .stat-content .stat-value {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-card.orders { border-color: #2980b9; }
        .stat-card.orders .icon-wrapper { background-color: #2980b9; }
        
        .stat-card.spent { border-color: #27ae60; }
        .stat-card.spent .icon-wrapper { background-color: #27ae60; }
        
        .stat-card.requests { border-color: #d35400; }
        .stat-card.requests .icon-wrapper { background-color: #d35400; }
        
        .stat-card.completed { border-color: #8e44ad; }
        .stat-card.completed .icon-wrapper { background-color: #8e44ad; }

        .info-section {
            margin-top: 25px;
            background: #fcfcfc;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #f0f0f0;
        }
        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            font-weight: 600;
            width: 140px;
            color: #7f8c8d;
            font-size: 14px;
        }
        .info-value {
            color: #2c3e50;
            font-size: 14px;
        }
        
        .recent-orders {
            margin-top: 30px;
        }
        .order-item {
            padding: 15px;
            background: #fff;
            margin-bottom: 12px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f0f0f0;
            transition: background 0.2s;
        }
        .order-item:hover { background: #fdfdfd; }
        .order-date {
            color: #95a5a6;
            font-size: 12px;
            margin-top: 3px;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
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
                    <div class="stat-card orders">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-basket-shopping stat-icon"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Total Orders</h3>
                            <div class="stat-value"><?php echo $totalOrders ?? 0; ?></div>
                        </div>
                    </div>
                    <div class="stat-card spent">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-coins stat-icon"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Total Spent</h3>
                            <div class="stat-value">KES <?php echo number_format($totalSpent ?? 0, 2); ?></div>
                        </div>
                    </div>
                    <div class="stat-card requests">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-truck-ramp-box stat-icon"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Pickup Requests</h3>
                            <div class="stat-value"><?php echo $totalPickups ?? 0; ?></div>
                        </div>
                    </div>
                    <div class="stat-card completed">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-circle-check stat-icon"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Completed Pickups</h3>
                            <div class="stat-value"><?php echo $completedPickups ?? 0; ?></div>
                        </div>
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
                            <strong>KES <?php echo number_format($order['Amount'], 2); ?></strong>
                            <div class="order-date"><?php echo date('M d, Y', strtotime($order['TransactionDate'])); ?></div>
                        </div>
                        <div>
                            <span style="color: #22c55e; font-weight: bold;"><?php echo strtoupper($order['ResultDesc'] ?? 'PENDING'); ?></span>
                            <?php if($order['MpesaCode']): ?>
                            <div style="font-size: 12px; color: #666;">Receipt: <?php echo htmlspecialchars($order['MpesaCode']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Quick Actions -->
            <h2 style="margin-top: 40px; margin-bottom: 20px; color: #333; font-size: 22px;">Quick Actions</h2>
            <div class="action-grid">
                <a href="location.php" class="action-card">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>Request Trash Pickup</span>
                </a>
                <a href="listTrash.php" class="action-card">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Completed Pickups</span>
                </a>
                <a href="editUser.php" class="action-card">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Account Settings</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>