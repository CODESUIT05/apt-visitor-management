<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $purpose = $_POST['purpose'];

    // Generate QR Code (use a library like phpqrcode)
    $qr_code = "QR_CODE_" . uniqid();

    $stmt = $conn->prepare("INSERT INTO visitors (name, phone, email, purpose, qr_code) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $email, $purpose, $qr_code);
    if ($stmt->execute()) {
        echo "<script>alert('Visitor added successfully');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visitor Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="visitor-form">
        <h2>Visitor Information</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <input type="email" name="email" placeholder="Email">
            <textarea name="purpose" placeholder="Purpose of Visit"></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>