<?php
    if(isset($_POST['remove'])){
        $saveID = $_POST['nums'];
        $deleteSAVEbooks = mysqli_query($conn,"DELETE FROM save_book WHERE savedBookID = $saveID");
        
    }
?>