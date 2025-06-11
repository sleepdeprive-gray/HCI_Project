<?php
    include '../../db/db.php';
    $bookID = $_GET['book'];
    $status = $_GET['s'];
    $category = $_GET['c'];

    mysqli_query($conn, "DELETE FROM books WHERE book_id =$bookID");


?>

<script>
    window.location.href = "../science.php?c=<?= $category?>&s=<?= $status?>";
</script>