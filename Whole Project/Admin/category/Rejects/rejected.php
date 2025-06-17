<?php
include '../../db/db.php';
if(isset($_POST['rejectIT'])){
        $status = $_GET['s'];
        $bookID = $_GET['book'];
        $category = $_GET['c'];
        $mainReason = $_POST['mainReason'];
        $feedback = $_POST['feedback'];
       
       
        $autID = mysqli_query($conn, "SELECT author_id FROM books WHERE book_id = $bookID");
        while ($authors = $autID->fetch_assoc()) {
            $a = $authors['author_id'];
        }

        mysqli_query($conn, "UPDATE books SET status = '$status' WHERE book_id = $bookID");     
        mysqli_query($conn, "INSERT INTO rejected_feedback (book_id, author_id, main_reason, detaited_reason) 
        VALUES ($bookID,$a ,'$mainReason','$feedback')");     

        
        
        ?>
            <script>
                          
                window.location.href = '../<?php echo "science.php?s=".$status."&c=".$category?>';
            </script>";
        <?php
}
       
?>