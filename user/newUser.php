<?php

if(isset($_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['password'],$_POST['action'])
&& !empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['phone'])&& !empty($_POST['password']))
{
    include_once 'User.php';
    include_once 'Fuser.php';
    

    
    $user=new User(null,$_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['password'],$_POST['action'],null);
 
    if(FUser::checkEmail($_POST['email']))
    {
        $data=FUser::addNewUser($user);
        if(is_numeric($data))
        {
            $_SESSION['err']="Impossible to add this Worker";
            header('Location: register.php');
        }else{
            session_start();
            
            $_SESSION['done']="User added Successfully";
            $_SESSION['username']=$data['fullName'];
            $_SESSION['verified']=$data['Verified'];
            $_SESSION['userId']=$data['userId'];
            $_SESSION['phone']=$data['Mobile'];
            header('Location: userDashboard.php');
        }
    }else
    {
        $_SESSION['err']="Id Worker already Taken";
        header('Location: register.php');
    }



}

    
?>