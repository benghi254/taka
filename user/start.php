<?php

session_start();

if(!isset($_SESSION['username']))
{
   //header("location: index.php"); 
}

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
   
</head>
<body>
    
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>
       
    

    <div class="body-container">
    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
               
                <form action="newTrash.php" method="post">
                    <div class="form-title">
                        <h2>Add New Trash Bin</h2>
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
                        <label><b>Weight</b></label>
                        <input type="text" placeholder="Enter approximate weight" name="weight" required>

                        

                        <select  class="custom-select" name="collectDay" required>  
                            <option value="">Select Pickup Day</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="sartuday">Sartuday</option>
                        </select>
                        <select  class="custom-select" name="trashType" required>  
                            <option value="">Select type of Trash</option>
                            <option value="hazardous">Hazardous</option>
                            <option value="recyclable">Recyclable</option>
                            <option value="wet">Wet</option>
                            <option value="dry">Dry</option>
                            <option value="other">Other</option>
                        </select>

                        <input type="hidden" value="<?=$_SESSION['userId'];?>" name="userId">
                        <input type="hidden" value="<?=$_SESSION['details'];?>" name="details">
                        <input type="hidden" value="<?=$_SESSION['area'];?>" name="area">

                        <button type="submit">Save Trash</button>

                    </div>


                </form>
            </div>
                           
        </div>
            
     
    </div>
</body>


</html>