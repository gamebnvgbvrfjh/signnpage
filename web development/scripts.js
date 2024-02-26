function generateOTP() {
    $.ajax({
        url: "generateOTP",
        type: "GET",
        success: function(response) {
            // Response contains the generated OTP
            $("#otp").val(response);
        },
        error: function() {
            alert("Failed to generate OTP");
        }
    });
}

$(document).ready(function() {
    $("#send-otp-btn").click(function() {
        var email = $("#email").val();
        $.ajax({
            url: "send_otp.php",
            method: "POST",
            data: { email: email },
            success: function(response) {
                if (response.trim() === "success") {
                    // OTP sent successfully, show OTP input field
                    $("#otp-section").show();
                    // Generate and display OTP
                    generateOTP();
                } else {
                    alert("Failed to send OTP. Please try again.");
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });
    });

    $("#verify-otp-btn").click(function() {
        var otp = $("#otp").val();
        $.ajax({
            url: "verify_otp.php",
            method: "POST",
            data: { otp: otp },
            success: function(response) {
                if (response.trim() === "success") {
                    // OTP verified, allow password reset
                    $("#reset-password-section").show();
                } else {
                    alert("Invalid OTP. Please try again.");
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });
    });

    $("#forgot-password-form").submit(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var newPassword = $("#new-password").val();
        $.ajax({
            url: "reset_password.php",
            method: "POST",
            data: { email: email, newPassword: newPassword },
            success: function(response) {
                alert(response); // Display response from server
                if (response.trim() === "Password reset successful") {
                    window.location.href = "webdevelopment.html"; // Redirect to login page
                }
            },
            error: function() {
                alert("An error occurred. Please try again.");
            }
        });
    });
});
