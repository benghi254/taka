<?php
session_set_cookie_params(0);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = time();


if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    include_once '../modals/Fadmin.php';

    $data=Fadmin::login($_POST['username'],$_POST['password']);

    if(!$data)
    {
        $_SESSION['err']="Username or Password invalid";
        header('Location: ../admin/login.php');
        exit();
    }else{
        $_SESSION['username']=$data['username'];
        $_SESSION['fullname']=$data['lastname']." ".$data['firstname'];
        $_SESSION['role']=$data['role'];
        $_SESSION['idPart']=$data['idPart'];
        $_SESSION['dateStart']=date("Y-m-d", time());
        $_SESSION['dateEnd']=date("Y-m-d", time());

        header('Location: ../admin/dashboard.php');
        exit();
    }
}else
{
    $_SESSION['err']="Please complete all fields";
    header('Location: ../admin/login.php');
    exit();
}
?>