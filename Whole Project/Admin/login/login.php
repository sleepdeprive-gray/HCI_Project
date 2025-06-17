<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title> ADMIN | Login</title>
</head>
<body>
    <div class="container">

        <div class="picture">
            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <img src="../images/logos.png">
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <p class="link">Forgot Account? <a href="forgot.html">Click Here</a>.</p>
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../images/logos.png" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <h1>LOGIN</h1>
                <form action="../../process/Admin/login-validation.php" method="post">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <div class="button">
                        <button type="submit"class="loginButton">Login</button></a>
                    </div>
                       
                    
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>