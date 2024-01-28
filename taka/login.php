<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Login</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="phone">Email</label>
                <input type="text" class="form-control" name="email" value="chris@mail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="chris" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require(__DIR__ . '/form/conn.php');
include(__DIR__ . '/form/validate.php');
require(__DIR__ . '/form/StickyForm.php');
$email = $pass = "";
if(isset($_SESSION)){
    header('location: home.php');
}
else{


    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST["email"];
        $pass= $_POST["password"];

        $sql = "SELECT * FROM user WHERE email='$email';";
        
        $result = mysqli_query($conn, $sql); session_start();   
        $_SESSION['uid'] = $row['full_name'];
                                   
        header('location: home.php');
        $num = mysqli_num_rows($result);
        if ($num == 1){
            while ($row = mysqli_fetch_assoc($result)){
                if(password_verify($pass, $row['password'])){
                    session_start();
                    $_SESSION['uid'] = $row['user_name']; 
                    if ($row['status']=='user'){
                        
                        $_SESSION['user']= $row['status'];
                                    
                        header('location: home.php? login=success');
                        
        
                        
                    }
                     
                }
 
            }
        }else{
            echo "error logging in";
        }
    }
}
        

    


?>
