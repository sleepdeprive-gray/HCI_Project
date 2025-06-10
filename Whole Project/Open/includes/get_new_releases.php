<?php
require_once 'db.php';

function getNewReleases($conn) {
    $sql = "SELECT b.*, a.author_name, a.author_photo 
            FROM books b 
            JOIN authors a ON b.author_id = a.author_id 
            WHERE b.status = 'approved' 
            ORDER BY b.upload_date DESC";

    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
