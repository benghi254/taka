
<!DOCTYPE html>
<html lang="en">
<head>
    <title>add contct</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<?php 
require(__DIR__ . '/../form/conn.php');
include(__DIR__ . '/../form/validate.php');
require(__DIR__ . '/../form/StickyForm.php');
    
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
                <label for="name">Name:</label>
                <?php generateStickyFormField("name", isset($name) ? $name : $nameErr); ?>
                <small class="text-danger"><?php if (isset($nameErr)) echo $nameErr; ?></small>
            </div>
            <div class="form-group">

            <label for="email">Email:</label>
                <?php generateStickyFormField("email", isset($email) ? $email : ""); ?>
                <small class="text-danger"><?php echo $mailErr; ?></small>
            </div>
            <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-group">
                <option value="" <?php echo (isset($status) && $status === "") ? 'selected' : ''; ?>>Select Status</option>
                <option value="admin" <?php echo (isset($status) && $status === "admin") ? 'selected' : ''; ?>>Admin</option>
                <option value="staff" <?php echo (isset($status) && $status === "staff") ? 'selected' : ''; ?>>Staff</option>
            </select>
            <small class="text-danger"><?php echo $statusErr; ?></small>
            </div>

            <div class="form-group">
                <label for="dob">Password:</label>
                <?php generateStickyFormField("password", isset($password) ? $password : ""); ?>
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
    $username = validateInput($_POST["name"]);
    $email = validateInput($_POST["email"]);
    $password = validateInput($_POST["password"]); 
    $password = password_hash($password, PASSWORD_DEFAULT); 

    $status = validateInput($_POST["status"]);
    if (empty($username) || empty($email) || empty($password) || empty($status)){
        echo "all fields are required";
    }else{
        $check = "SELECT * FROM Admin_table WHERE email='$email';";
    $rs = mysqli_query($conn, $check);

    if (mysqli_fetch_assoc($rs)) {
        $mailErr = "email already exists";
    } else {
        $sql = "INSERT INTO Admin_table(user_name, email, password) VALUES ('$username','$email','$password');";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            //header("location: welcome.php?addition=successfuly");
            echo "<h1> record added successfuly<h1>";
        } else {
            echo "<h1>could not add Admin<h1>";
        }
    }
    

    }
    
  

    
}
?>
