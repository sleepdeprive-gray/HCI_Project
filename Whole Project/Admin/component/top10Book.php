 <?php
                  $i = 5;
                  $res = mysqli_query($conn, "SELECT *, DAY(date_published) as dayToday,
                        MONTH(date_published) as MonthToday, YEAR(date_published) as YearToday FROM books ORDER BY downloads DESC LIMIT 5");
                     while ($row=mysqli_fetch_array($res)) {
                            ?>
                              
                                <div class="container_TOP_BOOKS" >
                                    <div class="top_books_image">
                                        <?php
                                            if(!empty($row['front_cover'])){
                                            echo '<img src="data:image/jpeg;base64, '.base64_encode($row['front_cover']).'" height="100" width="100"/>';
                                            }else{
                                                echo '
                                                    <div style="background-color:white; width:38px; color:red; display:flex; justify-content:center; align-items: center; border:1px solid black; cursor: not-allowed; font-size:25px; margin-right: -14px">
                                                        <i class="fa-solid fa-circle-exclamation"></i>
                                                    </div> 
                                                ';
                                            }
                                        echo '  
                                            </div>
                                            <div class="BOOKS_name_and_author">';
                                            ?>
                                    
                                        <p style="font-weight: bold;"><?php if(strlen($row["title"]) < 6){
                                                echo $row["title"];
                                            }
                                            else{
                                                echo substr($row["title"], 0, 12)." ...";
                                            }  ?></p>
                                       <?php echo ' <p class="p">';
                                         $authorNAME = $row["author_id"];
                               
                                        $selectsAUTHOR_name = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorNAME");
                                        
                                        while ($authorName = mysqli_fetch_assoc($selectsAUTHOR_name)) {
                                            
                                            if(strlen($authorName["fname"]) < 6){
                                                echo $authorName["fname"];
                                            }
                                            else{
                                                echo substr($authorName["fname"], 0, 8)." ...";
                                            } 
                                        }
                        echo            '</p>
                                    </div>
                                    <div class="BOOK_rank_and_date">
                                        <h1>TOP '.$i.'</h1>
                                        <p>';
                                            $date = $row["MonthToday"];
                                            $dateTime = date("M", $date);
                                            echo  $dateTime. " " . $row["dayToday"]. " " . $row["YearToday"];
                        echo            '</p>
                                    </div>
                                </div>    
                                ';
                                $i --;
                        }
                  ?>