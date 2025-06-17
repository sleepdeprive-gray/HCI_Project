 <?php
$url = basename($_SERVER['PHP_SELF']);
 ?>
 
 <nav class="nav1">
            <div class="logo_TOP_LEFT">
                <img src="images/logos.png" alt="">
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
                
                    <a href="admin.php"><button <?php echo ($url && $url === 'admin.php') ? 'class="Active"' : ''; ?>><i class="fa-solid fa-house"></i>Dashboard</button></a>
                    <a href="analytics.php"><button <?php echo ($url && $url === 'analytics.php') ? 'class="Active"' : ''; ?>><i class="fa-solid fa-chart-simple"></i>Analytics</button></a>
                    <a href="accounts/accounts.php?at=Editor"><button <?php echo ($url && $url === 'accounts/accounts.php?at=Editor') ? 'class="Active"' : ''; ?>><i class="fa-solid fa-user"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i>Books</button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file"></i>Activity Log</button></a>
                    
                  
                </div>
                
                <form action="../process/Admin/logput.php?id=<?= $id;?>" method="post" class="LOGOUT_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                </form>
            </div>

</nav>