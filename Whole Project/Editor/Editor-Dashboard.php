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

// Fetch total approved books
$query = "SELECT COUNT(*) AS total FROM books WHERE status = 'approved'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_books = $row['total'] ?? 0;

// Fetch the total downloads of all books by this editor
$sql_total_downloads = "SELECT SUM(downloads) FROM books WHERE editor_id = ?";
$stmt = $conn->prepare($sql_total_downloads);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($total_downloads);
$stmt->fetch();
$stmt->close();

// Function to limit description length
function truncateDescription($description, $limit = 400) {
    return strlen($description) > $limit ? substr($description, 0, $limit) . '...' : $description;
}

// Fetch the most downloaded book
$sql_most_downloaded = "SELECT title, downloads, front_cover, description FROM books WHERE editor_id = ? ORDER BY downloads DESC LIMIT 1";
$stmt = $conn->prepare($sql_most_downloaded);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($most_downloaded_title, $most_downloads, $most_downloaded_image, $most_downloaded_desc);
$stmt->fetch();
$stmt->close();

// Fetch the least downloaded book
$sql_least_downloaded = "SELECT title, downloads, front_cover, description FROM books WHERE editor_id = ? ORDER BY downloads ASC LIMIT 1";
$stmt = $conn->prepare($sql_least_downloaded);
$stmt->bind_param("i", $editor_id);
$stmt->execute();
$stmt->bind_result($least_downloaded_title, $least_downloads, $least_downloaded_image, $least_downloaded_desc);
$stmt->fetch();
$stmt->close();

$conn->close();
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
    <link rel="stylesheet" href="css/dashboard.css">

</head>
<body>

    <!--Logo and Title -->
    <header class ="logo-and-title">
        <img src="../images/weblogo.png" alt="book room logo">
        <h2>
            Book<br><span style="color: #A1BE95;">Room</span>
        </h2>
    </header>

    <!-- Navigations Panel-->
    <div class="sidebar">
        <h1>Book <span style="color: #A1BE95;">Room</span></h1>
        <div class="profile">
            <img src="https://placehold.co/80" alt="Profile Picture">
            <h2><?php echo htmlspecialchars($editor_name ?: 'Editor'); ?></h2>
            <p>Editor</p>
            <hr>
        </div>
        <div class="menu">
            <a href="Editor-Dashboard.php"><button class="chosen-btn">Dashboard</button></a>
            <a href="Editor-Books.php"><button class="text-btn">Books</button></a> 
            <a href="Editor-AddBooks.php"><button class="text-btn">Add Books</button></a> 
            <a href="Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="text-btn">Account</button> </a>
            <a href="../../Guest/login.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dashboard-content">
        <div class="right-content">
            <!-- Most Downloaded Book -->
            <div class="high-download-content">
                <div class="download-content">
                    <img src="<?php echo $most_downloaded_image ? $most_downloaded_image : '../images/book-1.png'; ?>" alt="highest download book">
                    <div class="content-right-wrapper">
                        <p><b>YOUR MOST DOWNLOADED BOOK</b></p>
                        <h2><?php echo $most_downloaded_title ?: 'No Books Available'; ?></h2>
                        <p>WITH OVER <span class="highlight-number"><?php echo $most_downloads ?: 0; ?></span> DOWNLOADS</p>
                    </div>
                    <button onclick="openPopupMost()">View book</button>
                </div>
            </div>
            <!-- Least Downloaded Book -->
            <div class="low-download-content">
                <div class="download-content">
                    <img src="<?php echo $least_downloaded_image ? $least_downloaded_image : '../images/book-1.png'; ?>" alt="lowest download book">
                    <div class="content-right-wrapper">
                        <p><b>YOUR LEAST DOWNLOADED BOOK</b></p>
                        <h2><?php echo $least_downloaded_title ?: 'No Books Available'; ?></h2>
                        <p>WITH ONLY <span class="highlight-number"><?php echo $least_downloads ?: 0; ?></span> DOWNLOADS</p>
                    </div>
                    <button onclick="openPopupLeast()">View book</button>
                </div>
            </div>
        </div>

        <!-- Left Content -->
        <div class="left-content">
            <div class="download-content">
                <img src="../images/publish.png" alt="publish book logo">
                <div class="content-left-wrapper">
                    <h2><b id="published-counter"><?php echo $total_books; ?></b></h2>
                    <h4>Total Books Published</h4>
                </div>
            </div>
            <div class="download-content">
                <img src="../images/download.png" alt="total book logo">
                <div class="content-left-wrapper">
                    <h2><b id="download-counter"><?php echo $total_downloads ?: 0; ?></b></h2>
                    <h4>Total Downloads of Books</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal for Most Downloaded Book -->
    <div id="popup-modal" class="popup-modal">
        <div class="popup-content">
            <span class="close-button" onclick="closePopupMost()">&times;</span>
            <div class="popup-layout">
                <div class="left-side">
                    <h3><i class="fa-solid fa-book"></i>YOUR MOST DOWNLOADED BOOK</h3>
                    <img src="<?php echo $most_downloaded_image ? $most_downloaded_image : '../images/book-1.png'; ?>" alt="Most Downloaded Book">
                </div>
                <div class="right-side">
                    <h2><?php echo $most_downloaded_title ?: 'No Books Available'; ?></h2>
                    <p><?php echo truncateDescription($most_downloaded_desc ?: 'No description available.'); ?></p>
                    <p class="total-downloads">WITH OVER <span class="highlight-number"><b id="popup-most-counter"><?php echo $most_downloads ?: 0; ?></b></span> DOWNLOADS</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal for Least Downloaded Book -->
    <div id="popup-modal-least" class="popup-modal">
        <div class="popup-content">
            <span class="close-button" onclick="closePopupLeast()">&times;</span>
            <div class="popup-layout">
                <div class="left-side">
                    <h3><i class="fa-solid fa-book"></i>YOUR LEAST DOWNLOADED BOOK</h3>
                    <img src="<?php echo $least_downloaded_image ? $least_downloaded_image : '../images/book-1.png'; ?>" alt="Least Downloaded Book">
                </div>
                <div class="right-side">
                    <h2><?php echo $least_downloaded_title ?: 'No Books Available'; ?></h2>
                    <p><?php echo truncateDescription($least_downloaded_desc ?: 'No description available.'); ?></p>
                    <p class="total-downloads">WITH ONLY <span class="highlight-number-2"><b id="popup-least-counter"><?php echo $least_downloads ?: 0; ?></b></span> DOWNLOADS</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var totalBooks = <?php echo $total_books ?: 0; ?>;
        var totalDownloads = <?php echo $total_downloads ?: 0; ?>;
        var mostDownloads = <?php echo $most_downloads ?: 0; ?>;
        var leastDownloads = <?php echo $least_downloads ?: 0; ?>;
    </script>

    <!-- Scripts -->
    <script src="js/dashboard-animate-counter.js"></script>
    <script src="js/popup-modal.js"></script>

</body>
</html>