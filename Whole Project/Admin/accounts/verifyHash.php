<?php
    $o = $_GET['o'];
    $c = $_GET['c'];

    if (password_verify($o, $c)) {
       
       echo '
            <script>
            window.location.href = "accounts.php?at=Editor&cha=2";
            alert("asd");
            
            </script>
        ';
    }else{
         echo '
            <script>
            alert("Wrong Password");
            window.location.href = "accounts.php?at=Editor&cha=1";
            
            </script>
        ';
    }
?>