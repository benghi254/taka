<?php
if(!isset($_SESSION))
{
    session_start();
}


if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    include_once 'Fuser.php';

    $data=Fuser::login($_POST['email'],$_POST['password']);

    if(!$data)
    {
        $_SESSION['err']="Username or Password invalid";
        echo "<div><p>login error</p></div>" ;
        //header('Location: userLogin.php');
    }else{
        $_SESSION['username']=$data['fullname'];
        $_SESSION['verified']=$data['Verified'];
        $_SESSION['userID']=$data['userId'];
        $_SESSION['phone']=$data['Mobile'];
        $_SESSION['dateStart']=date("Y-m-d", time());
        $_SESSION['dateEnd']=date("Y-m-d", time());

        header('Location: userDashboard.php');
    }
}else
{
    $_SESSION['err']="Please complete all fill";
    header('Location: userLogin.php');
}