<?php
include_once '../commons/auth.php';

if(isset($_POST['weight'],$_POST['collectDay'],$_POST['area'],$_POST['details'],$_POST['trashType'],$_POST['userId'])
&& !empty($_POST['weight']) && !empty($_POST['collectDay']) && !empty($_POST['area'])&& !empty($_POST['details']))
{
    include_once 'trash.php';
    include_once 'Ftrash.php';
    
    $trash=new Trash(null,$_POST['weight'],$_POST['collectDay'],$_POST['area'],$_POST['details'],$_POST['trashType'],$_POST['userId'],null);
 
    $res=Ftrash::addNewTrash($trash);
    if(is_numeric($res))
    {
        $_SESSION['err']="Impossible to add this address";
        header('Location: location.php');
        exit;
    }else{
        $_SESSION['done']="Trash added Successfully";
        header('Location: checkout.php');
        exit;
    }
} else {
    $_SESSION['err'] = "Please fill in all the required fields, including location details. Make sure you set your address properly.";
    header('Location: start.php');
    exit;
}
?>
