<?php

if(isset($_GET['idPart']) && !empty($_GET['idPart']))
{
    include_once '../modals/Fcontractor.php';

    Fcontractor::deleteContractor($_GET['idPart']);
    header('Location: ../admin/listContractor.php');

}else{
    header('Location: ../admin/listContractor.php');
}