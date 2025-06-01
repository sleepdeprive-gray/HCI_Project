<?php
include '../../process/database_connection.php';

if (!isset($_GET['book_id'])) {
    http_response_code(400);
    exit('No book ID specified.');
}

$book_id = intval($_GET['book_id']);

$sql = "SELECT front_cover FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // No book found
    $stmt->close();
    header("Content-Type: image/jpeg");
    readfile("../../images/book-1.png");
    exit;
}

$stmt->bind_result($front_cover);
$stmt->fetch();
$stmt->close();

if (!empty($front_cover)) {
    header("Content-Type: image/jpeg"); // Adjust if you're storing PNGs
    echo $front_cover;
    exit;
} else {
    header("Content-Type: image/jpeg");
    readfile("../../images/book-1.png");
    exit;
}
?>