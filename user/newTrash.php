<?php

<<<<<<< HEAD

if(isset($_POST['weight'],$_POST['collectDay'],$_POST['area'],$_POST['details'],$_POST['trashType'],$_POST['userId'])
&& !empty($_POST['weight']) && !empty($_POST['collectDay']) && !empty($_POST['area'])&& !empty($_POST['details']))
=======
if(isset($_POST['weight'],$_POST['collectDay'],$_POST['ward'],$_POST['details'],$_POST['trashType'],$_POST['userId'])
&& !empty($_POST['weight']) && !empty($_POST['collectDay']) && !empty($_POST['ward'])&& !empty($_POST['details']))
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
{
    include_once 'trash.php';
    include_once 'Ftrash.php';
    

    
<<<<<<< HEAD
    $trash=new Trash(null,$_POST['weight'],$_POST['collectDay'],$_POST['area'],$_POST['details'],$_POST['trashType'],$_POST['userId'],null);
 
    $res=Ftrash::addNewTrash($trash);
    if(is_numeric($res))
    {
        $_SESSION['err']="Impossible to add this address";
        header('Location: location.php');
    }else{
        
        $_SESSION['done']="Trash added Successfully";
 
        
        header('Location: checkout.php');
    }
}?>
=======
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
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
