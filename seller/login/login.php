<?php
    session_start();
    if(isset($_SESSION['seller_logged_in']) && $_SESSION['seller_logged_in'] === true) {
        header("Location: ../homepage/homepage.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
                    <input type="text" placeholder="Enter password" name="password">
                    <?php
                        if(isset($_SESSION['error'])) {
                            echo "<p style='color: red;'>".$_SESSION['error']."</p>";
                            unset($_SESSION['error']);
                        }
                    ?>
                </div>
                <input type="submit" value="Log in" class="submit" name="login">
        </div>
        </form>
    </div>
</body>
</html>