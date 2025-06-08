<?php
// ../process/view.php
include 'database_connection.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $sql = "SELECT profile_pic FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($imageData);
        $stmt->fetch();

        if ($imageData !== null) {
            // Make sure NO output is sent before this
            header("Content-Type: image/jpeg"); // or image/png depending on what you're uploading
            header("Content-Length: " . strlen($imageData));
            echo $imageData;
            exit;
        }
    }

    $stmt->close();
}

$conn->close();

// fallback image if no profile picture is found
header("Location: https://placehold.co/80x80.png");
exit;