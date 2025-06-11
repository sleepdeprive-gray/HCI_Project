<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<style>
    table{
        background-color: #e6e6e6;
    }
    .table_body{
        width: 100%;   
    }
    thead th{
        background-color: #3c554c;
        color: white;
    }
    tbody tr:nth-child(even){
    background-color: #0000000b;
    }
    tbody tr:hover{
        background-color: #fff6;
    }
    .table_body{
        height: 300px;
        margin-top: 10px;
    }

</style>
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
                
                    <a href="admin.php"><button><i class="fa-solid fa-house" style="margin-right: 10px;"></i>Dashboard</button></a>
                    <a href="analytics.php"><button><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button></a>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button></a>
                    <button class="Active"><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button>

                  
                </div>
                 <form action="../process/Admin/logput.php?id=<?= $id;?>" method="post" class="LOGOUT_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                </form>
            </div>
        </nav>
  


        <nav class="nav2">
                <div class="logo">
                    
                    <img src="apate.png" alt="">

                    <p>BOOK <span>ROOM</span></p>
                </div>

               
                <div class="links_button">
                
                   <button class="Active"><i class="fa-solid fa-house"></i>Dashboard</button>
                    <button><i class="fa-solid fa-chart-simple"></i>Analytics</button>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i>Books</button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file"></i>Activity Log</button></a>
                  
                </div>

              
                <div class="LOGOUT_AND_PIC_CONTAINER">
                    <button>LOGOUT</button>
                    <img src="mytyping test.png" alt="" >
                </div>

        </nav>
      


        <article>
            <div class="time">
                <div class="times">
                    <p>Activity Logs</p>
                </div>
            </div>
                <div class="activitycon">
                     
   
                    <div class="activityPage">
                        <p>All LOGS</p> 
                    </div>
                        
                        
                    <div class="activitySORTcon">
                            
                        <form method="post">
                            <p>Sort</p>
                            <select name="orderBY" id="" onchange="this.form.submit()">
                                <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                <option value="ID">ID</option>
                                <option value="Time">Time</option>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                
                            </select>
                        </form>
                    </div>

                    <div class="table_body">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>timestamp</th>
                                    <th>User</th>
                                    <th>Action</th>
                                       
                                </tr>
                            </thead>
                            <tbody>
                                    
                                <?php
                                    if(isset($_POST['orderBY'])){
                                            if ($_POST['orderBY'] == "Admin") {
                                            $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs WHERE user_type = 'Admin'");
                                            }elseif ($_POST['orderBY'] == "Editor") {
                                                $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs WHERE user_type = 'Editor'");
                                            }elseif ($_POST['orderBY'] == "Time") {
                                                $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs ORDER BY The_time DESC");
                                            }elseif ($_POST['orderBY'] == "ID") {
                                                $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs ORDER BY ID");
                                            }
                                            else{
                                                $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs ORDER BY The_time DESC");
                                            }
                                     }else {
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs ORDER BY The_time DESC");
                                     }
                                        
                                       
                                        
                                   
                                    if(mysqli_num_rows($selects_logs) > 0){
                                    while ($recent_logs = mysqli_fetch_assoc($selects_logs)) {
                                        # code...
                                    
                                ?>
                            <tr>
                               
                                <td><?php echo $recent_logs['ID']; ?></td>
                                <td><?php echo $recent_logs['timestamp']; ?></td>
                                <td><?php echo $recent_logs['user_type']; ?></td>
                                <td><?php echo $recent_logs['ACTION'];?></td>
                               
                            </tr>
                            <?php
                                    }
                                    }else {
                                        ?>
                                            <tr>
                                                <td colspan="4" style="color: red;">No available data</td>
                                            </tr>
                                        <?php
                                    }
                                     
                                ?> 
                                </tbody>
                             </table>
                    </div>

                    <form method="post" class="DeleteAll">
                        <?php include "function/delete_all_activityLOG.php" ?>
                        <button type="submit" name="delete_all">Delete all</button>
                    </form>
                </div>

            

        </article>
    </div>
    <script>
    function navigateToLink() {
      const select = document.getElementById('linkSelect');
      const url = select.value;
      if (url) {
        window.location.href = url;
      }
    }
  </script>
 <?php 
    }
?>
</body>
</html>