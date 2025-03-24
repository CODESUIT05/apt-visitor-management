<?php
session_start();

// Redirect to admin login if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php?redirect=recent_visitors.php");
    exit;
}

include 'includes/db.php';

// Fetch the 10 most recent visitors
$recent_visitors = $conn->query("SELECT name, phone, email, purpose, created_at 
                                  FROM visitors 
                                  ORDER BY created_at DESC 
                                  LIMIT 10");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Visitors</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <h1>Recent Visitors</h1>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="recent-visitors-page">
        <h2> Recent Visitors</h2>
        <?php if ($recent_visitors->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Purpose</th>
                    <th>Date</th>
                </tr>
                <?php while ($visitor = $recent_visitors->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($visitor['name']) ?></td>
                    <td><?= htmlspecialchars($visitor['phone']) ?></td>
                    <td><?= htmlspecialchars($visitor['email']) ?></td>
                    <td><?= htmlspecialchars($visitor['purpose']) ?></td>
                    <td><?= htmlspecialchars($visitor['created_at']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No recent visitors found.</p>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>&copy; 2023 Apartment Management System</p>
    </footer>
</body>
</html>