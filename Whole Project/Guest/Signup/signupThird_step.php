<?php
    session_start(); // Start the session to store data

    // Save first name, last name, and birthdate from the previous step into the session
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['birthdate'] = $_POST['birthdate'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up | Member Credentials</title>
</head>
<body>
    <div class="container">

        <div class="picture">
            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <img src="../../images/weblogo.png">
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <div class="link">
                    <p>All Rights Reserved</p>
                    <p>2024-2025</p>
                </div>
                
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../../images/weblogo.png" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <h1>Sign Up</h1>
                <form action="signupForth_step.php" method="post">

                    <label for="">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="Man">Man</option>
                        <option value="Woman">Woman</option>
                        <option value="Gay">Gay</option>
                        <option value="Bisexual">Bisexual</option>
                        <option value="Others">Others</option>
                    </select>

                    <label for="location">Location</label>
                    <select name="location" id="location" required>
                        <option value="Metro Manila">Metro Manila</option>
                        <option value="Northern Luzon">Nothern Luzon</option>
                        <option value="Visayas">Visayas</option>
                        <option value="Mindanao">Mindanao</option>
                    </select>

                    <div class="prev_next">
                        <a href="signupSecond_step.php" ><p>GO BACK</p></a>
                        <button type="submit"><p>NEXT</p></button>
                    </div>
                    <div class="sign">
                        <p>Already have an account? <a href="../login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>