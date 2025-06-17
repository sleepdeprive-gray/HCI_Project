<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="images/logos.png" type="image/png">
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

        <?php require_once 'component/nav1.php'?>
        <?php require_once 'component/nav2.php'?>

        
        <article>
            <div class="time">
                <div class="times" style="background-color:rgb(168, 83, 30); ">
                    <p style="color:white">DASHBOARD</p>
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
                                        <?php require_once 'component/editoraccount.php'?>
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
                                        <?php require_once 'function/totalBookCount.php'?>
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
                        <p><i class="fa-solid fa-book"></i> BOOKS IN LIBRARY</p>
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
                                <?php include 'function/totalBookCount.php'?>
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
                   
                         <p style="font-weight: bold; margin: 5px; font-size: 20px;"><i class="fa-solid fa-user-tie"></i>       Top Author</p>
                         <div class="TOP3AUTHOR">
                           <?php
                                include 'component/topthreeauthor.php';
                           ?>
                           
                         </div>
                    </div>

                   
                    <div class="bottom_center_cards">
                       
                        <p class="bold">RECENT LOGS</p>
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
                         <a href="activity_log.php"><button style="background-color: rgb(94, 47, 18);">VIEW</button></a>
                    </div>
                </div>

                <div class="right_cards">
                
                     <p class="top5Book"><i class="fa-solid fa-book-open"></i> TOP 5 BOOKS</p>
                    <?php include 'component/top10Book.php';?>        
                 
                    
                </div>

            </div>

        
            <?php include 'function/getDLvalue.php';?>
        </article>
    </div>
    <script src="js/pie_chart.js"></script>
<?php
    }
?>
</body>
</html>