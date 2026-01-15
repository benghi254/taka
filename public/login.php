<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/style/form.css">

</head>
<body>

<div class="form-container">
    <form action="auth.php" method="post">
        <div class="form-title">
            <h2>Login</h2>
        </div>
        <div class="err-submit">
            <?php if(isset($_SESSION['err'])):?>
                <?=$_SESSION['err'];?>
                <?php unset($_SESSION['err']); endif;?>
            <?php if(isset($_SESSION['done'])):?>
                <?=$_SESSION['done'];?>
                <?php unset($_SESSION['done']); endif;?>
        </div>
        <div class="field-container">
            <label><b>Email or Username</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <div class="button-container">
                <button type="submit">Login</button>
            </div>

        </div>

    </form>
    <div class="m-2 back-link">
                    <a href="register.php">Create Account</a>
                </div>
</div>
</body>
</html>
