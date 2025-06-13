<?php

session_start();
include '../database_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $method = $_POST['method'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['recovery_email'] = $email;
        $_SESSION['recovery_method'] = $method;
        header("Location: fprocess_check.php");
        exit();
    } else {
        echo "<script>alert('Email not found'); window.location.href='../../Guest/Forgot/forgot.php';</script>";
    }
}