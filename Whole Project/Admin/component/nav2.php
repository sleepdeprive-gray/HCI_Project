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