<?php
include_once '../commons/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/style/form.css">

</head>
<body>

<div class="form-container">
    <form action="stk_push.php" method="post">
        <div class="form-title">
            <h2>CheckOUT</h2>
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
            <label><b>Phone Number</b></label>
            <input type="text" placeholder="071234...." name="phone" required>

            <label><b>Amount</b></label>
            <input type="text" placeholder="100" name="amount" required>

            <div class="button-container">
                <button type="submit">Pay Now</button>
            </div>
            <?php echo $_SESSION['userId']?>

        </div>

    </form>
    <div class="m-2 back-link">
                    <a href="userDashboard.php">Pay Later</a>
                </div>
</div>
</body>
</html>
