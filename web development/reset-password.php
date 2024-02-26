<?php
session_start();

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
    // Generate a random OTP (you can customize the length as needed)
    $otp = rand(100000, 999999);

    // Store the OTP in the session
    $_SESSION['otp'] = $otp;

    // Send the OTP to the user's email address
    $email = $_POST['email'];
    $subject = "OTP for Password Reset";
    $message = "Your OTP is: $otp";
    $headers = "From: $email"; // Use the user's email address as the From field
    if (mail($email, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "Failed to send OTP. Please try again.";
    }
} else {
    echo "Invalid email address";
}

$conn->close();

