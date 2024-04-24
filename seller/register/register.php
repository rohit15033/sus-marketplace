<?php

session_start();

// if(!isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == false) {
//     header("Location: ../../customer/login/login.php");
//     exit;
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="../../customer/register/register.css">
</head>

<body>

    <header>
        <label class="hamburger-menu">
            <input type="checkbox">
        </label>
        <div class="seller-icon">
            <img src="..\..\Assets\Icons\icons8-seller-64.png" alt="">
        </div>
        <aside class="sidebar">
            <nav>
                <div><a href="register.html">Register</a></div>
                <div><a href="../../customer/homepage/homepage.php ">Home</a></div>
            </nav>
        </aside>
        <div class="header-links">
            <a href="" class="header-link">Login</a>
            <a href="#" class="header-link">Register</a>
        </div>
    </header>

    <div class="container">

        <div class="title-subtitle-container">
            <div class="title-container">
                <h1> Sign up to</h1>
                <h1><span class="shop">Sell</span> awesome</h1>
                <h1> Stuffs </h1>
            </div>
            <div class="subtitle-container">
                <h2>If you already have an account</h2>
                <h2>you can <a href="../login/login.php">login here</a></h2>
            </div>
        </div>
        <div class="signup-security-questions-container">
            <div class="signup-container" id="signup_container">
                <form class="signup-form" id="signup_form" method="POST" action="registerlogic.php">
                <div class="signup-elements">
                        <input type="text" placeholder="Enter Store Name" name="store_name">
                        <input type="password" placeholder="Enter password" name="password" id = "password" oninput="validatePassword()">
                        <button type="button" id="showPassBtn" onclick="togglePassword()" class = "show-password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </button>
                        <span id="error-message-1" style="color: red;"></span>
                        <input type="password" placeholder="Confirm password" name="confirmPassword" id = "confirmPassword" oninput = "validatePassword()">
                        <span id="error-message-2" style="color: red;"></span>
                    </div>
                    <input type="button" value="Continue" class="continue disable-continue" id="continue">
            </div>
            <div class="security-questions-container security-questions-transform-before" id="security_questions_container">
                <input type="button" class="back" value="<- Back" id="back">

                <select name="seller_security_question_1">
                    <option value="" disabled selected>Select a security question 1
                    <option value="maiden_name">What is your mother's maiden name?
                    <option value="pet_name">What is your pet's name?
                    <option value="birth_city">In what city were you born?
                </select>
                <input type="text" placeholder="Security answer 1" name="seller_security_answer_1">

                <select name="seller_security_question_2">
                    <option value="" disabled selected>Select a security question 2
                    <option value="favorite_color">What is your favorite color?
                    <option value="grandmother_name">What is your grandmother's first name on your mother's side?
                    <option value="favorite_food">What is your favorite food?
                </select>
                <input type="text" placeholder="Security answer 2" name="seller_security_answer_2">

                <input type="submit" class="submit" name="signup" id="submit">
            </div>
        </div>


        </form>
    </div>

    <script>
    var showPassButton = document.getElementById('showPassBtn');
    var continueButton = document.getElementById('continue');
    var passwordInput = document.getElementById('password');
    var confirmPasswordInput = document.getElementById('confirmPassword');
    var submitButton = document.getElementById('submit');
    var errorMessage1 = document.getElementById('error-message-1');
    var errorMessage2 = document.getElementById('error-message-2');

    document.addEventListener('DOMContentLoaded', function() {
        continueButton.addEventListener('click', function(event) {
            console.log("Continue button clicked");
            var securityQuestionsContainer = document.getElementById('security_questions_container');
            var signupContainer = document.getElementById('signup_container');

            signupContainer.classList.remove('signup-transform-down');
            securityQuestionsContainer.classList.remove('security-questions-transform-down');

            signupContainer.classList.add('signup-transform-up');
            securityQuestionsContainer.classList.add('security-questions-transform-up');
        });

        document.getElementById('back').addEventListener('click', function(event) {
            console.log("Back button clicked");
            var securityQuestionsContainer = document.getElementById('security_questions_container');
            var signupContainer = document.getElementById('signup_container');

            signupContainer.classList.remove('signup-transform-up');
            securityQuestionsContainer.classList.remove('security-questions-transform-up');

            securityQuestionsContainer.classList.add('security-questions-transform-down');
            signupContainer.classList.add('signup-transform-down');
        });
    });

    function validatePassword() {
        if (passwordInput.value.length < 8) {
            errorMessage1.innerText = "Password must be at least 8 characters long.";
        } else {
            errorMessage1.innerText = "";
        }

        if (passwordInput.value == confirmPasswordInput.value) {
            errorMessage2.innerText = "";
        } else {
            errorMessage2.innerText = "Passwords do not match.";
        }

        if (passwordInput.value === confirmPasswordInput.value && passwordInput.value.length >= 8) {
            continueButton.classList.add('enable-continue');
            continueButton.classList.remove('disable-continue');
            errorMessage2.innerText = "";
        } else {
            continueButton.classList.add('disable-continue');
            continueButton.classList.remove('enable-continue');
        }
    }

    function togglePasswordVisibility() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPassButton.textContent = "Hide Password";
        } else {
            passwordInput.type = "password";
            showPassButton.textContent = "Show Password";
        }
    }
</script>

</body>

</html>