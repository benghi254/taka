
<?php
// Define variables to store user input and error messages
$name = $address = $city = $phone = $state = $dob = $email = $contact = "";
$nameErr = $addErr = $cityErr = $phoneErr = $stateErr = $dobErr = $mailErr = $passErr= $conatctErr = $statusErr = "";

// Function to sanitize and validate input
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = validateInput($_POST["name"]);
        // Check if name contains only letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate Address
    if (empty($_POST["address"])) {
        $addErr = "Address is required";
    } else {
        $address = validateInput($_POST["address"]);
        // Additional validation for address if needed
    }

    // Validate City
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = validateInput($_POST["city"]);
        // Additional validation for city if needed
    }

    // Validate Phone
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = validateInput($_POST["phone"]);
       
        if (!preg_match("/^\d{10}$/", $phone)) {
            $phoneErr = "Invalid phone number format. Please enter in the format 0712.123.123.";
        }
    }

    // Validate State
    if (empty($_POST["state"])) {
        $stateErr = "State is required";
    } else {
        $state = validateInput($_POST["state"]);
       
    }
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
    } else {
        $password = validateInput($_POST["password"]);
       
    }




    // Validate Email
    if (empty($_POST["email"])) {
        $mailErr = "Email is required";
    } else {
        $email = validateInput($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Invalid email format";
        }
    }

    // Validate Contact
    if (empty($_POST["contact"])) {
        $conatctErr = "Contact is required";
    } else {
        $contact = validateInput($_POST["contact"]);
        
    }
    if (empty($_POST["status"])) {
        $statusErr = "Contact is required";
    } else {
        $status = validateInput($_POST["status"]);
        
    }

    
}