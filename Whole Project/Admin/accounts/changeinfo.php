<?php
include '../db/db.php';

$name = $_GET['name'];
$id = $_GET['id'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$at = $_GET['at'];
mysqli_query($conn, "UPDATE admin_account SET fname ='$name', adminID=$id, email='$email' WHERE adminID = $id");

echo '
<script>
window.location.href = "accounts.php?at=Admin";
</script>
';




?>