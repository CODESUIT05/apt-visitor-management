<?php
// Database connection
$host = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Leave empty if no password is set
$database = "apartment_management";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>