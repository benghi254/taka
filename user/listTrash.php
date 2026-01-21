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

    <title>Trash-List</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
   
</head>
<body>
    
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>

    <?php 
        include_once 'Ftrash.php';

        $trahs=Ftrash::getAllTrash();
    ?>


    <div class="body-container">
        <div class="ml-24">
            <div class="panel mb-4">
                <p>LIST OF BINS</p>         
            </div>

            <div class="m-2">
                <a class="btn btn-primary" href="newTrash.php">+ New Bin</a>
            </div>
            
            <div class="panel">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 40px">#</th>
                        <th style="width: 140px">WEIGHT(Kgs)</th>
                        <th style="width: 120px">Collection DAy</th>
                        <th style="width: 110px">AREA</th>
                        <th style="width: 110px">TYPE</th>
                        <th style="width: 90px">Date </th>
                        <th style="width: 150px">Collected</th>                    
                        <th style="width: 150px">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($trahs as $k => $trah):?>
                        <tr>
                            <td><?=$k+1;?></td>
                            <td><?=$trah['Weight'];?></td>
                            <td><?=$trah['collectDay'];?></td>
                            <td><?=$trah['Details'];?></td>
                            <td><?=$trah['trashType'];?></td>                            
                            <td><?=$trah['issueDate'];?></td>
                            <td><?=$trah['Done'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="../admin/editTrash.php?idTrash=<?=$trah['trashId'];?>">Edit</a><br>
                                <a class="btn btn-danger" href="../controllers/deleteTrash.php?idTrash=<?=$trah['trashId'];?>">Delete</a>                               
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