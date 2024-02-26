<?php
session_start(); // Start session to access stored OTP

// Verify OTP
if ($_POST['otp'] == $_SESSION['otp']) {
    echo "success";
} else {
    echo "error";
}

