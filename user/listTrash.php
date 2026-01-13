<?php

session_start();

if(!isset($_SESSION['username']))
{
  // header("location: index.php"); 
}

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin-List</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
   
</head>
<body>

    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>

    
    <?php include_once 'Ftrash.php';
        if($_SESSION['role']=='admin'){
            $trash=Ftrash::getAllTrash();
            
        }

        else {
            $trash=Ftrash::getTrashInfoById($_SESSION['userId']);
            $internalUsers=array();
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
                    <?php foreach ($internalUsers as $k => $user):?>
                        <tr>
                            <td><?=$k+1;?></td>
                            <td><?=$user['username'];?></td>
                            <td><?=ucwords($user['lastname']." ".$user['firstname']);?></td></td>
                            <td>-</td>
                            <td><?=$user['role'];?></td>
                            <td><?=$user['date_created'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="editAdmin.php?idAdmin=<?=$user['_idAdmin'];?>">Edit</a>

                                <?php $href="../controllers/deleteAdmin.php?idAdmin=".$user['_idAdmin']."&idPart=".$user['idPart']; ?>

                                <a class="btn btn-danger" href=<?=$href; ?>>Delete</a>                               
                            </td>
                        </tr>
                    <?php endforeach;?>

                    <?php foreach ($users as $j => $user):?>
                        <tr>
                            <td><?=$j+$k+2;?></td>
                            <td><?=$user['username'];?></td>
                            <td><?=ucwords($user['lastname']." ".$user['firstname']);?></td></td>
                            <td><?=ucfirst($user['namePart']);?></td>
                            <td><?=$user['role'];?></td>
                            <td><?=$user['date_created'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="editAdmin.php?idAdmin=<?=$user['_idAdmin'];?>">Edit</a>

                                <?php $href="../controllers/deleteAdmin.php?idAdmin=".$user['_idAdmin']."&idPart=".$user['idPart'];?>

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