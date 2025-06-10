<?php
session_start();
include '../database_connection.php';
require '../../PHPMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    // Prepare and check SQL statement
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $otp = rand(100000, 999999); // Generate OTP

        $stmt->close(); // Close previous statement

        $stmt = $conn->prepare("UPDATE users SET otp = ? WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed (update): " . $conn->error);
        }

        $stmt->bind_param("ss", $otp, $email);
        $stmt->execute();

        // Send OTP via PHPMailer
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
            $mail->Subject = 'Your Book Room OTP Code';
            $mail->Body = "Your OTP code is: $otp";

            $mail->send();

            $_SESSION['recovery_email'] = $email;
            header("Location: ../../Guest/Forgot/otp.php");
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "<script>alert('Email not found.'); window.location='../../Guest/Forgot/forgot.php';</script>";
    }

    $stmt->close();
}
?>