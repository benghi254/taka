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

    <title>Worker-List</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
   
</head>
<body>
    
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>

    
    <?php include_once 'Faddress.php';

        $add=Faddress::getAllAddress();
    ?>


    <div class="body-container">
        <div class="ml-24">
            <div class="panel mb-4">
                <p>ADDRESS LIST</p>         
            </div>

            <div class="m-2">
                <a class="btn btn-primary" href="location.php">+ New address</a>
            </div>
            

            <div class="panel">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 40px">#</th>
                        
                        <th style="width: 150px">County</th>
                        <th style="width: 150px">Constituency</th>
                        <th style="width: 120px">Ward</th>
                        <th style="width: 180px">Description</th>                   
                        <th style="width: 150px">Holder</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($add as $k => $address):?>
                        <tr>
                            <td><?=$k+1;?></td>
                            
                            <td><?=$address['County'];?></td>
                            <td><?=$address['Constituency'];?></td>
                            <td><?=$address['Ward'];?></td>
                            <td><?=$address['Details'];?></td>
                            <td><?=$address['Holder'];?></td>
                            <td>                               
                                <a class="btn btn-primary" href="editWorker.php?idWorker=<?=$address['userId'];?>">Edit</a>
                                <a class="btn btn-danger" href="../controllers/deleteWorker.php?idWorker=<?=$address['userId'];?>">Delete</a>                               
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