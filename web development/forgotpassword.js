$(document).ready(function() {
    $("#forgot-password-form").submit(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        $.post("send_otp.php", { email: email }, function(response) {
            if (response.trim() === "success") {
               // After sending OTP
             window.location.href = "Enter.otp.html"; // Redirect to OTP entry page

            } else {
                alert("Failed to send OTP. Please try again.");
            }
        });
    });
});
