<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Hospital Registration Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link id="theme-style" rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <h1>To-do</h1>
    <p>Profile</p>
</header>

<nav>
    <ul id="nav_bar">
        <li><a href="index.html">Daily</a></li>
        <li><a href="weekly.html">Weekly</a></li>
        <li><a href="monthly.html">Monthly</a></li>
        <li><a href="yearly.html">Yearly</a></li>
        <li><a class="active" href="menu.php">Menu</a></li>
    </ul>
</nav>

<h2>Registration Form</h2>

<form method="post" action="validate.php">
<label>First Name:</label><br>
<input type="text" name="firstname" value="<?= isset($_GET['firstname']) ? htmlspecialchars($_GET['firstname']) : '' ?>">
<?php if(isset($_GET['error_firstname'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_firstname']) ?></div>
<?php endif; ?>

<label>Last Name:</label><br>
<input type="text" name="lastname" value="<?= isset($_GET['lastname']) ? htmlspecialchars($_GET['lastname']) : '' ?>">
<?php if(isset($_GET['error_lastname'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_lastname']) ?></div>
<?php endif; ?>

<label>Date of Birth:</label><br>
<input type="date" name="dob" value="<?= isset($_GET['dob']) ? htmlspecialchars($_GET['dob']) : '' ?>">
<?php if(isset($_GET['error_dob'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_dob']) ?></div>
<?php endif; ?>

<label>Password:</label><br>
<input type="password" name="password">
<?php if(isset($_GET['error_password'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_password']) ?></div>
<?php endif; ?>

<label>Phone Number:</label><br>
<input type="text" name="phone" placeholder="10-digit phone" value="<?= isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '' ?>">
<?php if(isset($_GET['error_phone'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_phone']) ?></div>
<?php endif; ?>

<label>Email:</label><br>
<input type="text" name="email" placeholder="example@gmail.com" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
<?php if(isset($_GET['error_email'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_email']) ?></div>
<?php endif; ?>

<label>Address:</label><br>
<input type="text" name="address" placeholder="Your address" value="<?= isset($_GET['address']) ? htmlspecialchars($_GET['address']) : '' ?>">
<?php if(isset($_GET['error_address'])): ?>
<div class="error"><?= htmlspecialchars($_GET['error_address']) ?></div>
<?php endif; ?>

<input type="submit" value="Submit">
</form>

<?php if(isset($_GET['success'])): ?>
<div class="success"><?= htmlspecialchars($_GET['success']) ?></div>
<?php endif; ?>

<script>
    const themeLink = document.getElementById("theme-style");
    const savedTheme = localStorage.getItem("theme");

    if (savedTheme === "light") {
        themeLink.href = "light.css";
    } else {
        themeLink.href = "style.css";
    }
</script>
</body>
</html>
