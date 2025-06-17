<?php
session_start();
include '../process/database_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
    header("Location: ../Guest/login.php");
    exit();
}

$editor_id = $_SESSION['user_id'];

$sql_editor_name = "SELECT first_name FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql_editor_name);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($editor_name);
$stmt->fetch();
$stmt->close();

if (!isset($_GET['book_id'])) {
    echo "No book selected.";
    exit();
}

$book_id = intval($_GET['book_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_status'])) {

    $status_sql = "SELECT status FROM books WHERE book_id = ? AND editor_id = ?";
    $stmt = $conn->prepare($status_sql);
    $stmt->bind_param("ii", $book_id, $editor_id);
    $stmt->execute();
    $stmt->bind_result($current_status);
    $stmt->fetch();
    $stmt->close();
    
    $new_status = ($current_status === 'approved') ? 'hidden' : 'approved';
    
    $update_sql = "UPDATE books SET status = ? WHERE book_id = ? AND editor_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sii", $new_status, $book_id, $editor_id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: Editor-BookView.php?book_id=" . $book_id);
    exit();
}

$sql = "SELECT 
            b.*, 
            u.first_name AS editor_fname, 
            u.last_name AS editor_lname, 
            a.author_name 
        FROM books b
        JOIN users u ON b.editor_id = u.user_id
        JOIN authors a ON b.author_id = a.author_id
        WHERE b.book_id = ? AND b.editor_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $book_id, $editor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Book not found or access denied.";
    exit();
}

$book = $result->fetch_assoc();

$title = $book['title'];
$description = $book['description'];
$language = $book['language'];
$cover_path = $book['front_cover'];
$formatted_date = date("F j, Y", strtotime($book['date_published']));
$editor_fname = $book['editor_fname'];
$editor_lname = $book['editor_lname'];
$author_name = $book['author_name'];
$status = $book['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Icon Import -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Web Icon -->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/book-view.css">
</head>
<body>
    <!-- Logo and Title -->
    <header class="logo-and-title">
        <img src="../images/weblogo.png" alt="book room logo">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    </header>

    <!-- Navigation Panel -->
    <div class="sidebar">
        <h1>Book <span style="color:rgb(235, 116, 42);">Room</span></h1>
        <div class="profile">
            <img src="../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
            <h2><?= htmlspecialchars($editor_name ?: 'Editor') ?></h2>
            <p>Editor</p>
            <hr>
        </div>
        <div class="menu">
            <a href="Editor-Dashboard.php"><button class="text-btn">Dashboard</button></a>
            <a href="Editor-Books.php"><button class="text-btn">Books</button></a>
            <a href="Editor-AddBooks.php"><button class="text-btn">Add Books</button></a>
            <a href="Editor-BooksOwned.php"><button class="chosen-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="text-btn">Account</button></a>
            <a href="../process/Guest/logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-part">
        <div class="upper-content">
            <img src="../process/editor/display_cover.php?book_id=<?= $book_id ?>" alt="Book Cover" style="margin-top: 25px; width: 200px; height: 250px; border-radius: 5px;" />
            <div class="title-and-author" style="margin-top: -75px;">
                <h1><?= htmlspecialchars($title) ?></h1>
                <h4><?= htmlspecialchars($author_name ?? 'Unknown Author') ?></h4>
            </div>
            <a href="Editor-BooksOwned.php">
                <button>Back</button>
            </a>
        </div>
        <div class="section-bg">
            <div class="divider"></div>
            <div class="details-part">  
                <div class="left-details">
                    <h4>Description</h4>
                    <p><?= nl2br(htmlspecialchars($description)) ?></p>
                </div>
                <div class="right-details">
                    <h4>Editor</h4>
                    <p><?= htmlspecialchars($editor_fname . ' ' . $editor_lname) ?></p>
                    <h4>Language</h4>
                    <p><?= htmlspecialchars($language) ?></p>
                    <h4>Date Published</h4>
                    <p><?= htmlspecialchars($formatted_date) ?></p>
                    <h4>Current Status</h4>
                    <p><?= htmlspecialchars(ucfirst($status)) ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>