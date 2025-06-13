<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title> BR | Login</title>
        <!--Web Icon-->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">
</head>
<body>
    <div class="container">

        <div class="picture">
            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <a href="../Website/Guest.php">
                    <img src="../images/weblogo.png">
                </a>
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <p class="link">Forgot Password? <a href="Forgot/forgot.php">Click Here</a>.</p>
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../images/weblogo.png" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <h1>LOGIN</h1>
                <form action="../process/Guest/login-validation.php" method="post">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <div class="button">
                        <button type="submit" class="loginButton">Login</button>
                    </div>
                    <div class="sign">
                        <p>Didn't have an account? <a href="Signup/signup.php">Sign Up.</a></p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>