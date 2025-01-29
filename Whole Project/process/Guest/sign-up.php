<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the session
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $birthdate = $_SESSION['birthdate'];
    $gender = $_SESSION['gender'];
    $location = $_SESSION['location'];

    // Hash the password only once
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle security question (optional)
    if (isset($_POST['skip_security'])) {
        // User skipped security question
        $security_question = NULL;
        $security_answer = NULL;
    } else {
        // User selected a security question
        $security_question = !empty($_POST['security_question']) ? $_POST['security_question'] : NULL;
        $security_answer = !empty($_POST['security_answer']) ? $_POST['security_answer'] : NULL;
    }

    include '../database_connection.php';

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO users (email, password, first_name, last_name, birthdate, gender, location, security_question, sq_answer) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $email, $hashedPassword, $firstname, $lastname, $birthdate, $gender, $location, $security_question, $security_answer);

    if ($stmt->execute()) {
        // Registration successful
        echo "<script>alert('Registration successful!'); window.location.href='../../Guest/login.php';</script>";
    } else {
        // Error during registration
        echo "<script>alert('Error during registration!'); window.location.href='../../Guest/Signup/signup.php';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>