<?php 
    session_start();

    if(isset($_POST["signup"]))
    {        
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }

        if ($password == $confirmPassword) {
            $user_id = uniqid();

            $securityQuestion1 = $_POST["user_security_question_1"];
            $securityAnswer1 = $_POST["user_security_answer_1"];
            $securityQuestion2 = $_POST["user_security_question_2"];
            $securityAnswer2 = $_POST["user_security_answer_2"];

            $createUserQuery = "CREATE USER '$email'@'localhost'";
            $resultCreateUser = mysqli_query($conn, $createUserQuery);

            $grantQuery = "GRANT SELECT ON susmarketplace.* TO '$email'@'localhost'";
            $resultGrant = mysqli_query($conn, $grantQuery);
            
            $insertUserDataQuery = "INSERT INTO users (id, email, password) VALUES ('$user_id', '$email', '$hashedPassword')";
            $insertUserData = mysqli_query($conn, $insertUserDataQuery);
            
            $insertSecurityQuestionsQuery = "INSERT INTO usersecurityquestions (user_id, question_1, answer_1, question_2, answer_2) 
                                             VALUES ('$user_id', '$securityQuestion1', '$securityAnswer1', '$securityQuestion2', '$securityAnswer2')";
            $insertSecurityQuestions = mysqli_query($conn, $insertSecurityQuestionsQuery);

            header("Location: ../login/login.php");
            exit();
        }

        $conn->close();
    }
?>

