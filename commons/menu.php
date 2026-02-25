<div class="navbar">
    <div class="h2">
        <a href="dashboard.php">Dashboard</a>
    </div>
    <div class="menu">
        <a href="monitoring.php">Monitoring</a>
        <a href="map.php">Map view</a>
        <a href="alert.php">Alert</a>
        <a href="report.php">Daily Report</a>
        <a href="listUser.php">Users</a>

    
        <?php if ($_SESSION['role']=="admin" || $_SESSION['role']=="admin-cont"):?>
            <a href="partner.php">Worker & Contrator</a>
            <a href="admin.php">Admin</a>
        <?php endif;?>
    </div>
</div>

