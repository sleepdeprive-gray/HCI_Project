<?php
    include '../db/db.php';

    if(isset($_POST['edit'])){
        if(isset($_POST['user'])){
            $user = $_POST['user'];
            
            // ADD ADMIN ACCOUNTS
            if($user == "admin"){
                echo "nasa ADMIN ka na";
            }
            elseif ($user == "reader") {
                echo "nasa READER ka na";
            }
            else {
                $fname = $_POST['fname'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                 mysqli_query($conn, "INSERT INTO author_account(email, password, fname)
                 VALUES ('$email', '$pass', '$fname')");
            }
        }
    }
    
?>