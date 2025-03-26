<?php

include '../database_connection.php';

$editor_id = $_SESSION['user_id']; // Current editor ID

// Fetch the total number of books by this editor
$sql_total_books = "SELECT COUNT(*) FROM books WHERE editor_id = ?";
$stmt = $conn->prepare($sql_total_books);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($total_books);
$stmt->fetch();
$stmt->close();

// Fetch the total downloads of all books by this editor
$sql_total_downloads = "SELECT SUM(downloads) FROM books WHERE editor_id = ?";
$stmt = $conn->prepare($sql_total_downloads);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($total_downloads);
$stmt->fetch();
$stmt->close();

// Fetch the most downloaded book
$sql_most_downloaded = "SELECT title, downloads, cover_image FROM books WHERE editor_id = ? ORDER BY downloads DESC LIMIT 1";
$stmt = $conn->prepare($sql_most_downloaded);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($most_downloaded_title, $most_downloads, $most_downloaded_image);
$stmt->fetch();
$stmt->close();

// Fetch the least downloaded book
$sql_least_downloaded = "SELECT title, downloads, cover_image FROM books WHERE editor_id = ? ORDER BY downloads ASC LIMIT 1";
$stmt = $conn->prepare($sql_least_downloaded);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($least_downloaded_title, $least_downloads, $least_downloaded_image);
$stmt->fetch();
$stmt->close();

$conn->close();