<?php
require 'db.php';

if (!isset($_GET['bookID'])) {
    die("No book ID provided.");
}

$bookID = intval($_GET['bookID']);

// Fetch the book file from database
$query = mysqli_query($conn, "SELECT title, book_file FROM books WHERE book_id = $bookID");
$book = mysqli_fetch_assoc($query);

if (!$book) {
    die("Book not found.");
}

// Update download count
$updateDownload = mysqli_query($conn, "UPDATE books SET downloads = downloads + 1 WHERE book_id = $bookID");

// Set headers and serve the file
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . preg_replace("/[^a-zA-Z0-9]/", "_", $book['title']) . ".pdf\"");
header("Content-Length: " . strlen($book['book_file']));

// Output the file content
echo $book['book_file'];
exit;
?>