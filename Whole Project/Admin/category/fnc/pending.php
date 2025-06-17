<?php
    if ($_GET['book']) {
        # code...
        include '../../db/db.php';
       if ($_GET['s'] == "Rejected") {
        $status = $_GET['s'];
        $bookID = $_GET['book'];
        $category = $_GET['c'];
       
       }elseif ($_GET['s'] == "Archive") {
        $status = $_GET['s'];
        $bookID = $_GET['book'];
        $category = $_GET['c'];
       
       }

      
        mysqli_query($conn, "UPDATE books SET status = '$status' WHERE book_id = $bookID");     
        
        
        ?>
            <script>
                          
                window.location.href = '../<?php echo "science.php?s=".$status."&c=".$category?>';
            </script>";
        <?php
       
        
         

    }
?>