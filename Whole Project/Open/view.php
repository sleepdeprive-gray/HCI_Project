<?php
session_start();
require 'db.php';

$page = $_GET['p'] ?? 1;
$genre = $_GET['genre'] ?? '';

$bookID = isset($_GET['bookID']) ? intval($_GET['bookID']) : 0;
$page = isset($_GET['p']) ? intval($_GET['p']) : 1;

// Fetch book data
$bookQuery = mysqli_query($conn, "
    SELECT b.*, a.author_name
    FROM books b
    LEFT JOIN authors a ON b.author_id = a.author_id
    WHERE b.book_id = $bookID
");

$book = mysqli_fetch_assoc($bookQuery);
if (!$book) {
    die("Book not found.");
}

// Fetch editor name (first + last)
$editorID = $book['editor_id'];
$editorQuery = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user_id = $editorID");
$editor = mysqli_fetch_assoc($editorQuery);
$editorName = $editor ? $editor['first_name'] . ' ' . $editor['last_name'] : "Unknown Editor";

$genre = isset($_GET['genre']) ? urldecode(trim($_GET['genre'])) : '';
switch ($page) {
    case 2:
        $backUrl = 'popular.php';
        break;
    case 3:
        $backUrl = 'newrelease.php';
        break;
    case 4:
        $backUrl = 'category/pages/books.php?genre=' . urlencode($genre);
        break;
    default:
        $backUrl = 'discover.php';
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor | Book Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon and Icons -->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="css/book-view.css">
</head>
<body>

<!-- Header -->
<header class="logo-and-title">
    <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    <img src="../images/weblogo.png" alt="book room logo">
</header>

<!-- Sidebar -->
<div class="sidebar">
    <div class="menu">
        <a href="discover.php"><button class="<?= ($page === 1) ? 'discover-btn' : 'text-btn' ?>">Discover</button></a>
        <a href="popular.php"><button class="<?= ($page === 2) ? 'discover-btn' : 'text-btn' ?>">Popular</button></a>
        <a href="newrelease.php"><button class="<?= ($page === 3) ? 'discover-btn' : 'text-btn' ?>">New Release</button></a>
    </div>
</div>

    <div class="space">
        <!-- for space -->
    </div>

<!-- Book Content -->
<div class="content-part">
    <div class="upper-content">
        <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover" width="150px">
        <div class="title-and-author">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <h4><?= htmlspecialchars($book['author_name']) ?></h4>
        </div>
           <div class="button-group-aligned">
                <div class="button-group">
                    <a href="download.php?bookID=<?= $bookID ?>">Download</a>
                    <a href="<?= $backUrl ?>" class="back-btn">Back</a>
                    </a>
                </div>
            </div>
    </div>

    <div class="section-bg">
        <div class="divider"></div>
        <div class="details-part">
            <div class="left-details">
                <h4>Description</h4>
                <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
            </div>
            <div class="right-details">
                <h4>Editor</h4>
                <p><?= htmlspecialchars($editorName) ?></p>

                <h4>Language</h4>
                <p><?= htmlspecialchars($book['language']) ?></p>

                <h4>Date Published</h4>
                <p><?= htmlspecialchars($book['date_published']) ?></p>

            </div>
        </div>
    </div>
</div>

</body>
</html>