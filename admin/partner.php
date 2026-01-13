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

    <title>Partners</title>

<<<<<<< HEAD
    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
=======
    <link rel="stylesheet" href="assets/style/menu.css">
    <link rel="stylesheet" href="assets/style/main.css">
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
            <div class="panel">
                <p>WORKER & CONTRACTOR MANAGEMENT</p>         
            </div>
            <div class="col-3 mt-4">
                <div class="mt-0">
                    <a class="button-item button-bg-b" href="newWorker.php">New Worker</a>
                </div>
                <div class="mt-0">
                    <a class="button-item button-bg-b" href="listWorker.php">List of Workers</a>
                </div>

                <?php if($_SESSION['role']=='admin'):?> 
                    <div class="mt-0">
                        <a class="button-item button-bg-b" href="newContractor.php">New Contractor</a>
                    </div> 
                    <div class="mt-2">
                        <a class="button-item button-bg-b" href="listContractor.php">List of Contractors</a>
                    </div> 
                <?php endif; ?>
                             
            </div>
                               

        </div>
            
    </div>
</body>


</html>