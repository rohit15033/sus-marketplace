<?php 
    if(isset($_POST["signup"]))
    {
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "susmarketplace";

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
        if ($conn -> connect_error)
        {
            die("Connection failed: ". $conn -> connect_error);
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $securityQuestion1 = $_POST["user_security_question_1"];
        $securityAnswer1 = $_POST["user_security_answer_1"];
        $securityQuestion2 = $_POST["user_security_question_2"];
        $securityAnswer2 = $_POST["user_security_answer_2"];

        if ($password == $confirmPassword) {
            // Insert user data
            $insertUserDataQuery = "INSERT INTO users (email, password) VALUES ('$email', '$password');";
            $insertUserData = mysqli_query($conn, $insertUserDataQuery);
    
            // Get the user ID of the inserted user
            $userId = mysqli_insert_id($conn);
    
            // Insert security questions and answers
            $insertSecurityQuestionsQuery = "INSERT INTO usersecurityquestions (user_id, question_1, answer_1, question_2, answer_2) 
                                             VALUES ('$userId', '$securityQuestion1', '$securityAnswer1', '$securityQuestion2', '$securityAnswer2')";
            $insertSecurityQuestions = mysqli_query($conn, $insertSecurityQuestionsQuery);

            header("Location: ../login/login.html");
            exit();
        }

        $conn->close();
    }
?>