<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>

    <!-- Default theme is dark -->
    <link id="theme-style" rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<header>
    <h1>To-do</h1>
    <p>Menu</p>

    <nav>
    <ul id="nav_bar">
        <li><a href="index.html">Daily</a></li>
        <li><a href="weekly.html">Weekly</a></li>
        <li><a href="monthly.html">Monthly</a></li>
        <li><a href="yearly.html">Yearly</a></li>
        <li><a class="active" href="menu.php">Menu</a></li>
    </ul>
    </nav>
</header>

<div class="menu-container">

    <!-- PROFILE INFO -->
    <div class="card">
        <h2>Profile Info</h2>
        <p id="li"><strong>Name:</strong> <?= $_SESSION['username'] ?? 'Guest User' ?></p>
        <p id="li"><strong>Email:</strong> <?= $_SESSION['email'] ?? 'Not set' ?></p>
        <p id="li"><strong>Date of birth:</strong> <?= $_SESSION['dob'] ?? 'Not set' ?></p><br>
        <a href="login.php" class="menu-login"><button>Login</button></a>
        <a href="register.php" class="menu-login"><button >Register</button></a>
        <a href="logout.php" class="menu-logout"><button >Logout</button></a>
    </div>

    <!-- 1. THEME TOGGLE -->
    <div class="card">
        <h2>Theme</h2>
        <label class="toggle-label">
            Light Mode
            <input type="checkbox" id="theme-toggle">
        </label>
    </div>

    <!-- 5. TIPS SECTION -->
    <div class="card">
        <h2>Tips</h2>
        <ul id="tip_ul">
            <li>Use Daily for simple tasks.</li>
            <li>Use Weekly for study planning.</li>
            <li>Use Monthly for goals.</li>
            <li>Use Yearly for long-term plans.</li>
        </ul>
    </div>

    <!-- SHORTCUT GUIDE -->
    <div class="card">
        <h2>Shortcut Guide</h2>
        <ul id="tip_ul">
            <li><strong>Enter</strong> → Add new task</li>
            <li><strong>Double Click</strong> → Edit task</li>
            <li><strong>Hover</strong> → Show due date</li>
            <li><strong>Delete Button</strong> → Remove task</li>
            <li><strong>Checkbox</strong> → Mark as complete</li>
        </ul>
    </div>

    <!-- 2. CLEAR ALL TASKS -->
    <div class="card">
        <h2>Clear All Tasks</h2>
        <button id="clear-all">Clear Everything</button>
    </div>

    <!-- 3. ABOUT APP -->
    <div class="card">
        <h2>About</h2>
        <p id="li">
            This Todo App is designed to help you stay organized and productive by managing your 
            daily, weekly, monthly, and yearly tasks in one place. It offers a clean interface, 
            simple controls, and a smooth workflow so you can focus on completing your goals 
            rather than managing them.  
        </p>
        <p id="li">
            Whether it's your everyday routine, study plans, long-term projects, or yearly 
            resolutions, this app keeps everything neatly arranged and easy to access.
        </p>
    </div>

    <!-- 4. VERSION INFO -->
    <div class="card">
        <h2>Version</h2>
        <p id="li">App Version: 1.0</p>
        <p id="li">Developer: Divyakant</p>
    </div>

</div>

<!-- SCRIPT -->
<script>
    const themeToggle = document.getElementById("theme-toggle");
    const themeLink = document.getElementById("theme-style");

    // Load saved theme
    if (localStorage.getItem("theme") === "light") {
        themeToggle.checked = true;
        themeLink.href = "light.css";
    }

    // Change theme when checkbox clicked
    themeToggle.addEventListener("change", () => {
        if (themeToggle.checked) {
            themeLink.href = "light.css";
            localStorage.setItem("theme", "light");
        } else {
            themeLink.href = "style.css";
            localStorage.setItem("theme", "style");
        }
    });

    // Clear everything
    document.getElementById("clear-all").addEventListener("click", () => {
        if (confirm("Delete ALL tasks from ALL lists?")) {
            localStorage.clear();
            alert("All tasks cleared!");
        }
    });
</script>

<footer class="footer">
    <p>© 2025 Todo • Designed by Divyakant</p>
</footer>
</body>
</html>
