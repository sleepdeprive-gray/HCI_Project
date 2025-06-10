<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forgot.css">
    <title>Forgot Account | Book Room</title>
    <link rel="shortcut icon" href="../../images/weblogo.png" type="image/x-icon">
</head>
<body>
    <div class="container">

        <div class="picture">
            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <img src="../../images/weblogo.png">
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <p class="link">Already know the password? <a href="../login.php">Click Here</a>.</p>
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../../images/weblogo.png" alt="">
                <p>book.<span>room</span></p>
            </div>
            <div class="forms">
                <h1>Recover Account</h1>
                    <form action="../../process/Guest/forgot.php" method="post">
                        <div class="info">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="recovery-option">
                            <div class="choose">
                                <button type="submit" name="method" value="qa">
                                    <img src="../../Logos/contract.png" alt="">
                                    Question & Answer
                                </button>
                                <button type="submit" name="method" value="otp">
                                    <img src="../../icons/otp.png" alt="">
                                    One-Time Password
                                </button>
                            </div>
                        </div>
                    </form>
                <div class="signs">
                    <p>Don’t remember email nor have these?</p>
                    <a href="../administrator.php"><p>Contact administrator here.</p></a>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>