<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $visitor_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM visitors WHERE id = ?");
    $stmt->bind_param("i", $visitor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $visitor = $result->fetch_assoc();
    } else {
        die("Visitor not found");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visitor Pass</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="visitor-pass">
        <h2>Visitor Pass</h2>
        <p><strong>Name:</strong> <?= $visitor['name'] ?></p>
        <p><strong>Phone:</strong> <?= $visitor['phone'] ?></p>
        <p><strong>Purpose:</strong> <?= $visitor['purpose'] ?></p>
        <img src="<?= $visitor['qr_code'] ?>" alt="QR Code">
    </div>
</body>
</html>