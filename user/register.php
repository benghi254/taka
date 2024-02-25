

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
   
</head>
<body>
    
 
       

    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
                <div class="m-2 back-link">
                    <a href="userLogin.php">Login Instead</a>
                </div>
                <form action="" method="post">
                    <div class="form-title">
                        <h2>Sign Up</h2>
                    </div>
                    <div class="err-submit">
                        <?php if(isset($_SESSION['err'])):?>
                            <?=$_SESSION['err'];?>
                            <?php unset($_SESSION['err']); endif;?>
                    </div>
                    <div class="success-submit">
                        <?php if(isset($_SESSION['done'])):?>
                            <?=$_SESSION['done'];?>
                            <?php unset($_SESSION['done']); endif;?>
                    </div>
                    <div class="field-container">
                        <label><b>Full Name</b></label>
                        <input type="text" placeholder="Enter Fullname" name="fullname" required>

                        <label><b>Email</b></label>
                        <input type="text" placeholder="Email" name="email" required>

                        <label><b>Phone</label>
                        <input type="text" placeholder="Phone Number" name="phone" required>

            

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password " name="Password" required>

                        
                        
                        
                        <input type="hidden" value="NO" name="action">
                        

                        <button type="submit">Sign Up</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>
<?php

if(isset($_POST['fullname'],$_POST['email'],$_POST['phone'],$_POST['password'],$_POST['action'])
&& !empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['phone'])&& !empty($_POST['password']))
{
    include_once 'User.php';
    include_once 'Fuser.php';

    
    $user=new User(null,$_POST['fullname'],$_POST['email'],$_POST['phone'],null);

    if(FUser::checkEmail($_POST['code']))
    {
        $res=FUser::addNewUser($user);
        if(is_numeric($res))
        {
            $_SESSION['done']="User added Successfully";
            header('Location: ../userDashboard.php');
        }else{
            $_SESSION['err']="Impossible to add this Worker";
            header('Location: ../register.php');
        }
    }else
    {
        $_SESSION['err']="Id Worker already Taken";
        header('Location: ../register.php');
    }



}

    
?>