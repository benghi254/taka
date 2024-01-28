
<?php
require(__DIR__ . '/../form/conn.php');
include(__DIR__ . '/../form/validate.php');
require(__DIR__ . '/../form/StickyForm.php');
session_start();

if ($_SESSION && (isset($_SESSION['Admin']) || isset($_SESSION['Staff']))) {
 

    if ($_POST) {
        if (isset($_POST['chkbx']) && !empty($_POST['chkbx'])) {
            foreach ($_POST['chkbx'] as $id) {
                $del = "DELETE FROM Contact_Table WHERE contact_id ='$id';";
                $quer = mysqli_query($conn, $del);
                if ($quer>0) {
                    echo "Deletion success";
                } else {
                    echo "Could not delete";
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Table</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
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
        
        <form action="deleteContacts.php" method="POST">
            <button type="submit" name="delete" class="btn btn-danger mb-3">Delete</button>
            
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Contact</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    
                    
                    if ($_SESSION && (isset($_SESSION['Admin']) || isset($_SESSION['Staff']))) {
                        $query = "SELECT * FROM Contact_Table ;";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['contact_id'];

                            echo "
                            <tr>
                                <td>".$row['user_name']."</td>
                                <td>".$row['street_address']."</td>
                                <td>".$row['city']."</td>
                                <td>".$row['state_name']."</td>
                                <td>".$row['phone']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['dob']."</td>
                                <td>".$row['contact']."</td>
                                <td><input type='checkbox' name='chkbx[]' value='$id' /></td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>