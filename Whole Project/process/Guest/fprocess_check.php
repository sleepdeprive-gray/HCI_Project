<?php

session_start();
include '../database_connection.php';

if (!isset($_SESSION['recovery_email']) || !isset($_SESSION['recovery_method'])) {
    echo "<script>alert('Missing session. Try again.'); window.location.href = '../../Guest/Forgot/forgot.php';</script>";
    exit();
}

$email = $_SESSION['recovery_email'];
$method = $_SESSION['recovery_method'];

if ($method === 'qa') {

    $stmt = $conn->prepare("SELECT security_question, sq_answer FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (empty($user['security_question']) || empty($user['sq_answer'])) {
        echo "<script>alert('No security question set for this account.'); window.location.href = '../../Guest/Forgot/forgot.php';</script>";
        exit();
    } else {
        header("Location: ../../Guest/Forgot/forgotQA.php");
        exit();
    }
} elseif ($method === 'otp') {
    
    header("Location: ../../process/Guest/otp-process.php");
    exit();
    
}
?>