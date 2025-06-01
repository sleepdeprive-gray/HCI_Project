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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Web Icon-->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/addbooks.css">

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
            <a href="Editor-AddBooks.php"><button class="chosen-btn">Add Books</button></a> 
            <a href="Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="text-btn">Account</button> </a>
            <a href="../../Guest/login.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!--
    
        Main Content
        - Add Book Form
        - Title
        - Author & Genre
        - Language, Date Published
        - Add Front Cover & Author Photo
        - Add Back Cover
        - Book File Copy (PDF)
        - Popup Modal

                    -->

    <div class="form-background">
        <div class="form-container">
            <form id="addBookForm" action="../process/Editor/add-book.php" method="POST" enctype="multipart/form-data" require>
                <h3>Add a Book</h3>
                <div class="form-group-title">
                    <label for="title">Title</label><br>
                    <input type="text" name="title" id="title" placeholder="Add title here..." require>
                </div>
                
                <div class="form-group-author-genre">
                    <label for="authorname">Author Name</label>
                    <label for="genre" class="genre-space">Genre</label><br>
                    <input type="text" name="authorname" id="authorname" placeholder="Add author name here..." require>
                    <select name="genre" id="genre" require>
                        <option value="">Choose...</option>
                        <option value="Science">Science</option>
                        <option value="Novel">Novel</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Narrative">Narrative</option>
                        <option value="Fiction">Fiction</option>
                        <option value="History">History</option>
                        <option value="Fantasy">Fantasy</option>
                    </select>
                </div>
                
                <div>
                    <label for="description">Description</label><br>
                    <input type="text" name="description" id="description" placeholder="Add book description here..." require>
                </div>
                
                <div>
                    <label for="language">Language</label>
                    <label for="date-published" class="date-published-space" require>Date Published</label><br>
                    <select name="language" id="language">
                        <option value="">Choose...</option>
                        <option value="English">English</option>
                        <option value="Filipino">Filipino</option>
                        <option value="Others">Others</option>
                    </select>
                    <input type="date" name="date-published" id="date-published" require>
                </div>
        
                <div class="bottom-part">
                    <div class="file-upload-left">
                        <div class="file-upload-item">
                            <label for="front-upload">Front Cover</label>
                            <input type="file" name="front-upload" id="front-upload" accept="image/*" require>
                        </div>
                        
                        <div class="file-upload-item">
                            <label for="back-upload">Back Cover</label>
                            <input type="file" name="back-upload" id="back-upload" accept="image/*" require>
                        </div>
                        
                        <div class="file-upload-item">
                            <label for="book-file-upload">Book File Copy (PDF)</label>
                            <input type="file" name="book-file-upload" id="book-file-upload" accept="application/pdf" require>
                        </div>
                    </div>
                    
                    <div class="file-upload-right">
                        <div class="file-upload-item">
                            <label for="author-upload">Author Photo</label>
                            <input type="file" name="author-upload" id="author-upload" accept="image/*" require>
                        </div>
                        
                        <div class="submit-item">
                            <button type="button" id="addBookButton">Preview</button>
                        </div>
                        
                        <p class="form-footer"><span style="color: black;">book.</span><span style="color: #A1BE95;">room</span></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addBookModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div class="book-details">
                <div>
                    <span id="modal-genre">Genre</span>
                </div>
                <div>
                    <span id="modal-title">Title Name</span>
                </div>
                <div>
                    <span id="modal-author">Author Name</span>
                </div>
                <div class="images">
                    <img id="modal-front-cover" src="" alt="Front Cover" class="space1">
                    <img id="modal-back-cover" src="" alt="Back Cover" class="space2">
                </div>
            </div>
            <br>
            <div class="modal-actions">
                <button id="editButton">Edit</button>
                <button id="addButton">Add Book</button>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="js/addbooks-popup.js"></script>

</body>
</html>