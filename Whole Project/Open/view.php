<?php
session_start();
require 'db.php';

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

    <!-- Styles -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/book-view.css">
</head>
<body>

<!-- Header -->
<header class="logo-and-title">
    <img src="../images/weblogo.png" alt="book room logo">
    <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
</header>

<!-- Sidebar -->
<div class="sidebar">
    <h1>Book Room</h1>
    <div class="menu">
        <a href="discover.php"><button class="<?= ($page === 1) ? 'discover-btn' : 'text-btn' ?>">Discover</button></a>
        <a href="popular.php"><button class="<?= ($page === 2) ? 'discover-btn' : 'text-btn' ?>">Popular</button></a>
        <a href="newrelease.php"><button class="<?= ($page === 3) ? 'discover-btn' : 'text-btn' ?>">New Release</button></a>
    </div>
</div>

<!-- Book Content -->
<div class="content-part">
    <div class="upper-content">
        <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover">
        <div class="title-and-author">
            <h1><?= htmlspecialchars($book['title']) ?></h1>
            <h4><?= htmlspecialchars($book['author_name']) ?></h4>
        </div>
        <a href="<?php
            switch ($page) {
                case 2: echo 'popular.php'; break;
                case 3: echo 'newrelease.php'; break;
                default: echo 'discover.php'; break;
            }
        ?>">
            <button>Back</button>
        </a>
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

                <a href="download.php?bookID=<?= $bookID ?>">
                    <button style="background-color: #A1BE95; width:200px; height:50px; color:aliceblue; font-weight:bold">DOWNLOAD</button>
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>