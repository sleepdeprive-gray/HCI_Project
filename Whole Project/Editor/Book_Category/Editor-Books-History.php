<?php
    session_start();
    include '../../process/database_connection.php'; 

    // Ensure only logged-in editors can access this page
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
        header("Location: ../../Guest/login.php");
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
            <img src="https://placehold.co/80" alt="Profile Picture">
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
    <div class="search-bar">
        <a href="">
            <i id="mic-icon" class="fa-solid fa-microphone"></i>
        </a>
        <input type="search" name="searchbar" id="searchbar-field" placeholder="Search book name, author...">
        <a href="">
            <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
        </a>
    </div>


    <!-- Navigation -->
    <div class="navigations">
        <select name="Order" id="order-dropdown">
            <option value="Ascending">ASC</option>
            <option value="Descending">DESC</option>
        </select>
        <select name="Sort Type" id="sort-type-dropdown">
            <option value="">DEFAULT</option>
            <option value="">DOWNLOAD</option>
            <option value="">A - Z</option>
        </select>
        <ul>
            <li><a href="../Editor-Books.php">Science</a></li>
            <li><a href="Editor-Books-Novel.php">Novel</a></li>
            <li><a href="Editor-Books-Mystery.php">Mystery</a></li>
            <li><a href="Editor-Books-Narrative.php">Narrative</a></li>
            <li><a href="Editor-Books-Fiction.php">Fiction</a></li>
            <li class="genre-selected"><a href="Editor-Books-History.php">History</a></li>
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
            <tr>
                <td>1</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>The Escapers</td>
                <td>Lj Monahan</td>
                <td>7</td>
                <td>
                    <a href="../Editor-Books-View.php">
                        <button class = "view-button">View</button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Table Pages -->
    <div class="pages">
        <ul>
            <li>
                <a href="">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>
            <li>
               <a href="" class = "current-page">
                    1
               </a>
            </li>
            <li>
                <a href="">
                    2
               </a>
            </li>
            <li>
                <a href="">
                    3
               </a>
            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>

</body>
</html>