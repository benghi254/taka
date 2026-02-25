<div class="top-bar">
    <ul class="ml-24">
        <span class="menu-toggle" id="sidebarToggle">&#9776;</span>
        <li style="font-family: Arial black; font-size: 20px;"><a href="dashboard.php">Taka</a></li>
        <li class="login-info"><?=ucwords($_SESSION['fullname']);?> <a href="../controllers/exit.php">(log out)</a></li>
    </ul>      
</div>

<script>
document.getElementById('sidebarToggle').addEventListener('click', function() {
    const navbar = document.querySelector('.navbar');
    const ml24 = document.querySelector('.ml-24');
    const topBarUl = document.querySelector('.top-bar ul');
    
    if (window.innerWidth > 900) {
        // Desktop Collapse
        navbar.classList.toggle('collapsed');
        if (navbar.classList.contains('collapsed')) {
            document.documentElement.style.setProperty('--sidebar-width', '0px');
        } else {
            document.documentElement.style.setProperty('--sidebar-width', '230px');
        }
    } else {
        // Mobile Toggle
        navbar.classList.toggle('active');
    }
});
</script>
