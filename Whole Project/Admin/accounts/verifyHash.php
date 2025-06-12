<?php
    $o = $_GET['o'];
    $c = $_GET['c'];
    $id = $_GET['id'];
    $user = $_GET['at'];

    if (password_verify($o, $c)) {
       
       echo '
            <script>
            window.location.href = "accounts.php?at=Editor&cha=2&id='.$id.'&at='.$user.'";
            </script>
        ';
    }else{
        
         echo '
            <script>
            alert("Wrong Password");
            window.location.href = "accounts.php?at=Editor&cha=1&id='.$id.'&at='.$user.'&c='.$c.'";
            
            </script>
        ';
    }
?>