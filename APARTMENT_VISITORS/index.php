<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <h1>Welcome to Our Apartment</h1>
        <nav class="navbar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#register">Register as Visitor</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="admin_login.php?redirect=recent_visitors.php">Recent Visitors</a></li> <!-- Always Redirect to Login -->
                <?php if ($isLoggedIn): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="admin_login.php">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="home" class="home-section">
        <h2>Welcome</h2>
        <p>We are committed to providing a safe and welcoming environment.</p>
    </section>

    <footer class="footer">
        <p>&copy; 2023 Apartment Management System</p>
    </footer>
</body>
</html>