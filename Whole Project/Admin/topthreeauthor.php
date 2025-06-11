<?php
include 'db/db.php';
                            $asd = mysqli_query($conn, "SELECT * FROM books ORDER BY downloads DESC LIMIT 3 ");
                                        $rank = 0;
                                        while ($noice = mysqli_fetch_assoc($asd)) {
                                    
                                        $rank ++;

                                                $author_id = $noice['author_id'];
                                        $ikawna =  mysqli_query($conn, "SELECT * FROM authors WHERE author_id = $author_id");
                                        
                                        while($etona = mysqli_fetch_assoc($ikawna)){
                                            $names = $etona['author_name'];
                                        }
                                            
                                    

                                    if($rank == 1){
                                        $rank1 = ' 
                                            <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                                <p style="margin-bottom: 1px;font-weight: bold;">Top 1</p>
                                                    <img src="../Admin/images/Agatha Christie.png" alt="" style="width: 90px;height: 90px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                                <p style="margin-top: 5px;">'.$names.'</p>
                                            </div>';
                                    }elseif ($rank == 2) {
                                        echo '
                                        <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                            <p style="margin-bottom: 1px;font-weight: bold;">Top 2</p>
                                                <img src="../Admin/images/Agatha Christie.png" alt="" style="width: 60px;height: 60px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                            <p style="margin-top: 5px;">';
                                            $author_id = $noice['author_id'];
                                    $ikawna =  mysqli_query($conn, "SELECT * FROM authors WHERE author_id = $author_id");
                                        
                                        while($etona = mysqli_fetch_assoc($ikawna)){
                                            echo $etona['author_name'];
                                        }
                                            echo'</p>
                                        </div>
                                        ';
                                    

                                        echo $rank1;
                                    }elseif ($rank == 3) {
                                    echo '
                                        <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                            <p style="margin-bottom: 1px;font-weight: bold;">Top 3</p>
                                                <img src="images/Agatha Christie.png" alt="" style="width: 60px;height: 60px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                            <p style="margin-top: 5px;">';
                                            $author_id = $noice['author_id'];
                                    $ikawna =  mysqli_query($conn, "SELECT * FROM authors WHERE author_id = $author_id");
                                        
                                        while($etona = mysqli_fetch_assoc($ikawna)){
                                            echo $etona['author_name'];
                                        }
                                            echo'</p>
                                        </div>
                                        ';
                                    }
                                }
                           ?>