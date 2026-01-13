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

    <title>Contractor-List</title>

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

    
    <?php include_once '../modals/Fcontractor.php';
=======
    <?php include_once 'commons/menu.php';?>

    <?php include_once 'commons/header.php';?>

    
    <?php include_once 'modals/Fcontractor.php';
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
        $contractors=Fcontractor::getAllContractor();
    ?>


    <div class="body-container">
        <div class="ml-24">
            <div class="panel mb-4">
                <p>CONTRACTOR LIST</p>         
            </div>

            <div class="m-2">
                <a class="btn btn-primary" href="newContractor.php">+ New Contractor</a>
            </div>
            

            <div class="panel">
                <table class="fl-table">
                    <thead>
                    <tr>
                        <th style="width: 40px">#</th>
                        <th>NAME</th>
                        <th style="width: 120px">USERNAME</th>
                        <th>ADDRESS</th>
                        <th style="width: 130px">PHONE</th>
                        <th style="width: 110px">AREA / ZONE</th>
                        <th style="width: 180px">DATE CREATED</th>
                        <th style="width: 150px">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($contractors as $k => $data):?>
                        <tr>
                            <td><?=$k+1;?></td>
                            <td><?=$data['namePart'];?></td>
                            <td><?=$data['username'];?></td>
                            <td><?=$data['address'];?></td>
                            <td><?=$data['phone'];?></td>
                            <td><?=$data['area'];?></td>
                            <td><?=$data['date_add'];?></td>
                            <td>
                                <a class="btn btn-primary" href="editContractor.php?idPart=<?=$data['_idPart'];?>">Edit</a>
<<<<<<< HEAD
                                <a class="btn btn-danger" href="../controllers/deleteContractor.php?idPart=<?=$data['_idPart'];?>">Delete</a>
=======
                                <a class="btn btn-danger" href="controllers/deleteContractor.php?idPart=<?=$data['_idPart'];?>">Delete</a>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <tbody>
                </table>
            </div>
                   
        </div>
            
    </div>
</body>

</html>