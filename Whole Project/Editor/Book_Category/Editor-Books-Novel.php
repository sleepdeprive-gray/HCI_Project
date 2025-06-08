<?php
    session_start();
    include '../../process/database_connection.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
        header("Location: ../Guest/login.php");
        exit();
    }

    $editor_id = $_SESSION['user_id'];

    // Fetch editor's name
    $sql_editor_name = "SELECT first_name FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql_editor_name);
    $stmt->bind_param("i", $editor_id);
    $stmt->execute();
    $stmt->bind_result($editor_name);
    $stmt->fetch();
    $stmt->close();

    // Pagination setup
    $books_per_page = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $books_per_page;

    // Sanitize & get user inputs
    $searchTerm = $_GET['search'] ?? '';
    $orderParam = $_GET['order'] ?? '';
    $sortParam = $_GET['sort'] ?? '';

    // Escape for SQL
    $search = "%" . $conn->real_escape_string($searchTerm) . "%";
    $order = ($orderParam === 'Ascending') ? 'ASC' : 'DESC';

    // Determine ORDER BY column
    switch ($sortParam) {
        case 'DOWNLOAD':
            $orderBy = "b.downloads";
            break;
        case 'A - Z':
            $orderBy = "b.title";
            break;
        default:
            $orderBy = "b.book_id";
    }

    // Get total books count for pagination (genre + editor only)
    $sql_total = "SELECT COUNT(*) 
                  FROM books b
                  LEFT JOIN authors a ON b.author_id = a.author_id
                  WHERE b.editor_id = ?
                  AND b.genre = 'Science'
                  AND (b.title LIKE ? OR a.author_name LIKE ?)";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("iss", $editor_id, $search, $search);
    $stmt_total->execute();
    $stmt_total->bind_result($total_books);
    $stmt_total->fetch();
    $stmt_total->close();


    $total_pages = ceil($total_books / $books_per_page);

    // Final Query: Fetch filtered books
    $sql = "SELECT 
                b.book_id, b.title, b.genre, b.language, b.date_published, b.status, b.downloads,
                a.author_name
            FROM books b
            LEFT JOIN authors a ON b.author_id = a.author_id
            WHERE b.editor_id = ?
              AND b.genre = 'Science'
              AND (b.title LIKE ? OR a.author_name LIKE ?)
            ORDER BY $orderBy $order
            LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issii", $editor_id, $search, $search, $offset, $books_per_page);
    $stmt->execute();
    $result_books = $stmt->get_result();
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
    <link rel="shortcut icon" href="../../images/weblogo.png" type="image/x-icon">

    <!--CSS Stylesheets-->
    <link rel="stylesheet" href="../css/bg-and-nav.css">
    <link rel="stylesheet" href="../css/books.css">

