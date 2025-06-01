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
            <a href="../../Guest/login.php"><button class="logout">Logout</button></a>
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
                    <option value="">Date Added</option>
                    <option value="">A - Z</option>
                    <option value="">Date Published</option>
                </select>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <a href="">
                    <i id="mic-icon" class="fa-solid fa-microphone"></i>
                </a>
                <input type="search" name="searchbar" id="searchbar-field" placeholder="Search book name, author...">
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
                        <!-- Example rows -->
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Archived</td>
                            <td>
                                <a href="Editor-BooksOwned-Archived.php">
                                    <button>View</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Add 10+ more rows to test the scrolling -->
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <a href="Editor-BooksOwned-Available.php">
                                    <button>View</button>
                                </a>
                            </td>
                        </tr>
                        <!-- Repeat rows for demonstration -->
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>For Approval</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>The Escapers</td>
                            <td>July 15, 1990</td>
                            <td>January 1, 2025</td>
                            <td>Available</td>
                            <td>
                                <button onclick="viewBook()">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>