<?php
    session_start();
    include 'db.php';
    $asd = $_SESSION['ID'];
    date_default_timezone_set('Asia/Manila');
    $dateTime = date('m-d-Y h:i ');
    $sql33 = mysqli_query($conn, "INSERT INTO recent_logs (ID, `ACTION`, `timestamp`) VALUES ($asd, 'Logout', '$dateTime')");
    session_destroy();
    header("Location: ../login.php");

?>