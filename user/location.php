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

    <title>location details</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
   
</head>
<body>
    
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>
       

    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
             
                <form action="newAddress.php" method="post">
                    <div class="form-title">
                        <h2>Enter Address Details</h2>
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
                        <input type="text" placeholder="Enter County" name="county" required>

                        <label><b>Constituency</b></label>
                        <input type="text" placeholder="Enter Constituency" name="constituency" required>

                        <label><b>Ward</label>
                        <input type="text" placeholder="Enter ward" name="ward" required>

                        <label><b>Description</b></label>
                        <input type="text" placeholder="Enter Description" name="details" required>

                         <select  class="custom-select" name="holder" required>
                            <option value="">Select Role</option>
                           
                            <option value="home">Home</option>
                            <option value="business">Business</option>
                            <option value="Institution">Institution</option>
                        </select>


                      
                        <input type="hidden" value="<?=$_SESSION['userId'];?>" name="userId">
                        

                        <button type="submit">Submit</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>