
<!DOCTYPE html>
<html lang="en">
<head>
    <title>add contct</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php 
    include_once(__DIR__ . '/../classes/Db_conn.php');
    include(__DIR__ . '/../classes/Validation.php');
    require(__DIR__ . '/../classes/StickyForm.php');
    
    ?>
    <div class="container mt-5">
    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link' href='addAdmin.php'>Add Admin</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='deleteAdmins.php'>Delete Admin</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='addContact.php'>Add Contact</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='deleteContacts.php'>Delete Contact</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/new/logout.php'>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
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
            <label for="status">Status:</label>
            <select name="status" class="form-group">
                <option value="" <?php echo (isset($status) && $status === "") ? 'selected' : ''; ?>>Select Status</option>
                <option value="admin" <?php echo (isset($status) && $status === "agent") ? 'selected' : ''; ?>>Agent</option>
                <option value="staff" <?php echo (isset($status) && $status === "user") ? 'selected' : ''; ?>>User</option>
            </select>
            <small class="text-danger"><?php echo $statusErr; ?></small>
            </div>

            <div class="form-group">
                <label for="passwrd">Password:</label>
                <?php generateStickyPassField("passwrd", isset($password) ? $password : "",""); ?>
                <small class="text-danger"><?php echo $passErr; ?></small>
            </div>

            
          

          

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = validateInput($_POST["name"]);  
    $phone = validateInput($_POST["phone"]);
    $email = validateInput($_POST["email"]);
    $password = validateInput($_POST["passwrd"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $status = validateInput($_POST["passwrd"]);

  

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
?>