</head>
<body>
    <!--Logo and Title -->
    <header class ="logo-and-title">
        <img src="../../images/weblogo.png" alt="book room logo">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    </header>

    <!-- Navigations Panel-->
    <div class="sidebar">
        <h1>Book <span style="color: #A1BE95;">Room</span></h1>
        <div class="profile">
           <img src="../../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
            <h2><?php echo htmlspecialchars($editor_name ?: 'Editor'); ?></h2>
            <p>Editor</p>
            <hr>
        </div>
        <div class="menu">
            <a href="../Editor-Dashboard.php"><button class="text-btn">Dashboard</button></a>
            <a href="../Editor-Books.php"><button class="chosen-btn">Books</button></a> 
            <a href="../Editor-AddBooks.php"><button class="text-btn">Add Books</button></a> 
            <a href="../Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="../Editor-Accounts.php"><button class="text-btn">Account</button> </a>
            <a href="../../../Guest/login.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- 
    
        Main Content 
        - Search Bar
        - Navigation (Table Order and Genre)
        - Table
        - Pagination

                                                    -->
    <!-- Search Bar -->
    <form method="GET" id="search-form" class="search-bar">
        <a href="#" type="button">
            <i id="mic-icon" class="fa-solid fa-microphone"></i>
        </a>
        <input 
            type="search" 
            name="search" 
            id="searchbar-field" 
            placeholder="Search book name, author..." 
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
        />
        <!-- Hidden inputs to carry dropdown values when submitting search -->
        <input type="hidden" name="order" id="order-hidden" value="<?= htmlspecialchars($_GET['order'] ?? 'Descending') ?>">
        <input type="hidden" name="sort" id="sort-hidden" value="<?= htmlspecialchars($_GET['sort'] ?? '') ?>">

        <a href="#" id="search-icon" type="button">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
    </form>

    <!-- Navigation -->
    <div class="navigations">
        <select name="Order" id="order-dropdown">
            <option value="Ascending" <?= ($_GET['order'] ?? '') === 'Ascending' ? 'selected' : '' ?>>ASC</option>
            <option value="Descending" <?= ($_GET['order'] ?? '') === 'Descending' ? 'selected' : '' ?>>DESC</option>
        </select>
        <select name="Sort Type" id="sort-type-dropdown">
            <option value="" <?= empty($_GET['sort']) ? 'selected' : '' ?>>DEFAULT</option>
            <option value="DOWNLOAD" <?= ($_GET['sort'] ?? '') === 'DOWNLOAD' ? 'selected' : '' ?>>DOWNLOAD</option>
            <option value="A - Z" <?= ($_GET['sort'] ?? '') === 'A - Z' ? 'selected' : '' ?>>A - Z</option>
        </select>
        <ul>
            <li><a href="../Editor-Books.php">Science</a></li>
            <li class="genre-selected"><a href="#">Novel</a></li>
            <li><a href="Editor-Books-Mystery.php">Mystery</a></li>
            <li><a href="Editor-Books-Narrative.php">Narrative</a></li>
            <li><a href="Editor-Books-Fiction.php">Fiction</a></li>
            <li><a href="Editor-Books-History.php">History</a></li>
            <li><a href="Editor-Books-Fantasy.php">Fantasy</a></li>
        </ul>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <th>Book No.</th>
            <th>Title</th>
            <th>Author</th>
            <th>Downloads</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php 
            if ($result_books->num_rows > 0) {
                // Calculate the numbering offset to reflect page number correctly
                $no = $offset + 1;
                while ($row = $result_books->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . intval($row['book_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['author_name'] ?? 'Unknown') . "</td>";
                    echo "<td>" . intval($row['downloads']) . "</td>";
                    echo "<td>
                            <a href='Editor-Books-View.php?book_id=" . intval($row['book_id']) . "'>
                                <button class='view-button'>View</button>
                            </a>
                          </td>";
                    echo "</tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='5'>No books found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Table Pages -->
    <div class="pages">
        <ul>
            <li>
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($searchTerm) ?>&order=<?= urlencode($orderParam) ?>&sort=<?= urlencode($sortParam) ?>"><i class="fa-solid fa-chevron-left"></i></a>
                <?php else: ?>
                    <span class="disabled"><i class="fa-solid fa-chevron-left"></i></span>
                <?php endif; ?>
            </li>

            <?php 
            for ($i = 1; $i <= $total_pages; $i++): 
                $active = $i == $page ? 'class="current-page"' : '';
                $url = "?page=$i&search=" . urlencode($searchTerm) . "&order=" . urlencode($orderParam) . "&sort=" . urlencode($sortParam);
            ?>
                <li><a href="<?= $url ?>" <?= $active ?>><?= $i ?></a></li>
            <?php endfor; ?>

            <li>
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($searchTerm) ?>&order=<?= urlencode($orderParam) ?>&sort=<?= urlencode($sortParam) ?>"><i class="fa-solid fa-chevron-right"></i></a>
                <?php else: ?>
                    <span class="disabled"><i class="fa-solid fa-chevron-right"></i></span>
                <?php endif; ?>
            </li>
        </ul>
    </div>

    <script src="../js/search-sort.js"></script>

</body>
</html>