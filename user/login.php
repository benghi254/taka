<?php
session_set_cookie_params(0);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = time();


if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    include_once 'Fuser.php';
    include_once 'Faddress.php';

    $data=Fuser::login($_POST['email'],$_POST['password']);

    if(!$data)
    {
        $_SESSION['err']="Username or Password invalid";
        header('Location: userLogin.php');
        exit();
    }else{
        $_SESSION['username']=$data['fullname'];
        $_SESSION['verified']=$data['Verified'];
        $_SESSION['userId']=$data['userId'];
        $_SESSION['phone']=$data['Mobile'];
        

        $addr=Faddress::getAddressInfoById($_SESSION['userId']);
        if($addr){
            $_SESSION['area']=$addr['Ward'];
            $_SESSION['details']=$addr['Details'];
            $_SESSION['type']=$addr['Holder'];
        }

        header('Location: userDashboard.php');
        exit();
    }
}else
{
    $_SESSION['err']="Please complete all fields";
    header('Location: userLogin.php');
    exit();
}
?>