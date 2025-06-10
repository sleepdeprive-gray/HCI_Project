<?php
session_start();
require '../process/database_connection.php';

// Fetch all users for dropdown
$users = [];
$result = $conn->query("SELECT user_id, first_name, last_name FROM users ORDER BY first_name");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Helper function: get raw file contents or null on failure
function fileToBlob($file) {
    if ($file['error'] === 0 && is_uploaded_file($file['tmp_name'])) {
        return file_get_contents($file['tmp_name']);
    }
    return null;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_user_id = intval($_POST['user_id']);
    $profile_pic = fileToBlob($_FILES['profile_pic']);

    if ($profile_pic === null) {
        $message = "No file uploaded or upload error.";
    } else {
        // Prepare statement with placeholder for LONGBLOB and user_id
        $sql = "UPDATE users SET profile_pic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        // "b" for blob, "i" for int (user_id)
        $stmt->bind_param("bi", $null, $selected_user_id);

        // Send long data for the first parameter (index 0)
        $null = null; // Required for bind_param before send_long_data
        $stmt->send_long_data(0, $profile_pic);

        if ($stmt->execute()) {
            $message = "Profile picture uploaded successfully for user ID $selected_user_id!";
        } else {
            $message = "Upload failed: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Profile Picture for User</title>
</head>
<body>
    <h1>Upload Profile Picture for User</h1>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="user_id">Select User:</label><br>
        <select name="user_id" id="user_id" required>
            <option value="" disabled selected>-- Select a user --</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['user_id'] ?>">
                    <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="profile_pic">Choose Profile Picture:</label><br>
        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required><br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>