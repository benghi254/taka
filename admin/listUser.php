<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location: index.php"); 
}

include_once '../modals/Database.php';

$conn = Database::getConnection();

// Query to get users with their trash count and total spent
$sql = "SELECT 
            u.userId, 
            u.fullname, 
            u.Email, 
            u.Mobile,
            (SELECT COUNT(*) FROM trash t WHERE t.userId = u.userId) as trashCount,
            (SELECT IFNULL(SUM(Amount), 0) FROM orders o WHERE o.userId = u.userId AND o.ResultCode = '0') as totalSpent
        FROM user u
        ORDER BY u.fullname ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Usage Report</title>
    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <style>
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .stats-table th, .stats-table td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .stats-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        .stats-table tr:hover {
            background-color: #fcfcfc;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-count {
            background-color: #e0f2fe;
            color: #0369a1;
        }
        .badge-amount {
            background-color: #dcfce7;
            color: #15803d;
        }
    </style>
</head>
<body>
    
    <?php include_once '../commons/menu.php';?>
    <?php include_once '../commons/header.php';?>

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>USER USAGE REPORT</p>         
            </div>

            <div class="panel">
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Trash Bins Created</th>
                            <th>Total Spent (KES)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($users)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No users found in the system.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($users as $k => $user): ?>
                                <tr>
                                    <td><?= $k + 1; ?></td>
                                    <td><?= htmlspecialchars($user['fullname']); ?></td>
                                    <td><?= htmlspecialchars($user['Email']); ?></td>
                                    <td><?= htmlspecialchars($user['Mobile']); ?></td>
                                    <td>
                                        <span class="badge badge-count"><?= $user['trashCount']; ?> bins</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-amount">KES <?= number_format($user['totalSpent'], 2); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
