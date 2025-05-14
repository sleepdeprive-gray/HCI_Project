<!-- <?php
    session_start();
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    
</head>
<body>
    <?php
    require 'db/db.php';
    $id = $_SESSION['ID'];
    $admin_infos = mysqli_query($conn, "SELECT * FROM admin_account WHERE adminID = $id");

    while ($results = mysqli_fetch_assoc($admin_infos)) {
        
    
    ?>
    <div class="mainContainer">
        <!-- NAVIGATION 1 -->
        <nav class="nav1">
            <div class="" style="display: flex; justify-self: center;margin-top: 10px;margin-bottom: 10px;">
                <img src="images/weblogo.png" alt="" style="width: 40px;height: 40px; border-radius: 0; border: none;">
                <p style="font-size: 15px;margin-left: 4px;font-weight: bold;">BOOK <span style="color: #A1BE95;">ROOM</span></p>
            </div>
            <img src="../images/<?php echo $results['profile_pic'] ?>" alt="">
            <p style="font-weight: bold;">
                <?php
                    if(strlen($results['fname']) < 6){
                        echo $results['fname'];
                    }
                    else{
                        echo substr($results['fname'], 0, 4)."...";
                    }                
                ?>
            </p>
          
            <div class="container_for_buttons">
                <div class="links_button">
                
                    <button class="Active"><i class="fa-solid fa-house" style="margin-right: 10px;"></i>Dashboard</button>
                    <button><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button>
                    <a href="accounts/accounts_all.php"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <a href="category/science.php"><button><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button></a>
                    
                  
                </div>
                <div class="LOGOUT_CONTAINER">
                    <button>LOGOUT</button>
                </div>
            </div>
        </nav>
        <!-- END OF NAVIGATION 1 -->


        <!-- NAVIGATION 2 -->
        <nav class="nav2">
                <div class="logo">
                    <!-- LOGO -->
                    <img src="../apate.png" alt="">

                    <!-- LOGO NAME -->
                    <p>BOOK <span>ROOM</span></p>
                </div>

                <!-- LINKS FOR PAGES -->
                <div class="links_button">
                
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                  
                </div>

                <!-- LOGOUT AND PROFILE PICTURE -->
                <div class="LOGOUT_AND_PIC_CONTAINER">
                    <button>LOGOUT</button>
                    <img src="../mytyping test.png" alt="" >
                </div>

        </nav>
        <!-- END OF NAVIGATION 2 -->


        <!-- ARTICLE -->
        <article>
            <div class="time">
                <div class="times">
                    <p>DASHBOARD</p>
                </div>
            </div>
            <!-- LOGO AND COM NAME IN ARTICLE -->
            <div class="" style="display: flex; flex-direction: column; justify-self: center; position: relative; margin-bottom: 10px; margin-top: 10px;">
                <div class="" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <!-- TOTAL AUTHOR ACCOUNTS -->
                    <div class="" style=" display: flex;">
                        <div class=""  style="background-color: #C4DAD2; width: 150px; height: 150px; border-radius: 50% 50% 0 50%; display: flex; 
                        justify-content: center; align-items: center;">
                            <i class="fa-solid fa-user-tie" style="font-size: 70px;"></i>
                        </div>
                        <div class=""  style="background-color: #C4DAD2; width: 200px; height: 110px; margin-top: 40px; margin-left: -20px;
                        border-top-right-radius: 25px;">
                            <div class="" style="margin-left: 15px;display: flex; flex-direction: column;">
                            <div class="" style="display: flex;  margin-top: -35px;">
                                    <div class="" style="width: 25px; height: 25px; background-color: #6A9C89; border-radius: 100%;" ></div>
                                    <a href="accounts/accounts_editor.php"><div class="" style="width: 140px; height: 25px; background-color: #6A9C89; border-radius: 15px;
                                    margin-left: 10px;align-items: center; justify-content: center; display: flex; color: white;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" >View</div></a>
                                </div>
        
                                <div class="">
                                    <p style="border-bottom: 2px solid #6A9C89; width: 160px;font-weight: bold;
                                    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; cursor: default;">Total Editor Account</p>
                                    <h1 style="font-size: 50px; margin-top: -10px;cursor: default;">123</h1>
                                </div>
                            </div>
                        </div>
                    </div>
        
        
                    <!-- TOTAL USER ACCOUNT -->
                    <div class="" style=" display: flex;">
                        <div class=""  style="background-color: #C4DAD2; width: 150px; height: 150px; border-radius: 50% 50% 0 15px; display: flex; 
                        justify-content: center; align-items: center;">
                                                       <i class="fa-solid fa-users" style="font-size: 70px;"></i>
                                                
                        </div>
                        <div class=""  style="background-color: #C4DAD2; width: 200px; height: 110px; margin-top: 40px; margin-left: -20px;
                        border-top-right-radius: 25px;">
                            <div class="" style="margin-left: 15px;display: flex; flex-direction: column;">
                            <div class="" style="display: flex;  margin-top: -35px;">
                                    <div class="" style="width: 25px; height: 25px; background-color: #6A9C89; border-radius: 100%;" ></div>
                                    <a href="accounts/accounts_member.php"><div class="" style="width: 140px; height: 25px; background-color: #6A9C89; border-radius: 15px;
                                    margin-left: 10px;align-items: center; justify-content: center; display: flex; color: white;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" >
                                        View
                                    </div></a>
                                </div>
        
                                <div class="">
                                    <p style="border-bottom: 2px solid #6A9C89; width: 170px;font-weight: bold;
                                    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;cursor: default;">Total Member Account</p>
                                    <h1 style="font-size: 50px; margin-top: -10px;cursor: default;">123</h1>
                                </div>
                            </div>
                        </div>
                    </div>
        
        
                    <!-- TOTAL BOOKS -->
                    <div class="" style=" display: flex;">
                        <div class=""  style="background-color: #C4DAD2; width: 150px; height: 150px; border-radius: 50% 50% 0 15px; display: flex; 
                        justify-content: center; align-items: center;">
                           <i class="fa-solid fa-book" style="font-size: 70px;"></i>
                        </div>
                        <div class=""  style="background-color: #C4DAD2; width: 200px; height: 110px; margin-top: 40px; margin-left: -20px;
                        border-radius: 0 25px 25px 0;">
                            <div class="" style="margin-left: 15px;display: flex; flex-direction: column;">
                            <div class="" style="display: flex;  margin-top: -35px;">
                                    <div class="" style="width: 25px; height: 25px; background-color: #6A9C89; border-radius: 100%;" ></div>
                                    <a href="category/science.php"><div class="" style="width: 140px; height: 25px; background-color: #6A9C89; border-radius: 15px;
                                    margin-left: 10px;align-items: center; justify-content: center; display: flex; color: white;font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;" >
                                        View
                                    </div></a>
                                </div>
        
                                <div class="">
                                    <p style="border-bottom: 2px solid #6A9C89; width: 150px;font-weight: bold;
                                    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;cursor: default;">Total Books</p>
                                    <h1 style="font-size: 50px; margin-top: -10px;cursor: default;">123</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                
           </div>
            
            <div class="CONTAINER_FOR_CARDS">
                <div class="left_cards">
                    <!-- TOP LEFT CARDS -->
                    <div class="top_left_cards">
                        <p style="color: white;"><i class="fa-solid fa-book"></i> BOOKS IN LIBRARY</p>
                        <div class="result">
                            <div class="pie-chart-container" style="display: flex;">
                                <canvas
                                id="pie-chart"
                                class="animate-pie-chart"
                                width="200"
                                height="200"
                                >

                                </canvas>
                                <ul id="pie-chart-legend"></ul>
                            </div>
                        </div>
                    </div>
                    <!-- BOTTOM LEFT CARDS -->
                    <div class="bottom_left_cards">
                        <div class="contentL_bottom_left_cards">
                            <h1>656</h1>
                            <p>TOTAL BOOK</p>
                            <p>COUNT</p>
                        </div>
                        <div class="contentR_bottom_left_cards">
                            <h1>5</h1>
                            <p>TOTAL</p>
                            <p>CATEGORY</p>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- TOP CENTER CARDS -->
                    <div class="top_center_cards">
                        <!-- TOP AUTHOR -->
                         <p style="font-weight: bold; color: white;margin: 5px; font-size: 20px;"><i class="fa-solid fa-user-tie"></i>       Top Author</p>
                         <div class="" style="display: flex; align-items: center; flex-wrap: wrap; justify-content: center;gap: 10px;margin-top: -25px;">
                            <!-- TOP 2 AUTHOR -->
                            <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                <p style="margin-bottom: 1px;font-weight: bold;">Top 2</p>
                                <img src="images/Agatha Christie.png" alt="" style="width: 60px;height: 60px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                <p style="margin-top: 5px;">NIca</p>
                            </div>
                            <!-- TOP 1 AUTHOR -->
                             <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                <p style="margin-bottom: 1px;font-weight: bold;">Top 1</p>
                             <img src="images/Agatha Christie.png" alt="" style="width: 90px;height: 90px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                <p style="margin-top: 5px;">Nica Rontal</p>

                             </div>
                             <!-- TOP 3 AUTHOR -->
                              <div class="" style="display: flex; flex-direction: column;align-items: center; justify-content: center;color: white">
                                <p style="margin-bottom: 1px;font-weight: bold; ">Top 3</p>
                              <img src="images/Agatha Christie.png" alt="" style="width: 60px;height: 60px; border: 3px dashed white; padding: 5px; box-shadow: 5px 5px 5px rgba(0, 0, 0,.6);">
                                <p style="margin-top: 5px;">NIca</p>

                              </div>
                           
                         </div>
                    </div>

                    <!-- BOTTOM CENTER CARDS -->
                    <div class="bottom_center_cards">
                        <!-- RECENT LOGS -->
                         <h1>RECENT LOGS</h1>
                        <div class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                               
                                    
                                     <?php
                                    $selects_logs = mysqli_query($conn, "SELECT *, HOUR('timestamp') as hourly FROM recent_logs ORDER BY The_time DESC");

                                    while ($recent_logs = mysqli_fetch_assoc($selects_logs)) {
                                        # code...
                                    
                                ?>
                            <tr>
                               
                              
                                <td><?php echo $recent_logs['ID']; ?></td>
                                <td><?php echo $recent_logs['timestamp']; ?></td>
                                <td><?php echo $recent_logs['ACTION'];?></td>
                               
                            </tr>
                            <?php
                                    }
                                ?> 
                                </tbody>
                             </table>
                        </div>
                         <a href="activity_log.php"><button>VIEW</button></a>
                    </div>
                </div>

                <div class="right_cards">
                    <!-- TOP BOOKS -->
                     <h1><i class="fa-solid fa-book-open"></i> TOP 5 BOOKS</h1>

                  <?php
                  $i = 5;
                  $res = mysqli_query($conn, "SELECT *, DAY(date_published) as dayToday,
                        MONTH(date_published) as MonthToday, YEAR(date_published) as YearToday FROM books ORDER BY downloads DESC LIMIT 5");
                     while ($row=mysqli_fetch_array($res)) {
                            
                            echo '    
                                <div class="container_TOP_BOOKS" >
                                    <div class="top_books_image">
                                        <img src="data:image/jpeg;base64, '.base64_encode($row['front_cover']).'" height="100" width="100"/>
                                    </div>
                                    <div class="BOOKS_name_and_author">
                                        <p style="font-weight: bold;">'. $row["title"] .'</p>
                                        <p class="p">';
                                         $authorNAME = $row["author_id"];
                               
                                        $selectsAUTHOR_name = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorNAME");
                                        
                                        while ($authorName = mysqli_fetch_assoc($selectsAUTHOR_name)) {
                                            echo $authorName["fname"];
                                        }
                        echo            '</p>
                                    </div>
                                    <div class="BOOK_rank_and_date">
                                        <h1>TOP '.$i.'</h1>
                                        <p>';
                                            $date = $row["MonthToday"]; // Original date in DD/MM/YYYY format
                                            $dateTime = date("M", $date);
                                            echo  $dateTime. " " . $row["dayToday"]. " " . $row["YearToday"];
                        echo            '</p>
                                    </div>
                                </div>    
                                ';
                                $i --;
                        }
                  ?>
                    
                </div>

            </div>

            

        </article>
    </div>
    <script src="js/pie_chart.js"></script>
<?php
    }
?>
</body>
</html>