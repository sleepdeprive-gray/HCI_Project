<?php
$COUNT_BOOKS = $conn->query("SELECT COUNT(title) FROM books");

                                            while ($a = $COUNT_BOOKS->fetch_assoc()):
                                                echo $a['COUNT(title)'];
                                            endwhile;
?>