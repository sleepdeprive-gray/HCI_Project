<?php
    include '../../db/db.php';
    if(isset($_POST['Cancel'])){
        
        $bookID = $_POST['ids'];
         $genre = mysqli_query($conn, "SELECT genre FROM books WHERE book_id = $bookID");

        while ($results = mysqli_fetch_assoc($genre)) {
            ?>
            <script>
                window.location.href = '../<?php echo mb_strtolower($results['genre'])?>.php';
            </script>";
        <?php
        }
        
      
    }

     elseif(isset($_POST['Approve'])){
        $bookID = $_POST['ids'];

        mysqli_query($conn, "UPDATE books SET status = 'Approved' WHERE book_id = $bookID");
        $genre = mysqli_query($conn, "SELECT genre FROM books WHERE book_id = $bookID");

        while ($results = mysqli_fetch_assoc($genre)) {
            ?>
            <script>
                window.location.href = '../<?php echo mb_strtolower($results['genre'])?>.php';
            </script>";
        <?php
        }
     
    }else{
        echo "mali";
    }

?>