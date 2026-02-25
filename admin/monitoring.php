<?php
session_start();

if(!isset($_SESSION['username']))
{
   header("location: index.php"); 
}

include_once '../modals/Database.php';

$conn = Database::getConnection();

// 1. Data for User Growth (Total users by date)
$userGrowthQuery = "SELECT DateCreated, COUNT(*) as count FROM user GROUP BY DateCreated ORDER BY DateCreated ASC";
$userGrowthStmt = $conn->prepare($userGrowthQuery);
$userGrowthStmt->execute();
$userGrowthData = $userGrowthStmt->fetchAll(PDO::FETCH_ASSOC);

$userLabels = [];
$userCounts = [];
$runningTotal = 0;
foreach($userGrowthData as $row) {
    $runningTotal += $row['count'];
    $userLabels[] = $row['DateCreated'];
    $userCounts[] = $runningTotal;
}

// 2. Data for Revenue Over Time (Sum of Amount by date)
$revenueQuery = "SELECT TransactionDate, SUM(Amount) as total FROM orders WHERE ResultCode = '0' GROUP BY TransactionDate ORDER BY TransactionDate ASC";
$revenueStmt = $conn->prepare($revenueQuery);
$revenueStmt->execute();
$revenueData = $revenueStmt->fetchAll(PDO::FETCH_ASSOC);

$revenueLabels = [];
$revenueTotals = [];
foreach($revenueData as $row) {
    $revenueLabels[] = $row['TransactionDate'];
    $revenueTotals[] = $row['total'];
}

// 3. Data for Waste Type Distribution
$wasteTypeQuery = "SELECT trashType, COUNT(*) as count FROM trash GROUP BY trashType";
$wasteTypeStmt = $conn->prepare($wasteTypeQuery);
$wasteTypeStmt->execute();
$wasteTypeData = $wasteTypeStmt->fetchAll(PDO::FETCH_ASSOC);

$wasteLabels = [];
$wasteCounts = [];
foreach($wasteTypeData as $row) {
    $wasteLabels[] = $row['trashType'] ? ucfirst($row['trashType']) : 'Unknown';
    $wasteCounts[] = $row['count'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Analytics - Taka</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">

    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            padding: 20px;
        }
        .chart-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }
        .chart-card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-family: Arial;
            color: #444;
            font-size: 18px;
            text-align: center;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 10px;
        }
        @media (max-width: 600px) {
            .charts-container {
                grid-template-columns: 1fr;
                padding: 10px;
            }
        }
    </style>
   
</head>
<body>
    <div>
        <?php include_once '../commons/menu.php';?>
        <?php include_once '../commons/header.php';?>
    </div>

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>SYSTEM ANALYTICS</p>         
            </div>

            <!-- Charts Section Only -->
            <div class="charts-container">
                <div class="chart-card">
                    <h3>User Accumulation</h3>
                    <canvas id="userChart"></canvas>
                </div>
                <div class="chart-card">
                    <h3>Success Revenue Collection (KES)</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="chart-card" style="grid-column: span 1;">
                    <h3>Waste Category Breakdown</h3>
                    <canvas id="wasteChart"></canvas>
                </div>
            </div>
                   
        </div>
    </div>

    <script>
        // User Growth Chart
        new Chart(document.getElementById('userChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($userLabels); ?>,
                datasets: [{
                    label: 'Total Users',
                    data: <?php echo json_encode($userCounts); ?>,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#2563eb'
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Revenue Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($revenueLabels); ?>,
                datasets: [{
                    label: 'Daily Revenue',
                    data: <?php echo json_encode($revenueTotals); ?>,
                    backgroundColor: '#10b981',
                    borderRadius: 5
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'KES ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Waste Type Chart
        new Chart(document.getElementById('wasteChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($wasteLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($wasteCounts); ?>,
                    backgroundColor: [
                        '#3b82f6', // blue
                        '#10b981', // green
                        '#f59e0b', // amber
                        '#ef4444', // red
                        '#8b5cf6', // violet
                        '#ec4899'  // pink
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
