<?php
session_start();
require '../database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $datePublished = date("Y-m-d", strtotime($_POST['date-published']));
    $authorName = $_POST['authorname'];
    
    // Ensure editor and user ID are set
    $editorId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Change this if needed

    if (!$editorId || !$userId) {
        die("Error: No valid editor or user ID.");
    }

    // Convert uploaded files into BLOBs
    $frontCoverBlob = fileToBlob($_FILES['front-upload']);
    $backCoverBlob = fileToBlob($_FILES['back-upload']);
    $bookFileBlob = fileToBlob($_FILES['book-file-upload']);
    $authorPhotoBlob = fileToBlob($_FILES['author-upload']);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Check if author already exists
        $stmt = $conn->prepare("SELECT author_id, author_photo FROM authors WHERE author_name = ?");
        $stmt->bind_param("s", $authorName);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Author exists, get their ID and photo
            $stmt->bind_result($authorId, $existingAuthorPhoto);
            $stmt->fetch();
        } else {
            // Insert new author
            $stmt = $conn->prepare("INSERT INTO authors (author_name, author_photo) VALUES (?, ?)");
            $stmt->bind_param("sb", $authorName, $authorPhotoBlob);
            if (!$stmt->execute()) {
                throw new Exception("Error inserting author: " . $stmt->error);
            }
            $authorId = $stmt->insert_id;
            echo "Debug: Author inserted with ID = " . $authorId . "<br>";
            if (!$authorId) {
                throw new Exception("Error: Author ID is 0 after insertion.");
            }
            $conn->commit();
            sleep(1); // Small delay for MySQL update
        }
        $stmt->close();

        // Ensure author_id is valid
        if (empty($authorId)) {
            throw new Exception("Error: Author ID is missing.");
        }

        // Insert book with both editor_id and user_id
        $stmt = $conn->prepare("INSERT INTO books (title, genre, description, language, date_published, front_cover, back_cover, book_file, author_id, editor_id, user_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssbiii", $title, $genre, $description, $language, $datePublished, $frontCoverBlob, $backCoverBlob, $bookFileBlob, $authorId, $editorId, $userId);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting book: " . $stmt->error);
        }

        // Commit transaction
        $conn->commit();
        echo "
        <script>
            alert('Book added successfully!');
            window.location.href = '../../Editor/Editor-BooksOwned.php'; // Change this to your desired success page
        </script>";
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}

// Function to convert file into BLOB
function fileToBlob($file) {
    if ($file['error'] === 0 && is_uploaded_file($file['tmp_name'])) {
        return file_get_contents($file['tmp_name']);
    }
    return null;
}
?>