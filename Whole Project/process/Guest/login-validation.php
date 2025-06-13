<?php
session_start();
require '../database_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and password are required.'); window.location.href='../../Guest/login.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.location.href='../../Guest/login.php';</script>";
        exit();
    }

    $sql = "SELECT user_id, email, password, user_type FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "<script>alert('Database error. Please try again later.'); window.location.href='../../Guest/login.php';</script>";
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $db_email, $db_password, $user_type);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $db_email;
            $_SESSION['user_type'] = $user_type;

            switch ($user_type) {
                case 'Editor':
                     $currentDAY = date('Y-m-d H:i');

                     mysqli_query($conn, "INSERT INTO recent_logs (`timestamp`, ID, `ACTION`, user_type)
                    VALUES('$currentDAY',$user_id , 'LOGIN', 'Editor')");

                    header("Location: ../../Editor/Editor-Dashboard.php");
                    break;
                case 'Member':
                    header("Location: ../../Member/discover.html");
                    break;
                default:
                    echo "<script>alert('Unknown user role.'); window.location.href='../../Guest/login.php';</script>";
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href='../../Guest/login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href='../../Guest/login.php';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../Guest/login.php");
    exit();
}
?>