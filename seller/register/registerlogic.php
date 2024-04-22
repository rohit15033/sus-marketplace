<?php 
    session_start();
    if(isset($_POST["signup"]))
    {        
        require '../../connect.php';

        $store_name = $_POST["store_name"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

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

            $insertselleruserQuery = "INSERT INTO user_seller_junction (user_id, seller_id) VALUES ('$user_id', '$seller_id')";
            $insertselleruserResult = mysqli_query($conn, $insertselleruserQuery);
            
            $insertsellerdataQuery = "INSERT INTO sellers (id, store_name, password) VALUES ('$seller_id', '$store_name', '$hashedPassword')";
            $insertsellerdataResult = mysqli_query($conn, $insertsellerdataQuery);

            
            $insertSecurityQuestionsQuery = "INSERT INTO sellersecurityquestions (seller_id, question_1, answer_1, question_2, answer_2) 
                                             VALUES ('$seller_id', '$securityQuestion1', '$securityAnswer1', '$securityQuestion2', '$securityAnswer2')";
            $insertSecurityQuestions = mysqli_query($conn, $insertSecurityQuestionsQuery);

            header("Location: ../login/login.php");
            exit();
        }

        $conn->close();
    }
?>
