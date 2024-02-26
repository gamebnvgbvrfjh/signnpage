<?php
session_start(); // Start session to store OTP

// Generate OTP
$otp = rand(100000, 999999);

// Store OTP in session
$_SESSION['otp'] = $otp;

// Send OTP to the user's email (replace with your email sending logic)
$to_email = $_POST['email'];
$subject = 'Password Reset OTP';
$message = 'Your OTP is: ' . $otp;
$headers = "From: $email"; // Use the user's email address as the From field
mail($to_email, $subject, $message, $headers);

echo "success";
?>
<?php
// Your existing code to send OTP to the email address
$email = $_POST['email'];
$otp = ""; // Example OTP, replace with your logic to generate OTP and send it to the email

// Return success message along with the email address
echo json_encode(array("success" => true, "email" => $email));
 
