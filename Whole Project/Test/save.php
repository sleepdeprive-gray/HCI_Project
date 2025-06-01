<?php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $user_id = $_POST['user_id'];
    $imgData = file_get_contents($_FILES['profile_picture']['tmp_name']);

    $sql = "UPDATE users SET profile_picture = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bi", $null, $user_id);
    $stmt->send_long_data(0, $imgData);

    if ($stmt->execute()) {
        echo "<script>alert('Profile picture uploaded successfully.'); window.location.href='upload.php';</script>";
    } else {
        echo "Error uploading picture: " . $stmt->error;
    }

    $stmt->close();
}
