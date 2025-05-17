<?php
    include '../../db/db.php';
    if(isset($_POST['Cancel'])){
        $category = $_POST['category'];
        $bookID = $_POST['ids'];
    ?>
            <script>
                window.location.href = '../<?php echo "science.php?s=Pending&c=".$category?>';
            </script>";
        <?php
        
        
      
    }

     elseif(isset($_POST['Approve'])){
        $bookID = $_POST['ids'];
        echo $category = $_POST['category'];

        mysqli_query($conn, "UPDATE books SET status = 'Approved' WHERE book_id = $bookID");
       
            ?>
            <script>
                window.location.href = '../<?php echo "science.php?s=Approved&c=".$category?>';
            </script>";
        <?php
        
     
    }else{
        echo "mali";
    }

?>

<!-- mb_strtolower -->