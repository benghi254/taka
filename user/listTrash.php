<?php

session_start();

if(!isset($_SESSION['tr$trashname']))
{
  // header("location: index.php"); 
}

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TrashList</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
   
</head>
<body>

    <?php include_once 'tr$trashMenu.php';?>

    <?php include_once 'tr$trashHeader.php';?>

    
    <?php include_once 'Ftrash.php';
        if($_SESSION['role']=='admin'){
            $trash=Ftrash::getAllTrash();
            
        }

        else {
            $trash=Ftrash::getTrashInfoById($_SESSION['tr$trashId']);
            $internaltr$trashs=array();
            $k=-1;
        }
    ?>

       

    <div class="body-container">
        <div class="ml-24">
            <div class="panel mb-4">
                <p>Trash List</p>         
            </div>

            <div class="m-2">
                <a class="btn btn-primary" href="start.php">+ New Trash</a>
            </div>
            

            <div class="panel">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 40px">#</th>
                        <th style="width: 140px">Weight</th>
                        <th>Collect Day</th>
                        <th style="width: 150px">Trashtype</th>
                        <th style="width: 150px">Collection status</th>
                        <th style="width: 180px">Aleet Date</th>                    
                        <th style="width: 150px">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($internaltr$trashs as $k => $trash):?>
                        <tr>
                            <td><?=$k+1;?></td>
                            <td><?=$trash['Weight'];?></td>
                            <td><?=ucwords($trash['lastname']." ".$trash['firstname']);?></td></td>
                            <td>-</td>
                            <td><?=$trash['role'];?></td>
                            <td><?=$trash['date_created'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="editAdmin.php?idAdmin=<?=$trash['_idAdmin'];?>">Edit</a>

                                <?php $href="../controllers/deleteAdmin.php?idAdmin=".$trash['_idAdmin']."&idPart=".$trash['idPart']; ?>

                                <a class="btn btn-danger" href=<?=$href; ?>>Delete</a>                               
                            </td>
                        </tr>
                    <?php endforeach;?>

                    <?php foreach ($trashs as $j => $trash):?>
                        <tr>
                            <td><?=$j+$k+2;?></td>
                            <td><?=$trash['tr$trashname'];?></td>
                            <td><?=ucwords($trash['lastname']." ".$trash['firstname']);?></td></td>
                            <td><?=ucfirst($trash['namePart']);?></td>
                            <td><?=$trash['role'];?></td>
                            <td><?=$trash['date_created'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="editAdmin.php?idAdmin=<?=$trash['_idAdmin'];?>">Edit</a>

                                <?php $href="../controllers/deleteAdmin.php?idAdmin=".$trash['_idAdmin']."&idPart=".$trash['idPart'];?>

                                <a class="btn btn-danger" href=<?=$href; ?>>Delete</a>                               
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