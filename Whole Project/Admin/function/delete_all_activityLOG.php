<?php
    if(isset($_POST['delete_all'])){
        mysqli_query($conn, "DELETE FROM recent_logs WHERE 1");
        mysqli_query($conn, "ALTER TABLE `recent_logs` CHANGE `The_time` `The_time` INT(255) NOT NULL");
        mysqli_query($conn, "ALTER TABLE `recent_logs` CHANGE `The_time` `The_time` INT(255) NOT NULL AUTO_INCREMENT");
        echo "
            <script>
                window.location.href = '../ADMIN/activity_log.php';
            </script>";
    }
?>


