<?php

session_start();

include '../database_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = ($_POST['password']);

    $sql = "SELECT user_id, email, password, user_type FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password, $db_user_type);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {

            echo "Password match!"; // Debugging line

            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['user_type'] = $db_user_type; 
            
            if ($db_user_type == 'Editor') {

                header("Location: ../../Editor/Editor-Dashboard.php");
                exit();

            } elseif ($db_user_type == 'Member') {

                header("Location: ../../Member/discover.html");
                exit();
            }

        } else {

            echo "<script>alert('Invalid password!'); window.location.href='../../Guest/login.php';";

        }
    } else {
        
        echo "<script>alert('No account found with this email!'); window.location.href='../../Guest/login.php';</script>";
        
    }

    $stmt->close();
}

$conn->close();
