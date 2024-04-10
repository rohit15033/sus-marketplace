<?php 
    session_start();


    if(isset($_POST["signup"]))
    {        
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $store_name = $_POST["store_name"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }

        if ($password == $confirmPassword) {
            $seller_id = uniqid();
            $user_id = $_SESSION['user_id'];

            $securityQuestion1 = $_POST["seller_security_question_1"];
            $securityAnswer1 = $_POST["seller_security_answer_1"];
            $securityQuestion2 = $_POST["seller_security_question_2"];
            $securityAnswer2 = $_POST["seller_security_answer_2"];

            $createUserQuery = "CREATE USER '$store_name'@'localhost'";
            $resultCreateUser = mysqli_query($conn, $createUserQuery);

            $grantQuery = "GRANT SELECT, INSERT ON susmarketplace.* TO '$store_name'@'localhost'";
            $resultGrant = mysqli_query($conn, $grantQuery);
            
            $insertUserDataQuery = "INSERT INTO sellers (id, store_name, password, user_id) VALUES ('$seller_id', '$store_name', '$hashedPassword', '$user_id')";
            $insertUserData = mysqli_query($conn, $insertUserDataQuery);
            
            $insertSecurityQuestionsQuery = "INSERT INTO sellersecurityquestions (seller_id, question_1, answer_1, question_2, answer_2) 
                                             VALUES ('$seller_id', '$securityQuestion1', '$securityAnswer1', '$securityQuestion2', '$securityAnswer2')";
            $insertSecurityQuestions = mysqli_query($conn, $insertSecurityQuestionsQuery);

            header("Location: ../login/login.php");
            exit();
        }

        $conn->close();
    }
?>
