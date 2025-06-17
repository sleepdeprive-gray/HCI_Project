<?php
$COUNT_BOOKS = mysqli_query($conn, "SELECT COUNT(user_type) FROM users WHERE user_type='Editor'");

                                            while ($a = mysqli_fetch_assoc($COUNT_BOOKS)) {
                                                echo $a['COUNT(user_type)'];
                                            }
?>