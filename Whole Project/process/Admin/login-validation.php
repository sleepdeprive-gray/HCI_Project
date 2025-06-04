<?php

session_start();

include '../database_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    

    $sql = "SELECT adminID, email, password FROM admin_account WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_email, $db_password);
        $stmt->fetch();

        if ($password == $db_password) {

            echo $_SESSION['ID'] = $id;
            echo $_SESSION['email'] = $db_email;
           

            // Redirect based on user type
           

                header("Location: ../../Admin/admin.php");
                exit();

        }
            else {

                echo "<script>alert('Invalid password!'); window.location.href='../../Admin/login/login.php';</script>";
            
            }
            
         

        }

    }