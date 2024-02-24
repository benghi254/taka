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

    <title>Register</title>

    <link rel="stylesheet" href="assets/style/menu.css">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/form.css">
   
</head>
<body>
    
    <?php include_once 'commons/menu.php';?>

    <?php include_once 'commons/header.php';?>
       

    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
                <div class="m-2 back-link">
                    <a href="userLogin.php">Login Instead</a>
                </div>
                <form action="controllers/newWorker.php" method="post">
                    <div class="form-title">
                        <h2>Add New Worker</h2>
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
                        <label><b>County</b></label>
                        <input type="text" placeholder="Enter FirstName" name="firstname" required>

                        <label><b>Constituency</b></label>
                        <input type="text" placeholder="Enter LastName" name="lastname" required>

                        <label><b>Ward</label>
                        <input type="text" placeholder="Enter Email Address" name="email" required>

                        <label><b>Description</b></label>
                        <input type="number" placeholder="Enter Phone" name="phone" required>

                         <select  class="custom-select" name="role" required>
                            <option value="">Select Role</option>
                           
                            <option value="home">Home</option>
                            <option value="business">Business</option>
                            <option value="Institution">Institution</option>
                        </select>


                      
                        <input type="hidden" value="<?=$_SESSION['UserId'];?>" name="UserId">
                        

                        <button type="submit">Submit</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>