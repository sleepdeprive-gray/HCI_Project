
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="picture">
            <!-- <div class="LOGIN_SIGNUP">
                <a href=""><p>Login</p></a>
                <a href=""><p>Sign up</p></a>
            </div> -->

            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <img src="images/logo.jpg">
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <p class="link">Forgot Account? <a href="forgot.html">Click Here</a>.</p>
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="images/logo.jpg" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <h1>LOGIN</h1>
                <p id='demo' style="color: red;font-size: 20px;height:20px"></p>
                    <p></p>
                </div>
                <form action="login-validation.php" method="post">
                    <input type="email" name="email" id="" placeholder="Email">
                    <input type="password" name="password" id="" placeholder="Password">
                    <div class="button">
                        <button type="submit" name='submit' class="loginButton">Login</button>
                        <p>or</p>
                        <a href="faceRecognition.html"><button type="button" class="faceRecognitionButton">Face recognition</button></a>
                    </div>
                    <div class="terms">
                        <input type="checkbox" name="" id="">
                        <p>Agreed to Terms and Conditions</p>
                    </div>

                    <div class="sign">
                        <p>Didn’t have an account? <a href="signup.php">Sign Up.</a></p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
</body>
</html>