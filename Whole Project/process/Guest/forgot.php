<?php

    session_start();
    include '../../process/database_connection.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST['email']);
        $method = $_POST['method'];

        if (empty($email) || empty($method)) {
            header("Location: forgot.php?error=Missing+Email+or+Method");
            exit();
        }

        $_SESSION['recovery_email'] = $email;
        $_SESSION['recovery_method'] = $method;

        header("Location: fprocess_check.php");
        exit();
    } else {
        echo "Invalid request.";
    }

?>