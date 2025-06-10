<?php
require '../process/database_connection.php';

// Total approved books
$booksQuery = "SELECT COUNT(*) as totalBooks FROM books WHERE status = 'Approved'";
$booksResult = mysqli_query($conn, $booksQuery);
$booksData = mysqli_fetch_assoc($booksResult);
$totalBooks = $booksData['totalBooks'] ?? 0;

// Total editors
$editorsQuery = "SELECT COUNT(*) as totalEditors FROM users WHERE user_type = 'Editor'";
$editorsResult = mysqli_query($conn, $editorsQuery);
$editorsData = mysqli_fetch_assoc($editorsResult);
$totalEditors = $editorsData['totalEditors'] ?? 0;

// Top editors
$topEditorsQuery = "
  SELECT u.id, u.name, u.profile_image, COUNT(b.id) AS bookCount
  FROM users u
  LEFT JOIN books b ON u.id = b.editor_id AND b.status = 'Approved'
  WHERE u.user_type = 'Editor'
  GROUP BY u.id
  ORDER BY bookCount DESC
  LIMIT 6
";
$topEditorsResult = mysqli_query($conn, $topEditorsQuery);
?>
