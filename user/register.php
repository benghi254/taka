

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
                <form action="newUser.php" method="post">
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
                        <input type="password" placeholder="Enter Password " name="password" required>

                        
                        
                        
                        <input type="hidden" value="NO" name="action">
                        

                        <button type="submit">Sign Up</button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>
