<?php
    include '../db/db.php';
    $user = $_GET['user'];
    $id = $_GET['id'];
    $pass = $_GET['n'];

    if($user == "Admin"){
        mysqli_query($conn, "UPDATE admin_account SET password = '$pass' WHERE adminID = $id");
    }else{
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        
        mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE user_id = $id AND user_type = '$user'");

    }
?>
<script>
     window.location.href = "accounts.php?at=<?= $user?>";
</script>