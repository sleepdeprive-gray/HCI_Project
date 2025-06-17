<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acivity Logs</title>
    <link rel="icon" href="images/logos.png" type="image/png">
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
        background-color: rgb(94, 47, 18);
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
        <!-- NAVIGATION 1 -->
        <nav class="nav1">
            <div class="" style="display: flex; justify-self: center;margin-top: 10px;margin-bottom: 10px;">
              <img src="images/logos.png" alt="" style="width: 40px;height: 40px; border-radius: 0; border: none;">
                <p style="font-size: 15px;margin-left: 4px;font-weight: bold;">BOOK <span style="color: #A1BE95;">ROOM</span></p>
            </div>
            <!-- PROFILE PICTURE -->
             <img src="images/<?php echo $results['profile_pic'] ?>" alt="">
            <!-- NAME OF THE USER -->
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
                    <button><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button></a>
                    <button class="Active"><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button>

                  
                </div>
                <div class="LOGOUT_CONTAINER">
                    <button>LOGOUT</button>
                </div>
            </div>
        </nav>
        <!-- END OF NAVIGATION 1 -->


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


        <!-- ARTICLE -->
        <article>
            <div class="time">
                <div class="times">
                    <p>Activity Logs</p>
                </div>
            </div>
                <div class="bookCard" style="width: 90%; height: 500px;position: relative;background-color: var(--background-color); display: flex;margin: 5px;justify-self: center; padding: 10px; display: flex; flex-direction: column;
                flex-wrap: wrap; ">
                     
                        
                            
                        
                        <!-- SORTING AND CATEGORY -->
                        <div class="" style="display: flex; justify-content: space-between;">
                            
                            <!-- SORTING OPTION -->
                            <form method="post" class="" style="display: flex;">
                                <p style="font-weight: bold; ">Sort</p>
                                <select name="orderBY" id="" onchange="this.form.submit()" style="color: white; margin-left: 10px; height: 30px; background-color: rgb(117, 59, 22); border: none;
                                display: flex;align-self: center;">
                                    <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                    <option value="ID">ID</option>
                                    <option value="Time">Time</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Editor">Editor</option>
                                    <option value="Member">Member</option>
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
                                            }elseif ($_POST['orderBY'] == "Member") {
                                                $selects_logs = mysqli_query($conn, "SELECT * FROM recent_logs WHERE user_type = 'Member'");
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
                        <form method="post" class="" style="display: flex; justify-content: end; margin-right: 10px;">
                            <?php include "function/delete_all_activityLOG.php" ?>
                            <button type="submit" name="delete_all" style="background-color: #CC6A6C; border: none; color: white;padding: 5px;width: 80px;">Delete all</button>
                        </form>
                </div>

            

        </article>
    </div>
    <script>
    function navigateToLink() {
      const select = document.getElementById('linkSelect');
      const url = select.value;
      if (url) {
        window.location.href = url; // Redirects to the selected URL
      }
    }
  </script>
 <?php 
    }
?>
</body>
</html>