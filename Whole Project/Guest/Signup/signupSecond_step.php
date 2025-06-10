<?php
    session_start();

    if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
        header("Location: signup.php");
        exit();
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
                <form action="signupThird_step.php" method="post">
                    <input type="text" name="firstname" id="firstname" placeholder="First name" required>
                    <input type="text" name="lastname" id="lastname" placeholder="Last name" required>
                    <label for="">Birthday</label>
                    <input type="date" name="birthdate" id="birthdate" required>
                  
                    <div class="prev_next">
                        <a href="signup.php"><p>GO BACK</p></a>
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