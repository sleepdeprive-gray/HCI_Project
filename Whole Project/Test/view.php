<?php
include 'database_connection.php';

if (!isset($_GET['user_id'])) {
    die("User ID not provided.");
}

$user_id = intval($_GET['user_id']);

$sql = "SELECT profile_picture FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($image);
$stmt->fetch();

if ($stmt->num_rows > 0 && $image) {
    header("Content-Type: image/jpeg");
    echo $image;
} else {
    echo "No profile picture found.";
}

$stmt->close();
