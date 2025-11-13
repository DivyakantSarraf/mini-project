<?php
session_start(); // IMPORTANT

// Collect POST data
$username = trim($_POST['username'] ?? '');
$dob       = trim($_POST['dob'] ?? '');
$password  = trim($_POST['password'] ?? '');
$email     = trim($_POST['email'] ?? '');

// Initialize error variables
$error_username = $error_dob = $error_password = $error_email = '';

$has_error = false;

// Validation
if ($username === '') { 
    $error_username = "Please enter Username."; 
    $has_error = true; 
}

if ($dob === '') { 
    $error_dob = "Please select Date of Birth."; 
    $has_error = true; 
}

if ($password === '') { 
    $error_password = "Please enter Password."; 
    $has_error = true; 
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    $error_email = "Please enter valid email."; 
    $has_error = true; 
}

// If errors found, redirect back
if ($has_error) {
    $query = http_build_query([
        'username' => $username,
        'error_username' => $error_username,
        'dob' => $dob,
        'error_dob' => $error_dob,
        'password' => $password,
        'error_password' => $error_password,
        'email' => $email,
        'error_email' => $error_email
    ]);

    header("Location: login.php?$query");
    exit;
}

// IF NO ERROR → SAVE USER DATA IN SESSION
$_SESSION['username'] = $username;
$_SESSION['dob']      = $dob;
$_SESSION['email']    = $email;

// Redirect to menu (profile page)
header("Location: menu.php");
exit;
?>
