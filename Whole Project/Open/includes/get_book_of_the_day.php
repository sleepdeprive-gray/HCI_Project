<?php
require_once 'db.php';

function getBookOfTheDay($conn) {
    $sql = "SELECT b.*, a.author_name 
            FROM books b
            JOIN authors a ON b.author_id = a.author_id
            WHERE b.status = 'approved'
            ORDER BY RAND()
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
?>
