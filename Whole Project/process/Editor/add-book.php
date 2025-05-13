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

    $editorId = $_SESSION['user_id'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;

    if (!$editorId || !$userId) {
        die("Error: No valid editor or user ID.");
    }

    // Get BLOB contents
    $frontCoverBlob = fileToBlob($_FILES['front-upload']);
    $backCoverBlob = fileToBlob($_FILES['back-upload']);
    $bookFileBlob = fileToBlob($_FILES['book-file-upload']);
    $authorPhotoBlob = fileToBlob($_FILES['author-upload']);

    // Debugging file uploads
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

    // Start transaction
    $conn->begin_transaction();

    try {
        // Check for duplicate book
        $stmt = $conn->prepare("SELECT book_id FROM books b JOIN authors a ON b.author_id = a.author_id WHERE LOWER(b.title) = LOWER(?) AND LOWER(a.author_name) = LOWER(?)");
        $stmt->bind_param("ss", $title, $authorName);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Book already exists.'); window.history.back();</script>";
            exit();
        }
        $stmt->close();

        // Check if author exists
        $stmt = $conn->prepare("SELECT author_id FROM authors WHERE author_name = ?");
        $stmt->bind_param("s", $authorName);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($authorId);
            $stmt->fetch();
            $stmt->close();
        } else {
            // Insert new author with LONGBLOB photo
            $stmt = $conn->prepare("INSERT INTO authors (author_name, author_photo) VALUES (?, ?)");
            $null = NULL;
            $stmt->bind_param("sb", $authorName, $null);  // Bind BLOB field as NULL first
            $stmt->send_long_data(1, $authorPhotoBlob);   // Send actual BLOB data here
            $stmt->execute();
            $authorId = $stmt->insert_id;
            $stmt->close();
        }

        if (!$authorId) {
            throw new Exception("Author insert failed.");
        }

        $stmt = $conn->prepare("INSERT INTO books (
            title, genre, description, language, date_published,
            front_cover, back_cover, book_file, author_id, editor_id, user_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $null = NULL;

        // Bind all parameters first with placeholders for blobs
        $stmt->bind_param(
            "sssssbbbiii",
            $title,
            $genre,
            $description,
            $language,
            $datePublished,
            $null,  // front_cover
            $null,  // back_cover
            $null,  // book_file
            $authorId,
            $editorId,
            $userId
        );

        // Now send the real blob data
        $stmt->send_long_data(5, $frontCoverBlob);  // 0-based index: front_cover
        $stmt->send_long_data(6, $backCoverBlob);   // back_cover
        $stmt->send_long_data(7, $bookFileBlob);    // book_file

        // Execute and check for errors
        if (!$stmt->execute()) {
            throw new Exception("Book insert failed: " . $stmt->error);
        }

        $stmt->close();

        
        $conn->commit();
        echo "<script>alert('Book added successfully!'); window.location.href='../../Editor/Editor-BooksOwned.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    $conn->close();
}

function fileToBlob($file) {
    if ($file['error'] === 0 && is_uploaded_file($file['tmp_name'])) {
        return file_get_contents($file['tmp_name']);
    }
    return null;
}
?>