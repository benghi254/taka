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

    <title>Admin</title>

    <link rel="stylesheet" href="assets/style/menu.css">
    <link rel="stylesheet" href="assets/style/main.css">
   
</head>
<body>
    
    <?php include_once 'commons/menu.php';?>

    <?php include_once 'commons/header.php';?>
       
    

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>Choose the type of garbage Program</p>         
            </div>            

            <div class="col-3 mt-4">
                <div class="">
                    <a class="button-item button-bg-b" href="house.php">Residence</a>
                </div>
                <div class="">
                    <a class="button-item button-bg-b" href="business.php">Business</a>
                </div>  
                <div class="">
                    <a class="button-item button-bg-b" href="Institution.php">Institution</a>
                </div>               
            </div>
                   
        </div>
            
    </div>
</body>


</html>