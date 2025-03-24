<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'includes/db.php';

$logs = $conn->query("SELECT v.name, v.phone, l.check_in, l.check_out 
                      FROM visitor_logs l 
                      JOIN visitors v ON l.visitor_id = v.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="reports">
        <h2>Visitor Logs</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Check-In</th>
                <th>Check-Out</th>
            </tr>
            <?php while ($log = $logs->fetch_assoc()): ?>
            <tr>
                <td><?= $log['name'] ?></td>
                <td><?= $log['phone'] ?></td>
                <td><?= $log['check_in'] ?></td>
                <td><?= $log['check_out'] ?? 'N/A' ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>