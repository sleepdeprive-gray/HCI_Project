<?php

session_start();
include '../database_connection.php';

if (!isset($_SESSION['recovery_email']) || !isset($_SESSION['recovery_method'])) {
    echo "<script>
            alert('Missing session data. Please try again.');
            window.location.href = '../../Guest/Forgot/forgot.php';
          </script>";
    exit();
}

$email = $_SESSION['recovery_email'];
$method = $_SESSION['recovery_method'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    session_unset();
    session_destroy();
    echo "<script>
            alert('Email not found in our system.');
            window.location.href = '../../Guest/Forgot/forgot.php';
          </script>";
    exit();
}

if ($method === 'qa') {
    header("Location: ../../Guest/Forgot/forgotQA.php");
    exit();
} elseif ($method === 'otp') {
    echo "<script>
            window.location.href = '../../Guest/Forgot/otp.php';
          </script>";
    exit();
} else {
    echo "<script>
            alert('Invalid recovery method selected.');
            window.location.href = '../../Guest/Forgot/forgot.php';
          </script>";
    exit();
}