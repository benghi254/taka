<?php

if(isset($_POST['weight'],$_POST['collectDay'],$_POST['ward'],$_POST['details'],$_POST['trashType'],$_POST['userId'])
&& !empty($_POST['weight']) && !empty($_POST['collectDay']) && !empty($_POST['ward'])&& !empty($_POST['details']))
{
    include_once 'trash.php';
    include_once 'Ftrash.php';
    

    
    $trash=new Address(null,$_POST['weight'],$_POST['collectDay'],$_POST['area'],$_POST['details'],$_POST['trashType'],$_POST['userId']);
 
    $res=Faddress::addNewTrash($trash);
        if(is_numeric($res))
        {
            $_SESSION['err']="Impossible to add this address";
            header('Location: location.php');
        }else{
            
            $_SESSION['done']="Address added Successfully";
            header('Location: userDashboard.php');
        }
 


}

    
?>