<?php

session_start();

if(!isset($_SESSION['username']))
    {
  // header("location: index.php");
  echo "what is your name"; 
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>New-user</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
   
</head>
<body>
        
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>

    <?php
        include_once 'Fuser.php';

        $user=Fuser::getInfoUserById($_GET['iduser']);
    ?>
       
    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
                <div class="m-2 back-link">
                    <a href="newuser.php">< New user ></a> ||
                    <a href="listuser.php">< user List ></a>
                </div>
                <form action="../controllers/edituser.php" method="post">
                    <div class="form-title">
                        <h2>Update USer Details</h2>
                    </div>
                    <div class="err-submit">
                        <?php if(isset($_SESSION['err'])):?>
                            <?=$_SESSION['err'];?>
                            <?php unset($_SESSION['err']); endif;?>
                    </div>
                    <div class="success-submit">
                        <?php if(isset($_SESSION['done'])):?>
                            <?=$_SESSION['done'];?>
                            <?php unset($_SESSION['done']); endif;?>
                    </div>
                    <div class="field-container">
                        <label><b>Fullname</b></label>
                        <input value="<?=$user['firstname'];?>" type="text" placeholder="Enter FirstName" name="firstname" required>
                        <input type="hidden" name="iduser" value="<?=$_GET['iduser'];?>">
                        <label><b>Email</b></label>
                        <input value="<?=$user['lastname'];?>" type="text" placeholder="Enter LastName" name="lastname" required>

                        <label><b>Mobile</b></label>
                        <input value="<?=$user['area'];?>" type="text" placeholder="Enter Area" name="area" required>

                        <label><b>Password</b></label>
                        <input value="<?=$user['iduser'];?>" type="text" placeholder="Enter Code User" name="code" required>
                        <input value="<?=$user['iduser'];?>" type="hidden" placeholder="Enter Code User" name="oldCode" required>

                        <label><b>Phone</b></label>
                        <input value="<?=$user['phone'];?>" type="text" placeholder="Enter Phone" name="phone" required>

                        <input value="<?=$_SESSION['idPart'];?>" type="hidden" name="idPart" required>


                        <button type="submit">Update user</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>