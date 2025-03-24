<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'includes/db.php';
$visitors = $conn->query("SELECT * FROM visitors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, Admin!</h2>
        <a href="settings.php">Settings</a>
        <h3>Visitors List</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($visitor = $visitors->fetch_assoc()): ?>
            <tr>
                <td><?= $visitor['name'] ?></td>
                <td><?= $visitor['status'] ?></td>
                <td>
                    <a href="approve_visitor.php?id=<?= $visitor['id'] ?>">Approve</a>
                    <a href="reject_visitor.php?id=<?= $visitor['id'] ?>">Reject</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>