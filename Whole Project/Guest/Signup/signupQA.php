<?php
session_start();


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
                <form action="" method="post">
                    <select name="security_question" id="security_question" required>
                        <option value="Who is you best friend?">Who is you best friend?</option>
                        <option value="Where did you graduated in elementary school?">Where did you graduated in elementary school?</option>
                    </select>
                    <input type="text" name="" id="" placeholder="Answer">
                    
                    <br>
                    <div class="prev_sub">
                        <a href="signupForth_step.php" ><p>GO BACK</p></a>
                        <a href="successful.html"><p>SUBMIT</p></a>
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