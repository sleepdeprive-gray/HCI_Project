<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = 'Editor';
    $email = $_SESSION['email'] ?? null;
    $password = $_SESSION['password'] ?? null;
    $firstname = $_SESSION['firstname'] ?? null;
    $lastname = $_SESSION['lastname'] ?? null;
    $birthdate = $_SESSION['birthdate'] ?? null;
    $gender = $_SESSION['gender'] ?? null;
    $location = $_SESSION['location'] ?? null;

    if (empty($email) || empty($password) || empty($firstname) || empty($lastname)) {
        die("Required fields are missing.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $security_question = $_POST['security_question'] ?? null;
    $security_answer = $_POST['security_answer'] ?? null;

    include '../database_connection.php';

    // Check for duplicate email
    $check = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo "<script>
                alert('Email already registered. Please use a different one.'); 
                window.location.href='../../Guest/Signup/signup.php';
              </script>";
        exit();
    }
    $check->close();

    $sql = "INSERT INTO users (user_type, email, password, first_name, last_name, birthdate, gender, location, security_question, sq_answer) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", 
        $user_type, 
        $email, 
        $hashedPassword, 
        $firstname, 
        $lastname, 
        $birthdate, 
        $gender, 
        $location, 
        $security_question, 
        $security_answer
    );

    if ($stmt->execute()) {
        // Do NOT call session_unset() here.
        $_SESSION['email'] = $email;

        echo "<script>
                window.location.href='../../Guest/Signup/signupSuccessful.php';
            </script>";
    } else {
        echo "<script>
                alert('Something went wrong. Please try again later.'); 
                window.location.href='../../Guest/Signup/signup.php';
            </script>";
    }

    $stmt->close();
    $conn->close();
}
?>