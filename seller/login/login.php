<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../customer/login/login.css">
</head>

<body>
    <header>
        <label class="hamburger-menu">
            <input type="checkbox">
        </label>
        <aside class="sidebar">
            <nav>
                <div><a href="../register/register.php">Register</a></div>
                <div><a href="../login/login.php">Login</a></div>
                <div><a href="../logout/logout.php">Logout</a></div>
            </nav>
        </aside>
        <div class="header-links">
            <a href="#" class="header-link">Login</a>
            <a href="#" class="header-link">Register</a>
        </div>
        <div class="seller-icon">
            <img src="..\..\Assets\Icons\icons8-seller-64.png" alt="">
        </div>
    </header>

    <div class="container">
        <div class="title-subtitle-container">
            <div class="title-container">
                <h1> Log in to</h1>
                <h1><span class="shop">Sell</span> awesome</h1>
                <h1> Stuffs </h1>
            </div>
            <div class="subtitle-container">
                <h2>If you don't have an account</h2>
                <h2>you can <a href="../register/register.php">register here</a></h2>
            </div>
        </div>
        <div class="login-container" id="login_container">
            <form class="login-form" id="login_form" method="POST" action="loginValidation.php">
                <div class="login-elements">
                    <input type="text" placeholder="Enter Store name" name="store_name">
                    <input type="password" placeholder="Enter password" name="password" id="password">
                    <button type="button" id="showPassBtn" onclick="togglePassword()" class="show-password">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path
                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                    </button>
                    <?php
                        if(isset($_SESSION['error'])) {
                            echo "<p style='color: red;'>".$_SESSION['error']."</p>";
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>
                <input type="submit" value="Log in" class="submit" name="login">
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var showPassBtn = document.getElementById('showPassBtn');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPassBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye-off">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                        <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                        <path d="M3 3l18 18" />
                    </svg>
                `;
            } else {
                passwordInput.type = "password";
                showPassBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                `;
            }
        }
    </script>
</body>

</html>
