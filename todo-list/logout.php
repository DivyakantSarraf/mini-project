<?php
session_start();
session_unset();     // Remove all session variables
session_destroy();   // Destroy session completely

// Redirect to login page
header("Location: login.php");
exit;
?>
