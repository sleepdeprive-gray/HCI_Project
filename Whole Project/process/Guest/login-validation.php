<?php

session_start();

include '../db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = ($_POST['password']);

    $sql = "SELECT user_id, email, password, user_type FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $sql2 = "SELECT adminID, email, password FROM admin_account WHERE email = ?";
    $stm2t = $conn->prepare($sql2);
    $stm2t->bind_param("s", $email);
    $stm2t->execute();
    $stm2t->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password, $db_user_type);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {

            echo "Password match!"; // Debugging line

            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $db_email;
            $_SESSION['user_type'] = $db_user_type; 

            echo $ids = $_SESSION['user_id'];
            date_default_timezone_set('Asia/Manila');
			echo $dateTime = date('m-d-Y h:i ');
            $recent_logs = "INSERT INTO recent_logs (ID, `ACTION`, `timestamp`, user_type) VALUES ($ids, 'Login', '$dateTime', '$db_user_type')";
            mysqli_query($conn, $recent_logs);
            
            if ($db_user_type == 'Editor') {

                header("Location: ../../Editor/Editor-Dashboard.php");
                exit();

            } elseif ($db_user_type == 'Member') {

                header("Location: ../../Member/discover.html");
                exit();
            }

        } else {

            echo "<script>alert('Invalid password!'); window.location.href='../../Guest/login.php';";

        }
    }

    elseif ($stm2t->num_rows > 0) {
        $stm2t->bind_result($id, $db_email, $db_password);
        $stm2t->fetch();

        $hash = password_hash($db_password, PASSWORD_DEFAULT);
        if (password_verify($db_password, $hash)) {

            echo "Password match!"; // Debugging line

            $_SESSION['ID'] = $id;
            $_SESSION['email'] = $db_email;
            echo $ids = $_SESSION['ID'];
            date_default_timezone_set('Asia/Manila');
			echo $dateTime = date('m-d-Y h:i ');
            $recent_logs = "INSERT INTO recent_logs (ID, `ACTION`, `timestamp`, user_type) VALUES ($ids, 'Login', '$dateTime', 'Admin')";
            mysqli_query($conn, $recent_logs);
			
            

                header("Location: ../../ADMIN/admin.php");
                exit();

           

        } else {

            echo "<script>alert('Invalid password!'); window.location.href='../../Guest/login.php';";

        }} 
    else {
        
        echo "<script>alert('No account found with this email!'); window.location.href='../../Guest/login.php';</script>";
        
    }

    $stmt->close();
}

$conn->close();
