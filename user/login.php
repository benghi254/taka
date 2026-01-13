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
<<<<<<< HEAD
        
=======
        $_SESSION['dateStart']=date("Y-m-d", time());
        $_SESSION['dateEnd']=date("Y-m-d", time());
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc

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
<<<<<<< HEAD
    echo $_SESSION;
   // header('Location: userLogin.php');
=======
    header('Location: userLogin.php');
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
}