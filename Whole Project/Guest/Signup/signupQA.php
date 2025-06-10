<?php
    session_start();

    if (
        empty($_SESSION['email']) || 
        empty($_SESSION['password']) || 
        empty($_SESSION['firstname']) || 
        empty($_SESSION['lastname']) || 
        empty($_SESSION['birthdate']) || 
        empty($_SESSION['gender']) || 
        empty($_SESSION['location'])
    ) {
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
    <title>BR | Add Security</title>
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
                <div class="head">
                    <h2>Add security to</h2>
                    <h2> your account</h2>
                </div>

                <form action="../../process/Guest/sign-up.php" method="post">
                    <select name="security_question" id="security_question" required>
                        <option value="Who is your best friend?">Who is your best friend?</option>
                        <option value="Where did you graduate in elementary school?">Where did you graduate in elementary school?</option>
                    </select>
                    
                    <input type="text" name="security_answer" placeholder="Answer" required>
                    
                    <br>
                    <div class="prev_sub">
                        <a href="signupForth_step.php"><p>GO BACK</p></a>
                        <button type="submit"><p>SUBMIT</p></button>
                    </div>

                    <div class="signs">
                        <p>Something went wrong?</p>
                        <a href="../administrator.html"><p>Contact administrator here.</p></a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>