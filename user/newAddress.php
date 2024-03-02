<?php

if(isset($_POST['county'],$_POST['constituency'],$_POST['ward'],$_POST['details'],$_POST['holder'],$_POST['userId'])
&& !empty($_POST['county']) && !empty($_POST['constituency']) && !empty($_POST['ward'])&& !empty($_POST['details']))
{
    include_once 'address.php';
    include_once 'Faddress.php';
    

    
    $address=new Address(null,$_POST['county'],$_POST['constituency'],$_POST['ward'],$_POST['details'],$_POST['holder'],$_POST['userId']);
 
    $res=Faddress::addNewAddress($address);
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