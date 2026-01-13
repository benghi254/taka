<?php

session_start();

if(!isset($_SESSION['username']))
{
   header("location: index.php"); 
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>New-Admin</title>

<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
=======
    <link rel="stylesheet" href="assets/style/menu.css">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/form.css">
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
   
</head>
<body>
    
<<<<<<< HEAD
    <?php include_once '../commons/menu.php';?>

    <?php include_once '../commons/header.php';?>
=======
    <?php include_once 'commons/menu.php';?>

    <?php include_once 'commons/header.php';?>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
       
    

    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
                <div class="m-2 back-link">
                    <a href="listAdmin.php">< Admin List ></a>
                </div>
<<<<<<< HEAD
                <form action="../controllers/newAdmin.php" method="post">
=======
                <form action="controllers/newAdmin.php" method="post">
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                    <div class="form-title">
                        <h2>Add New Admin</h2>
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
                        <label><b>First Name</b></label>
                        <input type="text" placeholder="Enter First name" name="firstname" required>
                        <label><b>Last Name</b></label>
                        <input type="text" placeholder="Enter Last name" name="lastname" required>
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>
                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>
                        <select  class="custom-select" name="role" required>
                            <option value="">Select Role</option>
                            <option <?php if($_SESSION['role']=='admin') echo ('value="admin"'); else echo ('value="admin-cont"');?>>Admin
                            </option>
                            <option value="monitor">View only</option>
                        </select>
                        

                        <button type="submit">Save User</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>