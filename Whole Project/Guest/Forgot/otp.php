<?php
session_start();
if (!isset($_SESSION['recovery_email'])) {
    echo "<script>alert('Session expired.'); window.location.href = 'forgot.php';</script>";
    exit();
}
include '../../process/database_connection.php';

$otp_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_otp = trim($_POST['otp']);
    $email = $_SESSION['recovery_email'];

    $stmt = $conn->prepare("SELECT otp FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $correct_otp = $row['otp'];
    $stmt->close();


    if ($input_otp === strval($correct_otp)) {
        header("Location: recoverAccount.php");
        exit();
    } else {
        $otp_error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/forgot.css" />
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
                <form action="" method="post">
                    <div class="info">
                        <input type="number" name="otp" placeholder="Insert OTP" required style="text-align: center;">
                        <?php if (!empty($otp_error)): ?>
                            <p style="color:red;"><?php echo $otp_error; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="signs">
                        <p>Don’t remember email nor have these?</p>
                        <a href="../administrator.php"><p>Contact administrator here.</p></a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>