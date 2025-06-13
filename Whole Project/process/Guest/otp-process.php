<?php
session_start();
require '../../PHPMailer/vendor/autoload.php';
include '../database_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['recovery_email'])) {
    echo "<script>alert('Session expired. Please try again.'); window.location.href = '../../Guest/Forgot/forgot.php';</script>";
    exit();
}

$email = $_SESSION['recovery_email'];
$otp = strval(rand(100000, 999999));

$stmt = $conn->prepare("UPDATE users SET otp = ? WHERE email = ?");
$stmt->bind_param("ss", $otp, $email);
if ($stmt->execute()) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ivan.gml097@gmail.com';
        $mail->Password = 'zpvu ucxx aupc rlnq';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('ivan.gml097@gmail.com', 'Book Room');
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: $otp";

        $mail->send();

        // Redirect to OTP input page
        header("Location: ../../Guest/Forgot/otp.php");
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Failed to send email.'); window.location.href = '../../Guest/Forgot/forgot.php';</script>";
    }
} else {
    echo "<script>alert('Failed to save OTP.'); window.location.href = '../../Guest/Forgot/forgot.php';</script>";
}
?>