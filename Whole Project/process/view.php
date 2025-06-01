<?php
// ../process/view.php
include 'database_connection.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $sql = "SELECT profile_picture FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if ($image) {
        header("Content-Type: image/jpeg");
        echo $image;
        exit();
    }
}

// fallback image
header("Location: ../images/default-profile.png");
exit();