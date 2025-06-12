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

        <nav class="nav1">
            <div class="logo_TOP_LEFT">
                <img src="../images/weblogo.png" alt="">
                <p>BOOK <span>ROOM</span></p>
            </div>
            <?php
                if(!empty($results['profile_pic'])){
                    ?><img src="images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                }else{
                    ?><img src="images/Admin.png" alt=""><?php
                }
            ?>
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
                
                    <button class="Active"><i class="fa-solid fa-house"></i>Dashboard</button>
                    <a href="analytics.php"><button><i class="fa-solid fa-chart-simple"></i>Analytics</button></a>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i>Books</button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file"></i>Activity Log</button></a>
                    
                  
                </div>
                
                <form action="../process/Admin/logput.php?id=<?= $id;?>" method="post" class="LOGOUT_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                </form>
            </div>

        </nav>



       <nav class="nav2">
                <div class="logo">
                    
                    <img src="../images/weblogo.png" alt="">

                    <p>BOOK <span>ROOM</span></p>
                </div>

               
                <div class="links_button">
                
                    <a href="admin.php"><button class="Active"><i class="fa-solid fa-house"></i><p>Dashboard</p></button></a>
                    <a href="analytics.php"><button><i class="fa-solid fa-chart-simple"></i><p>Analytics</p></button></a>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i><p>Accounts</p></button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i><p>Books</p></button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file"></i><p>Activity Log</p></button></a>
                  
                </div>

              
                <form method="post"  action="../process/Admin/logput.php?id=<?= $id;?>" class="LOGOUT_AND_PIC_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                     <?php
                        if(!empty($results['profile_pic'])){
                            ?><img src="images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                        }else{
                            ?><img src="images/Admin.png" alt=""><?php
                        }
                    ?>
                </form>

        </nav>
        


    
        <article>
            <div class="time">
                <div class="times">
                    <p>DASHBOARD</p>
                </div>
            </div>
        
            <div class="mainARTICLE_container">
                <div class="mainARTICLE">
            
                    <div class="totalACCOUNT_con">

                        <div class="totalACCOUNT_icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>

                        <div class="totalACCOUNT_rightside">
                            <div class="space">
                                <div class="spaceT">
                                    <div class="Circle" ></div>
                                    <a href="accounts/accounts.php?at=Editor"><div class="ViewButton">View</div></a>
                                </div>
        
                                <div class="insideTHEcard">
                                    <p>Total Editor Account</p>
                                    <h1>
                                        <?php
                                            $COUNT_BOOKS = mysqli_query($conn, "SELECT COUNT(user_type) FROM users WHERE user_type='Editor'");

                                            while ($a = mysqli_fetch_assoc($COUNT_BOOKS)) {
                                                echo $a['COUNT(user_type)'];
                                            }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
        
        
                   
    
                    <div class="totalBOOK_con">

                        <div class="totalBOOK_icon">
                           <i class="fa-solid fa-book"></i>
                        </div>

                        <div class="totalBOOK_rightside">
                            <div class="space">
                            <div class="spaceT">
                                    <div class="Circle"></div>
                                    <a href="category/science.php?s=Pending&c=Science"><div class="ViewButton">
                                        View
                                    </div></a>
                                </div>
        
                                <div class="insideTHEcard">
                                    <p>Total Books</p>
                                    <h1>
                                        <?php
                                            $COUNT_BOOKS = mysqli_query($conn, "SELECT COUNT(title) FROM books");

                                            while ($a = mysqli_fetch_assoc($COUNT_BOOKS)) {
                                                echo $a['COUNT(title)'];
                                            }
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                
           </div>
            
            <div class="CONTAINER_FOR_CARDS">

                <div class="left_cards">
                   
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
                  
                    <div class="bottom_left_cards">
                        <div class="contentL_bottom_left_cards">
                            <h1>
                                <?php
                                            $COUNT_BOOKS = mysqli_query($conn, "SELECT COUNT(title) FROM books");

                                            while ($a = mysqli_fetch_assoc($COUNT_BOOKS)) {
                                                echo $a['COUNT(title)'];
                                            }
                                        ?>
                            </h1>
                            <p>TOTAL BOOK</p>
                            <p>COUNT</p>
                        </div>
                        <div class="contentR_bottom_left_cards">
                            <h1>7</h1>
                            <p>TOTAL</p>
                            <p>CATEGORY</p>
                        </div>
                    </div>

                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
               
                    <div class="top_center_cards">
                   
                         <p style="font-weight: bold; color: white;margin: 5px; font-size: 20px;"><i class="fa-solid fa-user-tie"></i>       Top Author</p>
                         <div class="TOP3AUTHOR">
                           <?php
                                include 'topthreeauthor.php';
                           ?>
                           
                         </div>
                    </div>

                   
                    <div class="bottom_center_cards">
                       
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
                                    if(mysqli_num_rows($selects_logs)>0){
                                    while ($recent_logs = mysqli_fetch_assoc($selects_logs)) {
                                       
                                ?>
                            <tr>
                               
                              
                                <td><?php echo $recent_logs['ID']; ?></td>
                                <td><?php echo $recent_logs['timestamp']; ?></td>
                                <td><?php echo $recent_logs['ACTION'];?></td>
                               
                            </tr>
                            <?php
                                    }}else{
                                        echo '
                                            <tr>
                                                <td colspan=3 style="color: red; cursor:default"> No Activity logs</td>
                                            </tr>
                                        ';
                                    }
                                ?> 
                                </tbody>
                             </table>
                        </div>
                         <a href="activity_log.php"><button>VIEW</button></a>
                    </div>
                </div>

                <div class="right_cards">
                
                     <h1><i class="fa-solid fa-book-open"></i> TOP 5 BOOKS</h1>

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
                                            <div style="width:38px; color:red; display:flex; justify-content:center; align-items: center; border:1px solid black; cursor: not-allowed; font-size:25px">
                                                <i class="fa-solid fa-circle-exclamation"></i>
                                            </div> 
                                        ';
                                    }
                                echo '  
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
                    
                </div>

            </div>

        
         <?= include 'function/getDLvalue.php';?>
        </article>
    </div>
    <script src="js/pie_chart.js"></script>
<?php
    }
?>
</body>
</html>