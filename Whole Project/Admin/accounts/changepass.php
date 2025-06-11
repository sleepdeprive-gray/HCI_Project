<?php
    include '../db/db.php';
    $user = $_GET['user'];
    $id = $_GET['id'];
    $pass = $_GET['n'];

    if($user == "Admin"){
        mysqli_query($conn, "UPDATE admin_account SET password = '$pass' WHERE adminID = $id");
    }else{
        
        // $users = mysqli_query($conn, "UPDATE users SET password = '$pass' WHERE user_id = $id AND user_type = '$user'");
         $users = mysqli_query($conn, "SELECT password FROM users WHERE user_id = $id AND user_type = '$user'");

        echo mysqli_num_rows($users);
        while ($a = mysqli_fetch_assoc($users)) {
            
        }

        //  if (password_verify($password, $db_password)) {}
    }
?>
<script>
    window.location.href = "accounts.php?at=<?= $user?>";
</script>