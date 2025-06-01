<?php
    session_start();
    include '../process/database_connection.php'; 

    // Ensure only logged-in editors can access this page
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
        header("Location: ../Guest/login.php");
        exit();
    }

    $editor_id = $_SESSION['user_id']; // Current editor ID

    // Fetch the editor's first name (original query)
    $sql_editor_name = "SELECT first_name FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql_editor_name);
    $stmt->bind_param("i", $editor_id);
    $stmt->execute();
    $stmt->bind_result($editor_name);
    $stmt->fetch();
    $stmt->close();

    // Fetch the editor's last name (new, separate query)
    $sql_last_name = "SELECT last_name FROM users WHERE user_id = ?";
    $stmt_last = $conn->prepare($sql_last_name);
    $stmt_last->bind_param("i", $editor_id);
    $stmt_last->execute();
    $stmt_last->bind_result($editor_last_name);
    $stmt_last->fetch();
    $stmt_last->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Web page Icon -->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!-- Icon Import -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/accounts.css">

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
            <a href="Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="chosen-btn">Account</button> </a>
            <a href="../process/Guest/logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!--
    
        Main Content
        - Personal Information
        - Picture, Name & User ID
        - Account Credentials
        - Update Profile Popup
        - Update Credentials Popup
        - Change Password Popup

                -->

    <div class="main-content">
        <div class="personal-information-part">
            <div class="personal-information-content">
                <h3>Personal Information</h3>
                <div class = "text-box">
                    <h4>December 12, 1994</h4>
                    <p>Birthdate</p>
                </div>
                <div class = "text-box">
                    <h4>Cis Male</h4>
                    <p>Gender</p>
                </div>
                <div class = "text-box">
                    <h4>Metro Manila</h4>
                    <p>Location</p>
                </div>
                <button id="openModal1">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                </button>
            </div>
        </div>
        
        <div class="right-side-part">
            <div class="picture-name-userid-part">
                <img src="../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
                <h1><?php echo htmlspecialchars(($editor_name ?? '') . ' ' . ($editor_last_name ?? '')); ?></h1>
                <div class="user-id">
                    <p>User ID</p>
                    <div class="userid-background">
                        <h2>1</h2>
                    </div>
                </div>
            </div>
            <div class="user-credentials">
                <div class="credentials-left">
                    <h2  class ="space">Account Credentials</h2>
                    <div class="divider">
                        <h3>Email</h3>
                        <div class="credentials-text-box">
                            <h4>gray@email.com</h4>
                        </div>
                        <h3>Phone Number</h3>
                        <div class="credentials-text-box">
                            <h4>+639389042134</h4>
                        </div>
                        <h3>Secondary Email</h3>
                        <div class="credentials-text-box">
                            <h4>gray2@email.com</h4>
                        </div> <br> 
                    </div>
                </div>
                <div class="credentials-right">
                    <h3>Security Question</h3>
                    <div class="credentials-text-box">
                        <h4>Who is your mother?</h4>
                    </div>
                    <div class="buttons">
                            <button id="openModal2">
                                <i class="fa-regular fa-pen-to-square"></i> Update
                            </button>
                            <button id="openModal3">
                                <i class="fa-regular fa-pen-to-square"></i> Change Password
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for Button -->

    <!-- Update Personal Information -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal1">&times;</span>
            <h2>Update Profile Info</h2>
            <div class="section">
                <div class="left-side">
                    First Name<br> <input type="text"> <br>
                    Last Name<br><input type="text"> <br>
                    Gender <br>
                    <select name="gender" id="">
                        <option value="">Cis Male</option>
                        <option value="">Cis Male</option>
                        <option value="">Lesbian</option>
                        <option value="">Others</option>
                    </select> <br>
                    Location  <br>
                    <select name="gender" id="">
                        <option value="">Metro Manila</option>
                        <option value="">Visayas</option>
                        <option value="">Mindanao</option>
                        <option value="">Hollow Earth</option>
                    </select> <br>
                    Birthdate  <br>
                    <input type="date" name="birthdate" id="birthdate"> <br>
                </div>
                <div class="right-side-1">
                    Upload New Profile Picture <br>
                    <input type="file" name="" id="">
                </div>
            </div> <br> <br>
            <div class="button-container">
                <button id="cancel-button">Cancel</button>
                <button id="update-button">Update</button>
            </div>
        </div>
    </div>

    <!-- Update Credentials -->
    <div id="modal2" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal2">&times;</span>
            <h2>Update Credentials</h2>
            <div class="section">
                <div class="left-side">
                    Email<br> <input type="email"> <br>
                    Phone Number<br><input type="Number"> <br>
                    Secondary Email<br> <input type="email"> <br>
                </div>
                <div class="right-side">
                    Security Question <br>
                    <select name="" id="">
                        <option value="">Who is your Mother?</option>
                        <option value="">What is your favorite color?</option>
                        <option value="">What is your birthplace?</option>
                        <option value="">What is your nickname?</option>
                    </select> <br>
                    Answer<br> <input type="text"> <br>
                </div>
            </div> <br> <br>
            <div class="button-container">
                <button id="cancel-button">Cancel</button>
                <button id="update-button">Update</button>
            </div> 
        </div>
    </div>

    <!-- Change Password -->
    <div id="modal3" class="modal">
        <div class="modal-content-1">
            <span class="close" id="closeModal3">&times;</span>
            <h2>Update Password</h2>
            <div class="change-password">
                Old Password<br> <input type="password"> <br>
                New Password<br><input type="password"> <br>
                Confirm New Password<br><input type="password"> <br>
            </div>
            <div class="button-container-1">
                <button id="cancel-button">Cancel</button>
                <button id="update-button">Update</button>
            </div> 
        </div>
    </div>

    <!-- Scripts -->
     <script src="js/accounts-popup.js"></script>

</body>
</html>