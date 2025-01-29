<?php
session_start(); // Start the session to store form data

// Capture data from the previous form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Document</title>
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
                <form action="signupSecond_step.php" method="post" id="signup1">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                  
                    <button type="submit" class="next"><p>NEXT</p></button>

                    <div class="sign">
                        <p>Already have an account? <a href="../login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <script>
        
        function submitForm() {

        const form = document.getElementById('signup1');
        if (form.checkValidity()) {
            form.submit();
        } else {
            alert("Please fill out all required fields.");
        }
        }

    </script>
    
</body>

</html>