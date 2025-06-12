<?php
include '../db/db.php';

$name = $_GET['name'];
$id = $_GET['id'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$at = $_GET['at'];
if($at == 'Admin'){
    mysqli_query($conn, "UPDATE admin_account SET fname ='$name', adminID=$id, email='$email' WHERE adminID = $id");
    echo '
        <script>
        window.location.href = "accounts.php?at=Admin";
        </script>
        ';
}else{
    mysqli_query($conn, "UPDATE users SET first_name ='$name', user_id=$id, email='$email' WHERE user_id = $id");
    echo '
        <script>
        window.location.href = "accounts.php?at=Editor";
        </script>
        ';
}






?>