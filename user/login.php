<?php
if(!isset($_SESSION))
{
    session_start();
}


if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    include_once 'Fuser.php';
    include_once 'Faddress.php';

    $data=Fuser::login($_POST['email'],$_POST['password']);

    if(!$data)
    {
        $_SESSION['err']="Username or Password invalid";
        echo "<div><p>login error</p></div>" ;
        //header('Location: userLogin.php');
    }else{
        $_SESSION['username']=$data['fullName'];
        $_SESSION['verified']=$data['Verified'];
        $_SESSION['userId']=$data['userId'];
        $_SESSION['phone']=$data['Mobile'];
        

        $addr=Faddress::getAddressInfoById($_SESSION['userId']);
        if($addr){
            $_SESSION['area']=$addr['Ward'];
            $_SESSION['details']=$addr['Details'];
            $_SESSION['type']=$addr['Holder'];

            header('location: userDashboard.php');
        }

        header('Location: userDashboard.php');
    }
}else
{
    $_SESSION['err']="Please complete all fill";
    header('Location: userLogin.php');
}