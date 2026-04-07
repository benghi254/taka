<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['password']) && !empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['password']))
{
    include_once 'Fuser.php';
    include_once 'User.php';

    // Check if email already exists
    if(!Fuser::checkEmail($_POST['email']))
    {
        $_SESSION['err']="Email already exists";
        header('Location: register.php');
        exit();
    }

    $user = new User();
    $user->setFullname($_POST['fullname']);
    $user->setEmail($_POST['email']);
    $user->setPhone($_POST['phone']);
    $user->setPassword($_POST['password']);
    $user->setAction('False'); // Default verified status

    $newUserId = Fuser::addNewUser($user);

    if($newUserId) {
        $_SESSION['username'] = $_POST['fullname'];
        $_SESSION['verified'] = 'False';
        $_SESSION['userId'] = $newUserId;
        $_SESSION['phone'] = $_POST['phone'];
        
        $_SESSION['done'] = "Registration successful. Welcome!";
        header('Location: userDashboard.php');
        exit();
    } else {
        $_SESSION['err'] = "Registration failed. Please try again.";
        header('Location: register.php');
        exit();
    }
}else
{
    $_SESSION['err']="Please complete all fields";
    header('Location: register.php');
    exit();
}
?>