function showRegistrationForm() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("forgotPasswordForm").style.display = "none";
    document.getElementById("registrationForm").style.display = "block";
}

function showLoginForm() {
    document.getElementById("loginForm").style.display = "block";
    document.getElementById("forgotPasswordForm").style.display = "none";
}

function showForgotPasswordForm() {
    document.getElementById("forgotPasswordForm").style.display = "block";
    document.getElementById("forgotPasswordForm").classList.add("slide-in");
    document.getElementById("loginForm").style.display = "none";
}
