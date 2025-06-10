<?php
session_start();
include '../../process/database_connection.php';

// Check if recovery email is set
if (!isset($_SESSION['recovery_email'])) {
    echo "<script>
            alert('Session expired. Please start the recovery process again.');
            window.location.href = 'forgot.php';
          </script>";
    exit();
}

$email = $_SESSION['recovery_email'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['security_answer'])) {
        echo "<script>alert('Please provide an answer to the security question.');</script>";
    } else {
        $user_answer = strtolower(trim($_POST['security_answer']));
        
        // Get security question and answer from database
        $stmt = $conn->prepare("SELECT security_question, sq_answer FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $correct_answer = strtolower(trim($user['sq_answer']));
            
            if ($user_answer === $correct_answer) {
                // Answer is correct - redirect to password reset
                $_SESSION['security_verified'] = true;
                header("Location: recoverAccount.php");
                exit();
            } else {
                echo "<script>alert('Incorrect answer. Please try again.');</script>";
            }
        } else {
            echo "<script>
                    alert('Error retrieving security question. Please contact support.');
                    window.location.href = 'forgot.php';
                  </script>";
            exit();
        }
    }
}

// Get security question for display
$stmt = $conn->prepare("SELECT security_question FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$question = $result->num_rows === 1 ? $result->fetch_assoc()['security_question'] : 'Your security question';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forgot.css">
    <title>Security Question Verification</title>
</head>
<body>
    <div class="container">
        <div class="picture">
            <div class="needed_content">
                <h1>BOOK <span>ROOM</span></h1>
                <img src="../../images/weblogo.png">
                <p class="text">Discover, Download, and Dive into</p>
                <p class="text">Stories Across Many Genres!</p>
                <p class="link">Already know the password? <a href="login.php">Click Here</a>.</p>
            </div>
        </div>

        <div class="form">
            <div class="logo">
                <img src="../../images/weblogo.png" alt="">
                <p>book.<span>room</span></p>
            </div>

            <div class="forms">
                <div class="head">
                    <h2>Answer Account</h2>
                    <h2>Security Question</h2>
                </div>
                <form action="" method="post">
                    <input type="text" name="security_question" id="security_question" 
                           value="<?php echo htmlspecialchars($question); ?>" readonly>
                    <input type="text" name="security_answer" id="security_answer" 
                           placeholder="Your answer" required>
                    
                    <div class="prev_sub">
                        <a href="forgot.php"><p>GO BACK</p></a>
                        <button type="submit">SUBMIT</button>
                    </div>
                    
                    <div class="signs">
                        <p>Something went wrong?</p>
                        <a href="../administrator.php"><p>Contact administrator here.</p></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($_GET['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo addslashes($_GET['error']); ?>'
        });
    </script>
    <?php endif; ?>
</body>
</html>