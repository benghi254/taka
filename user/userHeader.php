
<div class="top-bar">
    <ul class="ml-24">
        <li style="font-family: Arial black; font-size: 20px;"><a href="dashboard.php">Taka</a></li>
        <li class="login-info"><?=ucwords($_SESSION['username']);?> <a href="../controllers/exit.php">(log out)</a></li>
    </ul>      
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.success-submit, .err-submit').forEach(el => {
        if (!el.textContent.trim()) {
            el.style.display = 'none';
        } else {
            el.classList.add('show-popup');
        }
    });
});
</script>