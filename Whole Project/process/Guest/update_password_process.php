<?php
session_start();
if (!isset($_SESSION['recovery_email'])) {
    header("Location: ../../Guest/Forgot/forgot.php");
    exit();
}

include '../database_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['recovery_email'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match.";
        header("Location: ../../Guest/Forgot/recoverAccount.php?error=" . urlencode($error));
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ?, otp = NULL WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        unset($_SESSION['recovery_email']);
        header("Location: ../../Guest/Forgot/recoverSuccessfull.php");
        exit();
    } else {
        $error = "Failed to update password. Please try again.";
        header("Location: ../../Guest/Forgot/recoverAccount.php?error=" . urlencode($error));
        exit();
    }
}
?>