<?php
include 'database_connection.php'; // assumes database_connection.php sets up $conn

// Fetch all users
$sql = "SELECT user_id, first_name, last_name FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Picture</title>
</head>
<body>
    <h2>Upload or Replace Profile Picture</h2>

    <form action="save.php" method="POST" enctype="multipart/form-data">
        <label for="user_id">Select User:</label>
        <select name="user_id" required>
            <option value="">-- Choose User --</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['user_id'] ?>">
                    <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="profile_picture">Choose Picture:</label>
        <input type="file" name="profile_picture" accept="image/*" required><br><br>

        <button type="submit">Upload</button>
    </form>

    <hr>

    <h3>View Uploaded Picture</h3>
    <form action="view.php" method="GET">
        <label for="user_id">Enter User ID:</label>
        <input type="number" name="user_id" required>
        <button type="submit">View Picture</button>
    </form>
</body>
</html>
