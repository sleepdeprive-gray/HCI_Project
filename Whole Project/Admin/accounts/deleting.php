<?php
include '../db/db.php';

$user_type = $_GET['at'];
$user_id = $_GET['id'];

if($user_type == 'Admin'){
    mysqli_query($conn, "DELETE FROM admin_account WHERE adminID= $user_id");

    echo '
        <script>
            window.location.href = "accounts.php?at='.$user_type.'";
        </script>
    ';
}else{
     mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");
    
    echo '
        <script>
            window.location.href = "accounts.php?at='.$user_type.'";
        </script>
    ';
}

?>