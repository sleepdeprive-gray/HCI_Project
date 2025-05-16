<?php
    if ($_GET['book']) {
        # code...
        include '../../db/db.php';
        echo $bookID = $_GET['book'];
        mysqli_query($conn, "UPDATE books SET status = 'Archive' WHERE book_id = $bookID");
        $genre = mysqli_query($conn, "SELECT genre FROM books WHERE book_id = $bookID");

        while ($results = mysqli_fetch_assoc($genre)) {
            ?>
            <script>
                    
                window.location.href = '../<?php echo mb_strtolower($results['genre'])?>.php';
            </script>";
        <?php
        }
        
         

    }
?>