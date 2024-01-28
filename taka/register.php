<?php
   require(__DIR__ . '/form/conn.php');
   include(__DIR__ . '/form/validate.php');
   require(__DIR__ . '/form/StickyForm.php');
   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = validateInput($_POST["name"]);  
    $phone = validateInput($_POST["phone"]);
    $email = validateInput($_POST["email"]);
    $password = validateInput($_POST["passwrd"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $status = "user";

  

    // Check for empty values
    
        $look  = "SELECT * FROM user where full_name = '$name' AND email = '$email'" ;
        $res = mysqli_query($conn, $look);
        $found = mysqli_fetch_assoc($res);
        if ($found > 0){
            echo "user already exists";
        }else{

            $sql = "INSERT INTO user(full_name, phone, password, email, status) 
                VALUES ('$name', '$phone', '$password', '$email','$status');";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo "Contact added successfully.";
                session_start();
                $_SESSION['user']= $name;
                header('location: home.php? success');

                //header('location: deleteContacts.php');
            } else {
                echo "Could not add contact.";
            }
        }
        

   
}
else {

    echo "All fields are required.";
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>sign Up</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <?php generateStickyFormField("name", isset($name) ? $name : "","Mike"); ?>
                <small class="text-danger"><?php if (isset($nameErr)) echo $nameErr; ?></small>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <?php generateStickyFormField("phone", isset($phone) ? $phone : "","0712-123-123"); ?>
                <small class="text-danger"><?php echo $phoneErr; ?></small>
            </div>

        


            <div class="form-group">
                <label for="email">Email:</label>
                <?php generateStickyFormField("email", isset($email) ? $email : "","mike1232mail.com"); ?>
                <small class="text-danger"><?php echo $mailErr; ?></small>
            </div>
            
            <div class="form-group">
                <label for="passwrd">Password:</label>
                <?php generateStickyPassField("passwrd", isset($password) ? $password : "",""); ?>
                <small class="text-danger"><?php echo $passErr; ?></small>
            </div>
            


            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>