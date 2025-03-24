<?php
// Database connection function
function db_connect() {
    $host = "localhost";
    $username = "root";
    $password = ""; // Leave empty if no password
    $database = "apartment_management";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to generate a QR Code (requires phpqrcode library)
function generate_qr_code($data, $filename) {
    include 'vendor/phpqrcode/qrlib.php'; // Include the QR Code library

    $path = "uploads/qr_codes/"; // Folder to store QR Codes
    if (!file_exists($path)) {
        mkdir($path, 0777, true); // Create folder if it doesn't exist
    }

    $filePath = $path . $filename . ".png";
    QRcode::png($data, $filePath, 'H', 4, 2); // Generate QR Code
    return $filePath; // Return the file path
}

// Function to send an email using PHPMailer
function send_email($to, $subject, $body) {
    require 'vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Replace with your email
        $mail->Password = 'your_password'; // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@gmail.com', 'Apartment Management');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Failed to send email
    }
}

// Function to send SMS using Twilio
function send_sms($to, $message) {
    require_once 'vendor/autoload.php';

    $sid = "your_twilio_sid"; // Replace with your Twilio SID
    $token = "your_twilio_token"; // Replace with your Twilio token
    $twilio = new Twilio\Rest\Client($sid, $token);

    try {
        $twilio->messages->create(
            $to,
            [
                "from" => "+1234567890", // Replace with your Twilio number
                "body" => $message
            ]
        );
        return true; // SMS sent successfully
    } catch (Exception $e) {
        return false; // Failed to send SMS
    }
}

// Function to log visitor check-in/check-out
function log_visitor_activity($visitor_id, $action) {
    $conn = db_connect();

    if ($action == 'check_in') {
        $stmt = $conn->prepare("INSERT INTO visitor_logs (visitor_id, check_in) VALUES (?, NOW())");
    } elseif ($action == 'check_out') {
        $stmt = $conn->prepare("UPDATE visitor_logs SET check_out = NOW() WHERE visitor_id = ?");
    }

    $stmt->bind_param("i", $visitor_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Function to validate user input (basic sanitization)
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}