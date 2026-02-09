<?php
if(!isset($_SESSION))
{
    session_start();
}


if(isset($_POST['login'],$_POST['password']) && !empty($_POST['login']) && !empty($_POST['password']))
{
    include_once '../user/Fuser.php';
    include_once '../user/Faddress.php';
    include_once '../modals/Fadmin.php';

    $login = trim($_POST['login']);
    $password = $_POST['password'];
    
    // Determine if it's an email (contains @) or username
    $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);
    
    if($isEmail) {
        // Try user login with email
        $data = Fuser::login($login, $password);
        
        if($data) {
            $_SESSION['username']=$data['fullName'];
            $_SESSION['verified']=$data['Verified'];
            $_SESSION['userId']=$data['userId'];
            $_SESSION['phone']=$data['Mobile'];
            $_SESSION['email']=$data['Email'];
            
            $addr=Faddress::getAddressInfoById($_SESSION['userId']);
            if($addr){
                $_SESSION['area']=$addr['Ward'];
                $_SESSION['details']=$addr['Details'];
                $_SESSION['type']=$addr['Holder'];
            }
            
            header('Location: ../user/userDashboard.php');
            exit;
        }
    } else {
        // Try admin login with username
        $data = Fadmin::login($login, $password);
        
        if($data) {
            $_SESSION['username']=$data['username'];
            $_SESSION['fullname']=$data['lastname']." ".$data['firstname'];
            $_SESSION['role']=$data['role'];
            $_SESSION['idPart']=$data['idPart'];
            $_SESSION['dateStart']=date("Y-m-d", time());
            $_SESSION['dateEnd']=date("Y-m-d", time());
            
            header('Location: ../admin/dashboard.php');
            exit;
        }
    }
    
    // If we get here, login failed
    $_SESSION['err']="Invalid email/username or password";
    header('Location: login.php');
    exit;
    
}else
{
    $_SESSION['err']="Please complete all fields";
    header('Location: login.php');
    exit;
}