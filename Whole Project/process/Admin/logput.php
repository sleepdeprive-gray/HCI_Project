<?php
    include '../database_connection.php';
    if(isset($_POST['LOGOUT'])){

    $currentDAY = date('Y-m-d H:i');
    
    $id = $_GET['id'];
    
    mysqli_query($conn, "INSERT INTO recent_logs (`timestamp`, ID, `ACTION`, user_type)
        VALUES('$currentDAY',$id , 'LOGOUT', 'Admin')");


   session_destroy();

    echo '
    <script>
        window.location.href = "../../Admin/login/login.php";
    </script>
    ';
 
    }

?>