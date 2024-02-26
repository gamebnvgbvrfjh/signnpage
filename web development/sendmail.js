$(document).ready(function() {
    $("#forgot-password-form").submit(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        
        // Generate OTP
        var otp = generateOTP(6); // Assuming you have a function to generate OTP
        
        // Send email using SMTP.js
        Email.send({
            Host: "smtp.elasticemail.com",
            Username: "teriyakibot@teriyaki.org",
            Password: "7832B1182785956532CBAC3D3C8FF3D51E43",
            To: email,
            From: "vyasrudransh2@gmail.com",
            Subject: "Password Reset OTP",
            Body: "Your OTP is " + otp
        }).then(
            message => alert("Email sent successfully")
        );

        // Redirect to enter OTP page
        window.location.href = "enter.otp.html";
    });
});

// Function to generate OTP
function generateOTP(length) {
    var numbers = "0123456789";
    var otp = "";
    for (var i = 0; i < length; i++) {
        otp += numbers.charAt(Math.floor(Math.random() * numbers.length));
    }
    return otp;
}
