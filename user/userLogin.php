<?php
/*if(!isset($_SESSION))
{
    session_start();
}*/


<<<<<<< HEAD
if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
{
    include_once 'Fuser.php';
=======
if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    include_once '../modals/Fadmin.php';
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc

    $data=Fuser::login($_POST['email'],$_POST['password']);

    if(!$data)
    {
        $_SESSION['err']="Username or Password invalid";
<<<<<<< HEAD
        echo $_SESSION;
        //header('Location: ../login.php');
    }else{
        session_start();
        $_SESSION['username']=$data['fullname'];
        $_SESSION['verified']=$data['Verified'];
        $_SESSION['userId']=$data['userId'];
        $_SESSION['phone']=$data['Mobile'];
        

        header('Location: userDashboard.php');
    }
    header('Location: userDashboard.php');
=======
        //header('Location: ../login.php');
    }else{
        $_SESSION['fullname']=$data['fullname'];
        $_SESSION['action']=$data['role'];
        $_SESSION['userId']=$data['userId'];
        $_SESSION['dateStart']=date("Y-m-d", time());
        $_SESSION['dateEnd']=date("Y-m-d", time());

        header('Location: ../dashboard.php');
    }
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
}else
/*{
    $_SESSION['err']="Please complete all fill";
    header('Location: userLogin.php');
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/style/form.css">

</head>
<body>

<div class="form-container">
    <form action="login.php" method="post">
        <div class="form-title">
            <h2>Login</h2>
        </div>
        <div class="err-submit">
            <?php if(isset($_SESSION['err'])):?>
                <?=$_SESSION['err'];?>
                <?php unset($_SESSION['err']); endif;?>
            <?php if(isset($_SESSION['done'])):?>
                <?=$_SESSION['done'];?>
                <?php unset($_SESSION['done']); endif;?>
        </div>
        <div class="field-container">
<<<<<<< HEAD
            <label><b>Email</b></label>
=======
            <label><b>Username</b></label>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc
            <input type="email" placeholder="Enter Email" name="email" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

<<<<<<< HEAD
            <div class="button-container">
                <button type="submit">Login</button>
            </div>
=======
            <button type="submit">Login</button>
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc

        </div>

    </form>
    <div class="m-2 back-link">
                    <a href="register.php">Create Account</a>
                </div>
</div>
</body>
</html>
