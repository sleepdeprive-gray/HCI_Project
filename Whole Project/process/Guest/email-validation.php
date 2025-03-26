<?php

include '../database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('This email is already registered. Please use a different email.'); window.location.href='../../Guest/Signup/signup.php';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    header("Location: signupSecond_step.php");
    exit();
}
?>