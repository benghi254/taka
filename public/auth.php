<?php
if(!isset($_SESSION))
{
    session_start();
}


if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    include_once '../user/Fuser.php';
    include_once '../user/Faddress.php';

    $data=Fuser::login($_POST['email'],$_POST['password']);

    if(!$data)
    {
        include_once '../modals/Fadmin.php';

        $data=Fadmin::login($_POST['username'],$_POST['password']);

        if(!$data)
        {
            $_SESSION['err']="Username or Password invalid";
            header('Location: login.php');
        }else{
            $_SESSION['username']=$data['username'];
            $_SESSION['fullname']=$data['lastname']." ".$data['firstname'];
            $_SESSION['role']=$data['role'];
            $_SESSION['idPart']=$data['idPart'];
            $_SESSION['dateStart']=date("Y-m-d", time());
            $_SESSION['dateEnd']=date("Y-m-d", time());

            header('Location: ../admin/dashboard.php');
        }
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

            header('location: ../user/userDashboard.php');
        }

        header('Location: ../user/userDashboard.php');
    }
}else
{
    $_SESSION['err']="Please complete all fill";
    echo $_SESSION;
   // header('Location: userLogin.php');
}