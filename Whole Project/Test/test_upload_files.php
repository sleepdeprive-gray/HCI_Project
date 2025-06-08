<?php
session_start();
require 'database_connection.php';

// For testing, let's just get all books (you can filter by editor_id if you want)
$books = [];
$sql = "SELECT book_id, title FROM books ORDER BY title ASC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

function fileToBlob($file) {
    if ($file['error'] === 0 && is_uploaded_file($file['tmp_name'])) {
        return file_get_contents($file['tmp_name']);
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = intval($_POST['book_id']);

    $front_cover = fileToBlob($_FILES['front_cover']);
    $back_cover = fileToBlob($_FILES['back_cover']);
    $book_file = fileToBlob($_FILES['book_file']);

    // Build dynamic update query only for files uploaded
    $fields = [];
    $params = [];
    $types = "";

    if ($front_cover !== null) {
        $fields[] = "front_cover = ?";
        $params[] = $front_cover;
        $types .= "b";
    }
    if ($back_cover !== null) {
        $fields[] = "back_cover = ?";
        $params[] = $back_cover;
        $types .= "b";
    }
    if ($book_file !== null) {
        $fields[] = "book_file = ?";
        $params[] = $book_file;
        $types .= "b";
    }

    if (empty($fields)) {
        echo "No files uploaded to update.";
    } else {
        $sql = "UPDATE books SET " . implode(", ", $fields) . " WHERE book_id = ?";
        $stmt = $conn->prepare($sql);

        // We need to bind the blobs plus the book_id int
        // So add types for blobs + 'i' for book_id
        $types .= "i";

        // Prepare arguments for bind_param: first types string, then params and book_id
        // Since blobs need send_long_data, bind_param with NULL first for blobs

        // Create array with NULLs for blobs then book_id at the end
        $bindParams = [];
        foreach ($params as $blob) {
            $bindParams[] = null;
        }
        $bindParams[] = $book_id;

        // Use references for bind_param
        $bindNames[] = $types;
        for ($i = 0; $i < count($bindParams); $i++) {
            $bindNames[] = &$bindParams[$i];
        }

        call_user_func_array([$stmt, 'bind_param'], $bindNames);

        // send_long_data for blobs
        $blobIndex = 0;
        for ($i = 0; $i < strlen($types) - 1; $i++) { // exclude last 'i' for book_id
            $stmt->send_long_data($i, $params[$blobIndex]);
            $blobIndex++;
        }

        if ($stmt->execute()) {
            echo "Files updated successfully!";
        } else {
            echo "Update failed: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test Upload Book Files</title>
</head>
<body>
    <h1>Upload Files to Book (front_cover, back_cover, book_file)</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="book_id">Select Book:</label><br>
        <select name="book_id" id="book_id" required>
            <option value="">-- Select a Book --</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book['book_id'] ?>"><?= htmlspecialchars($book['title']) ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="front_cover">Front Cover:</label>
        <input type="file" name="front_cover" id="front_cover" accept="image/*"><br><br>

        <label for="back_cover">Back Cover:</label>
        <input type="file" name="back_cover" id="back_cover" accept="image/*"><br><br>

        <label for="book_file">Book File (PDF):</label>
        <input type="file" name="book_file" id="book_file" accept="application/pdf"><br><br>

        <button type="submit">Upload / Update Files</button>
    </form>
</body>
</html>