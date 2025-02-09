<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $birthdate = $_SESSION['birthdate'];
        $gender = $_SESSION['gender'];
        $location = $_SESSION['location'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (isset($_POST['skip_security'])) {

            $security_question = NULL;
            $security_answer = NULL;

        } else {

            $security_question = !empty($_POST['security_question']) ? $_POST['security_question'] : NULL;
            $security_answer = !empty($_POST['security_answer']) ? $_POST['security_answer'] : NULL;

        }

        include '../database_connection.php';

        $sql = "INSERT INTO users (email, password, first_name, last_name, birthdate, gender, location, security_question, sq_answer) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $email, $hashedPassword, $firstname, $lastname, $birthdate, $gender, $location, $security_question, $security_answer);

        if ($stmt->execute()) {

            echo "<script>alert('Registration successful!'); window.location.href='../../Guest/login.php';</script>";
        
        } else {

            echo "<script>alert('Error during registration!'); window.location.href='../../Guest/Signup/signup.php';</script>";
       
        }

        $stmt->close();
        $conn->close();
    }
?>