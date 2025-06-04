<?php
    include '../db.php';
    $user_id = $_GET['id'];
    $Book_id = $_GET['bookid'];
    $page = $_GET['p'];

    
    $check_if_already_saved = mysqli_query($conn, "SELECT * FROM save_book WHERE save_bookID = $Book_id AND userID = $user_id");

    if(mysqli_num_rows($check_if_already_saved) <= 0){
        mysqli_query($conn, "INSERT INTO `save_book`(`save_bookID`, `userID`, `user_type`) VALUES ($Book_id,$user_id,'Member')");
        echo 
            '<script> 
                location.href = "../view.php?bookID='.$Book_id.'&p='.$page.'"
            </script>';
    }else{
       echo 
            '<script> 
                alert("You Already save the book");
                location.href = "../view.php?bookID='.$Book_id.'&p='.$page.'"
            </script>';
    }

    
?>