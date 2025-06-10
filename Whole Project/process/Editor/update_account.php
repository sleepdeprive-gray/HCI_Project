<?php
session_start();
require '../database_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
    header("Location: ../../Guest/login.php");
    exit();
}

$editor_id = $_SESSION['user_id'];
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'profile':
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $gender = $_POST['gender'];
        $location = $_POST['location'];
        $birthdate = $_POST['birthdate'];

        if (!empty($_FILES['profile_pic']['name'])) {
            $image_data = file_get_contents($_FILES['profile_pic']['tmp_name']);

            $sql = "UPDATE users SET first_name=?, last_name=?, gender=?, location=?, birthdate=?, profile_pic=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("ssssssi", $first_name, $last_name, $gender, $location, $birthdate, $image_data, $editor_id);
        } else {
            $sql = "UPDATE users SET first_name=?, last_name=?, gender=?, location=?, birthdate=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed (no image): " . $conn->error);
            }

            $stmt->bind_param("sssssi", $first_name, $last_name, $gender, $location, $birthdate, $editor_id);
        }

        $stmt->execute();
        $stmt->close();
        break;
    case 'credentials':
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone_number']);
        $secondary_email = trim($_POST['secondary_email']);
        $security_question = $_POST['security_question'];
        $security_answer = trim($_POST['security_answer']);

        $sql = "UPDATE users SET email=?, phone=?, secondary_email=?, security_question=?, sq_answer=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $email, $phone, $secondary_email, $security_question, $security_answer, $editor_id);
        $stmt->execute();
        $stmt->close();
        break;

    case 'password':
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            die("New passwords do not match.");
        }

        $sql = "SELECT password FROM users WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $editor_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($old_password, $hashed_password)) {
            die("Incorrect old password.");
        }

        $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_hashed, $editor_id);
        $stmt->execute();
        $stmt->close();
        break;

    default:
        die("Invalid action.");
}

$conn->close();
header("Location: ../../Editor/Editor-Accounts.php?update=success");
exit();
?>