<?php
require_once 'db.php';

function getFamousAuthors($conn, $limit = 3) {
    $sql = "SELECT a.author_name, a.author_photo, COUNT(b.book_id) AS book_count
            FROM books b
            JOIN authors a ON b.author_id = a.author_id
            WHERE b.status = 'approved'
            GROUP BY b.author_id
            ORDER BY book_count DESC
            LIMIT ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
?>