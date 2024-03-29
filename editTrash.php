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

    <title>Edit-Trash</title>

    <link rel="stylesheet" href="assets/style/menu.css">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/form.css">
   
</head>
<body>

    <?php include_once 'commons/menu.php';?>

    <?php include_once 'commons/header.php';?>

    <?php

        include_once 'modals/Ftrash.php';

        $trash=Ftrash::getTrashById($_GET['idTrash']);
    ?>
               
    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
                <div class="m-2 back-link">
                    <a href="newTrash.php">< New Bins ></a> ||
                    <a href="listTrash.php">< List of Bins ></a>
                </div>
                <form action="controllers/editTrash.php" method="post">
                    <div class="form-title">
                        <h2>Update Trash Bin</h2>
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
                        <label><b>Logitude</b></label>
                        <input value="<?=$trash['longi'];?>" type="text" placeholder="Enter Logitude" name="long" required>
                        <input type="hidden" name="idTrash" value="<?=$_GET['idTrash'];?>">
                        <label><b>Latitude</b></label>
                        <input value="<?=$trash['lat'];?>" type="text" placeholder="Enter Latitude" name="lat" required>

                        <label><b>Address</b></label>
                        <input value="<?=$trash['address'];?>" type="text" placeholder="Enter Short Address" name="address" required>

                        <label><b>Area / Zone</b></label>
                        <input value="<?=$trash['area'];?>" type="text" placeholder="Enter Address" name="area" required>

                        <label><b>Id Trash</b></label>
                        <input value="<?=$trash['idTrash'];?>" type="text" placeholder="Enter Code Trash" name="codeTras" required>

                        <select  class="custom-select" name="type" required>
                            <option value="">Select type of Trash</option>  
                            <option selected value="<?=$trash['typeTrash'];?>"><?=ucfirst($trash['typeTrash']);?></option>
                            <option value="hazardous">Hazardous</option>
                            <option value="recyclable">Recyclable</option>
                            <option value="wet">Wet</option>
                            <option value="dry">Dry</option>
                            <option value="other">Other</option>
                        </select>

                        <button type="submit">Update Trash</button>

                    </div>


                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>