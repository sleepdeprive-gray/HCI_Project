<?php
session_start();
if (!isset($_SESSION['recovery_email'])) {
    header("Location: forgot.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/forgot.css" />
    <title>Update Password | Book Room</title>
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
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../../images/weblogo.png" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <div class="head">
                    <h2>Set New Password</h2>
                </div>
                <form action="../../process/Guest/update_password_process.php" method="post">
                    <div class="info">
                        <input type="password" name="new_password" placeholder="New Password" required>
                        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                        <?php if (isset($_GET['error'])): ?>
                            <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="prev_sub" style="display: flex;">
                        <a href="forgot.php" style="display: flex;">
                            <p>CANCEL</p>
                        </a>
                        <button type="submit" style="display: flex; background:none; border:none;">
                            <p>SUBMIT</p>
                        </button>
                    </div>
                    
                    <div class="signs">
                        <p>Don’t remember email nor have face registered?</p>
                        <a href="../administrator.php"><p>Contact administrator here.</p></a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>
