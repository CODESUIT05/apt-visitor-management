<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'includes/db.php';

$admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE admins SET email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssi", $email, $password, $admin_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update profile');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Settings</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="settings">
        <h2>Update Profile</h2>
        <form method="POST">
            <input type="email" name="email" value="<?= $admin['email'] ?>" required>
            <input type="password" name="password" placeholder="New Password" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>