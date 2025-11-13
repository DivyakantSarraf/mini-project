<?php
session_start();

// Collect POST data
$firstname = trim($_POST['firstname'] ?? '');
$lastname  = trim($_POST['lastname'] ?? '');
$dob       = trim($_POST['dob'] ?? '');
$password  = trim($_POST['password'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$email     = trim($_POST['email'] ?? '');
$address   = trim($_POST['address'] ?? '');

// Initialize error variables
$error_firstname = $error_lastname = $error_dob = $error_password =
$error_phone = $error_email = $error_address = '';

$has_error = false;

// Validation
if ($firstname === '') { $error_firstname = "Please enter First name."; $has_error = true; }
if ($lastname === '')  { $error_lastname  = "Please enter Last name."; $has_error = true; }
if ($dob === '')       { $error_dob       = "Please select Date of Birth."; $has_error = true; }
if ($password === '')  { $error_password  = "Please enter Password."; $has_error = true; }
if ($phone === '' || !preg_match('/^[0-9]{10}$/', $phone)) { 
    $error_phone = "Please enter valid 10-digit phone."; 
    $has_error = true; 
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    $error_email = "Please enter valid email."; 
    $has_error = true; 
}
if ($address === '') { 
    $error_address = "Please enter Address."; 
    $has_error = true; 
}

// Redirect back with errors
if ($has_error) {
    $query = http_build_query([
        'firstname' => $firstname,
        'error_firstname' => $error_firstname,
        'lastname' => $lastname,
        'error_lastname' => $error_lastname,
        'dob' => $dob,
        'error_dob' => $error_dob,
        'password' => $password,
        'error_password' => $error_password,
        'phone' => $phone,
        'error_phone' => $error_phone,
        'email' => $email,
        'error_email' => $error_email,
        'address' => $address,
        'error_address' => $error_address,
    ]);

    header("Location: register.php?$query");
    exit;
}

// ----------------------------
// SAVE USER DATA IN SESSION
// ----------------------------
$_SESSION['username'] = $firstname . " " . $lastname;
$_SESSION['email']    = $email;
$_SESSION['dob']      = $dob;
$_SESSION['phone']    = $phone;
$_SESSION['address']  = $address;

// Redirect to menu page
header("Location: menu.php");
exit;
?>
