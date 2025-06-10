<?php
    session_start();
    include '../process/database_connection.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Editor') {
        header("Location: ../Guest/login.php");
        exit();
    }

    $editor_id = $_SESSION['user_id'];

    $sql_editor_info = "SELECT first_name, last_name, email, phone, secondary_email, gender, location, birthdate, security_question, sq_answer FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql_editor_info);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $editor_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $email, $phone, $secondary_email, $gender, $location, $birthdate, $security_question, $sq_answer);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/accounts.css">
</head>
<body>
    <header class="logo-and-title">
        <img src="../images/weblogo.png" alt="book room logo">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    </header>

    <div class="sidebar">
        <h1>Book <span style="color: #A1BE95;">Room</span></h1>
        <div class="profile">
            <img src="../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
            <h2><?= htmlspecialchars($first_name ?: 'Editor') ?></h2>
            <p>Editor</p>
            <hr>
        </div>
        <div class="menu">
            <a href="Editor-Dashboard.php"><button class="text-btn">Dashboard</button></a>
            <a href="Editor-Books.php"><button class="text-btn">Books</button></a>
            <a href="Editor-AddBooks.php"><button class="text-btn">Add Books</button></a>
            <a href="Editor-BooksOwned.php"><button class="text-btn">Book Owned</button></a>
            <br><br><br><br><br><br><br><br><br>
            <a href="Editor-Accounts.php"><button class="chosen-btn">Account</button></a>
            <a href="../process/Guest/logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <div class="main-content">
        <div class="personal-information-part">
            <div class="personal-information-content">
                <h3>Personal Information</h3>
                <div class="text-box"><h4><?= $birthdate ?></h4><p>Birthdate</p></div>
                <div class="text-box"><h4><?= $gender ?></h4><p>Gender</p></div>
                <div class="text-box"><h4><?= $location ?></h4><p>Location</p></div>
                <button id="openModal1"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
            </div>
        </div>

        <div class="right-side-part">
            <div class="picture-name-userid-part">
                <img src="../process/view.php?user_id=<?= $_SESSION['user_id'] ?>" alt="Profile Picture" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
                <h1><?= htmlspecialchars($first_name . ' ' . $last_name) ?></h1>
                <div class="user-id">
                    <p>User ID</p>
                    <div class="userid-background"><h2><?= $editor_id ?></h2></div>
                </div>
            </div>
            <div class="user-credentials">
                <div class="credentials-left">
                    <h2 class="space">Account Credentials</h2>
                    <div class="divider">
                        <h3>Email</h3><div class="credentials-text-box"><h4><?= $email ?></h4></div>
                        <h3>Phone Number</h3><div class="credentials-text-box"><h4><?= $phone ?></h4></div>
                        <h3>Secondary Email</h3><div class="credentials-text-box"><h4><?= $secondary_email ?></h4></div><br>
                    </div>
                </div>
                <div class="credentials-right">
                    <h3>Security Question</h3>
                    <div class="credentials-text-box"><h4><?= $security_question ?></h4></div>
                    <div class="buttons">
                        <button id="openModal2"><i class="fa-regular fa-pen-to-square"></i> Update</button>
                        <button id="openModal3"><i class="fa-regular fa-pen-to-square"></i> Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Personal Info -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal1">&times;</span>
            <h2>Update Profile Info</h2>
            <form action="../process/update_account.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="profile">
                <div class="section">
                    <div class="left-side">
                        First Name<br><input type="text" name="first_name" value="<?= $first_name ?>"><br>
                        Last Name<br><input type="text" name="last_name" value="<?= $last_name ?>"><br>
                        Gender<br>
                        <select name="gender">
                            <option <?= $gender == "Cis Male" ? "selected" : "" ?>>Cis Male</option>
                            <option <?= $gender == "Lesbian" ? "selected" : "" ?>>Lesbian</option>
                            <option <?= $gender == "Others" ? "selected" : "" ?>>Others</option>
                        </select><br>
                        Location<br>
                        <select name="location">
                            <option <?= $location == "Metro Manila" ? "selected" : "" ?>>Metro Manila</option>
                            <option <?= $location == "Visayas" ? "selected" : "" ?>>Visayas</option>
                            <option <?= $location == "Mindanao" ? "selected" : "" ?>>Mindanao</option>
                            <option <?= $location == "Hollow Earth" ? "selected" : "" ?>>Hollow Earth</option>
                        </select><br>
                        Birthdate<br><input type="date" name="birthdate" value="<?= $birthdate ?>"><br>
                    </div>
                    <div class="right-side-1">
                        Upload New Profile Picture<br><input type="file" name="profile_picture">
                    </div>
                </div><br><br>
                <div class="button-container">
                    <button type="button" id="cancel-button">Cancel</button>
                    <button type="submit" id="update-button">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Credentials -->
    <div id="modal2" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal2">&times;</span>
            <h2>Update Credentials</h2>
            <form action="../process/update_account.php" method="post">
                <input type="hidden" name="action" value="credentials">
                <div class="section">
                    <div class="left-side">
                        Email<br><input type="email" name="email" value="<?= $email ?>"><br>
                        Phone Number<br><input type="text" name="phone_number" value="<?= $phone ?>"><br>
                        Secondary Email<br><input type="email" name="secondary_email" value="<?= $secondary_email ?>"><br>
                    </div>
                    <div class="right-side">
                        Security Question<br>
                        <select name="security_question">
                            <option <?= $security_question == "Who is your Mother?" ? "selected" : "" ?>>Who is your Mother?</option>
                            <option <?= $security_question == "What is your favorite color?" ? "selected" : "" ?>>What is your favorite color?</option>
                            <option <?= $security_question == "What is your birthplace?" ? "selected" : "" ?>>What is your birthplace?</option>
                            <option <?= $security_question == "What is your nickname?" ? "selected" : "" ?>>What is your nickname?</option>
                        </select><br>
                        Answer<br><input type="text" name="security_answer" value="<?= $sq_answer ?>"><br>
                    </div>
                </div><br><br>
                <div class="button-container">
                    <button type="button" id="cancel-button">Cancel</button>
                    <button type="submit" id="update-button">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password -->
    <div id="modal3" class="modal">
        <div class="modal-content-1">
            <span class="close" id="closeModal3">&times;</span>
            <h2>Update Password</h2>
            <form action="../process/update_account.php" method="post">
                <input type="hidden" name="action" value="password">
                <div class="change-password">
                    Old Password<br><input type="password" name="old_password"><br>
                    New Password<br><input type="password" name="new_password"><br>
                    Confirm New Password<br><input type="password" name="confirm_password"><br>
                </div>
                <div class="button-container-1">
                    <button type="button" id="cancel-button">Cancel</button>
                    <button type="submit" id="update-button">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/accounts-popup.js"></script>
</body>
</html>
