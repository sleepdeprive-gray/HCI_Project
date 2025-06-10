<?php
    
    session_start();
    include '../process/database_connection.php'; 

    // Ensure only logged-in editors can access this page
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
        header("Location: ../Guest/login.php");
        exit();
    }

    $editor_id = $_SESSION['user_id']; // Current editor ID

    // Fetch the editor's name
    $sql_editor_name = "SELECT first_name FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql_editor_name);
    $stmt->bind_param("i", $editor_id);
    $stmt->execute();
    $stmt->bind_result($editor_name);
    $stmt->fetch();
    $stmt->close();

    if (!isset($_GET['book_id'])) {
        header("Location: Editor-Books.php");
        exit();
    }

    $book_id = intval($_GET['book_id']);

    $sql_book = "SELECT b.title, a.author_name, b.description, b.language, b.date_published, u.first_name, u.last_name, b.front_cover
                 FROM books b
                 LEFT JOIN authors a ON b.author_id = a.author_id
                 JOIN users u ON b.editor_id = u.user_id
                 WHERE b.book_id = ?";
    $stmt = $conn->prepare($sql_book);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->bind_result($title, $author_name, $description, $language, $date_published, $editor_fname, $editor_lname, $front_cover);
    $stmt->fetch();
    $stmt->close();

    $formatted_date = date("F j, Y", strtotime($date_published));

    // ✅ Use a PHP script to serve the BLOB image
    $cover_path = "../process/Editor/display_cover.php?book_id=" . $book_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Icon Import -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!--Web Icon-->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!--CSS Stylesheets-->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/book-view.css">

</head>
<body>
    <!--Logo and Title -->
    <header class ="logo-and-title">
        <img src="../images/weblogo.png" alt="book room logo">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    </header>

    <!-- Navigations Panel-->
    <div class="sidebar">
        <h1>Book <span style="color: #A1BE95;">Room</span></h1>
        <div class="profile">
            <img src="../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
            <h2><?php echo htmlspecialchars($editor_name ?: 'Editor'); ?></h2>
            <p>Editor</p>
            <hr>
        </div>
        <div class="menu">
            <a href="Editor-Dashboard.php"><button class="text-btn">Dashboard</button></a>
            <a href="Editor-Books.php"><button class="chosen-btn">Books</button></a> 
            <a href="Editor-AddBooks.php"><button class="text-btn">Add Books</button></a> 
            <a href="Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="text-btn">Account</button> </a>
            <a href="../process/Guest/logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!--
    
        Main Content
        - Upper Content (Book Picture, Name, Title, Back Button)
        - Left Details (Description)
        - right Details (Author, Language, Date Published)
    
                    -->

    <div class="content-part">
        <div class="upper-content">
            <img class="book-cover" src="<?= $cover_path ?>" alt="<?= htmlspecialchars($title) ?>" style="
                margin-top: 25px;
                width: 200px;
                height: 250px;
                border-radius: 5px;
            ">
            <div class="title-and-author" style=" 
                margin-top: -75px;
            ">
                <h1><?= htmlspecialchars($title) ?></h1>
                <h4><?= htmlspecialchars($author_name ?? 'Unknown Author') ?></h4>
            </div>
            <a href="Editor-Books.php">
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>