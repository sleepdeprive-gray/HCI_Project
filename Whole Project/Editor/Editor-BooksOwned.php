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

    // Fetch books uploaded by this editor
    $sql_books = "SELECT book_id, title, date_published, upload_date, status FROM books WHERE editor_id = ?";
    $stmt_books = $conn->prepare($sql_books);

    if (!$stmt_books) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt_books->bind_param("i", $editor_id);
    $stmt_books->execute();
    $result_books = $stmt_books->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Webpage Icon -->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!-- Icon Import -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/books-owned.css">

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
            <a href="Editor-Books.php"><button class="text-btn">Books</button></a> 
            <a href="Editor-AddBooks.php"><button class="text-btn">Add Books</button></a> 
            <a href="Editor-BooksOwned.php"><button class="chosen-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="text-btn">Account</button> </a>
            <a href="../process/Guest/logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!--
    
        Main Content
        - Search Bar
        - Sorting Dropdown
        - List of Books Owned

                        -->

    <div class="main-content">

        <div class="top-content">

            <div class="sorting-dropdown">
                <select name="sorting-type" id="sorting-dropdown">
                    <option value="upload_date">Date Added</option>
                    <option value="az">A - Z</option>
                    <option value="date_published">Date Published</option>
                </select>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <a href="">
                    <i id="mic-icon" class="fa-solid fa-microphone"></i>
                </a>
                <input type="search" name="searchbar" id="searchbar-field" placeholder="Search book name, status...">
                <a href="">
                    <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>

        </div>

        <div class="books-owned-table">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Date Published</th>
                            <th>Date Added</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result_books->num_rows > 0): ?>
                            <?php while ($row = $result_books->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars(date("F j, Y", strtotime($row['date_published']))) ?></td>
                                    <td><?= htmlspecialchars(date("F j, Y", strtotime($row['upload_date']))) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td>
                                        <a href="Editor-BooksOwned-View.php?book_id=<?= $row['book_id'] ?>">
                                            <button>View</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                             <tr id="no-results" style="display: none;">
                                <td colspan="5" style="text-align: center; font-style: italic;">No Books Added</td>
                            </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; font-style: italic;">No books found.</td>
                                </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script src="js/editor-books-owned.js"></script>

</body>
</html>