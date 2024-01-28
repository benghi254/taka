
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Page</title>
    
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
        <form action="deleteAdmins.php" method="POST">
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
       

        <table class="table table-bordered table-striped table-hover" id="myTable">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once(__DIR__ . '/../classes/Db_conn.php');
                if ($_SESSION && isset($_SESSION['Admin'])) {
                    $query = "SELECT * FROM Admin_table;";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td><input type='checkbox' name='chkbx[]' value='" . $row['admin_id'] . "' /></td>";
                        echo "</tr>";
                    }

                   
                }
                ?>
            </tbody>
        </table>
        </form>
        <?php
         if ($_POST) {
            if (isset($_POST['chkbx']) && !empty($_POST['chkbx'])) {
                foreach ($_POST['chkbx'] as $id) {
                    $del = "DELETE FROM Admin_table WHERE admin_id = '$id';";
                    $quer = mysqli_query($conn, $del);
                    if ($quer) {
                        echo "Deletion success";
                    } else {
                        echo "Could not delete";
                    }
                }
            }
        }
        ?>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>