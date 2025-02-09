<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['location'] = $_POST['location'];
    }

    if (isset($_POST['skip_security'])) {
        header("Location: ../../process/Guest/sign-up.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up | Add Security</title>
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
                <form action="../../process/Guest/sign-up.php" method="post">
                    <div class="info">
                        <p>You can add more security to your</p>
                        <p>Account</p>
                    </div>

                    <div class="choose">
                        <button type="button" onclick="window.location.href='signupQA.php'">
                            <img src="../../Logos/contract.png" alt="">Question & Answer
                        </button>
                    </div>

                    <div class="prev_next">
                        <a href="signupThird_step.php" ><p>GO BACK</p></a>
                        <button type="Submit" name="skip_security"><p>SIGN UP</p></a> 
                    </div>
                    <div class="sign">
                        <p>Already have an account? <a href="../login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <script>
    // Convert PHP session data to JavaScript object
    var sessionData = <?php echo json_encode($_SESSION); ?>;
    
    // Log session data to the browser console
    console.log("User Session Data:", sessionData);
</script>

</body>
</html>