<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoload.php

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if email address is valid (you can add more validation here)
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    // Send password reset instructions to the email address
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Generate OTP
        $otp = rand(100000, 999999);
        // Save OTP to database (you should have a table for OTPs)
        $stmt = $conn->prepare("INSERT INTO otps (user_id, otp) VALUES (?, ?)");
        $stmt->bind_param("is", $row['id'], $otp);
        $stmt->execute();

        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.elasticemail.com';          // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'teriyakirobot@teriyakico.org';                     // SMTP username
            $mail->Password   = 'EACF311A4EC4C7BD1C9EDE37AAA5E8C365EA';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('vyasrudransh2@gmail.com', 'Rudransh Vyas');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = 'Your OTP is: ' . $otp;

            $mail->send();
            echo 'An OTP has been sent to your email address.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email address not found";
    }
} else {
    echo "Invalid email address";
}

$stmt->close();
$conn->close();

