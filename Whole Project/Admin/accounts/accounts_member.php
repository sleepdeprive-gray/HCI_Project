<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="account.css">
</head>
<style>
   

</style>
<body>
    <?php
    require '../db/db.php';
    $id = $_SESSION['ID'];
    $admin_infos = mysqli_query($conn, "SELECT * FROM admin_account WHERE adminID = $id");

    while ($results = mysqli_fetch_assoc($admin_infos)) {
        
    
    ?>
    <div class="mainContainer">
        <!-- NAVIGATION 1 -->
        <nav class="nav1">
            <div class="" style="display: flex; justify-self: center;margin-top: 10px;margin-bottom: 10px;">
              <img src="../../images/weblogo.png" alt="" style="width: 40px;height: 40px; border-radius: 0; border: none;">
                <p style="font-size: 15px;margin-left: 4px;font-weight: bold;">BOOK <span style="color: #A1BE95;">ROOM</span></p>
            </div>
             <!-- PROFILE PICTURE -->
             <img src="../../images/<?php echo $results['profile_pic'] ?>" alt="">
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
                
                    <a href="../admin.php"><button><i class="fa-solid fa-house" style="margin-right: 10px;"></i>Dashboard</button></a>
                    <button><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button>
                    <button class="Active"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button>
                    <a href="../category/science.php"><button><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button></a>
                    <a href="../activity_log.php"><button><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button></a>

                  
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
                    <img src="apate.png" alt="">

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
                    <img src="mytyping test.png" alt="" >
                </div>

        </nav>
        <!-- END OF NAVIGATION 2 -->


        <!-- ARTICLE -->
        <article>
            <div class="time">
                <div class="times">
                    <p>ACCOUNTS</p>
                </div>
            </div>
                <div class="" style="width: 90%; height: 500px;position: relative;background-color: #6A9C89; display: flex;margin: 5px;justify-self: center; padding: 10px; display: flex; flex-direction: column;
                flex-wrap: wrap; ">
                        <p style="font-weight: bold; color:white">ACCOUNTS</p>
                        <div class="" style="display: flex; justify-content: space-between;">
                            <div class="" style="display: flex;">
                                <p style="font-weight: bold; color: white;">Users</p>
                               <a href="accounts_all.php" style="margin-left: 10px;background-color: #3c554c; align-items: center; align-content: center;border-radius: 10px;">
                                <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">All</button>
                               </a>

                               <a href="accounts_editor.php" style="align-self: center;margin-left: 10px;background-color: #3c554c; align-items: center; align-content: center;border-radius: 5px; height: 33px; width: 60px; display:flex; justify-content: center;">
                                <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Editor</button>
                               </a>
                               <a href="accounts_member.php" style="align-self: center;margin-left: 10px;background-color: #3c554c; border-radius: 5px; height: 33px; width: 60px; display:flex;">
                                <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Member</button>
                               </a>
                            </div>

                            <form method="post" class="" style="display: flex;">
                                <p style="font-weight: bold; color: white;">Sort</p>
                                <select name="orderBY" id="" onchange="this.form.submit()" style="color: white; margin-left: 10px; height: 30px; background-color: #3c554c; border: none;
                                display: flex;align-self: center;">
                                    <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                    <option value="ID">ID</option>
                                    <option value="Name">Name</option>
                                    <option value="Email">Email</option>
                                    <option value="Birthdate">Birthdate</option>
                                </select>
                            </form>

                            <div class="" style="display: flex;">
                                <i class="fa-solid fa-microphone" style="display: flex; align-items: center;"></i>
                                <input type="text" style="height: 20px;align-self: center; width: 180px; margin-left: 10px;">
                            </div>
                        </div>


                        <div class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Birthdate</th>
                                        <th>User</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    
                                    <?php
                                    if(isset($_POST['orderBY'])){
                                            if ($_POST['orderBY'] == "Name") {
                                            $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member' ORDER BY first_name");
                                            }elseif ($_POST['orderBY'] == "Email") {
                                               $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member' ORDER BY email");
                                            }elseif ($_POST['orderBY'] == "Birthdate") {
                                                $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member' ORDER BY birthdate");
                                            }elseif ($_POST['orderBY'] == "ID") {
                                                $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member' ORDER BY user_id");
                                            }
                                            else{
                                                $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member'");
                                            }
                                     }else {
                                         $authorACC = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Member'");
                                     }
                                  

                                        while ($recent_logs = mysqli_fetch_assoc($authorACC)) {
                                      
                                    
                                    ?>
                                        <tr>
                                        
                                            <td><?php echo $recent_logs['user_id']; ?></td>
                                            <td><?php echo $recent_logs['first_name']. " " .$recent_logs['last_name']; ?></td>
                                            <td><?php echo $recent_logs['email'];?></td>
                                            <td><?php echo $recent_logs['birthdate'];?></td>
                                            <td><?php echo $recent_logs['user_type'];?></td>
                                            <td><button type="submit" onclick="openPOPUP()">view</button></td>

                                        
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    
                                </tbody>
                             </table>
                        </div>
                        <div class="" style="display: flex; justify-content: space-between;">
                            <button style="background-color: #CC6A6C; color: white; border: none;width: 100px; padding: 5px;">Print</button>
                            <button type="submit" style="background-color: #3999AA; border: none; color: white; padding: 5px;" onclick="Opens()">Add account</button>
                              <button class="addAccount" id="addAccount" >ADD ACCOUNT</button>
                        
                        </div>
                </div>

                 <?php
                                    include '../function/add_Account.php';
                                 ?>
                            <!-- <form action="#" method="post" class="opens" id="opens">
                                <a href=""><p style="font-size: 20px; font-weight: bolder;">x</p></a>
                                <div class="user">
                                    <p>ADD ACCOUNT</p>
                                </div>

                                <div class="neededInfo">
                                    <div class="fNmae">
                                    
                                        <div class="IDS">
                                            <p>TYPE</p>
                                            <select name="user" id="">
                                                <option value="">SELECT</option>
                                                <option value="reader">USER</option>
                                                <option value="admin">ADMIN</option>
                                                <option value="author">EDITORS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="fNmae">
                                        <p>FULL NAME</p>
                                        <input type="text" name="fname" id="" placeholder="DUMMY NAME" required>
                                    </div>
                                    <div class="fNmae">
                                        <p>EMAIL</p>
                                        <input type="email" name="email" id="" placeholder="DUMMYEMAIL@EMAIL.COM" required>
                                    </div>
                                    <div class="fNmae">
                                        <p>PASSWORD</p>
                                        <input type="password" name="pass" id="" placeholder="Password" required>
                                    </div>
                                    <div class="fNmae">
                                        <p>CONFIRM PASSWORD</p>
                                        <input type="password" name="Repass" id="" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <div class="buttons">
                                    <button type="button" class="delete" onclick="removepop()">
                                        CLOSE
                                    </button>

                                    <button type="submit" name="edit" class="edit">
                                        CREATE
                                    </button>
                                </div>
                            </form> -->

            

        </article>
    </div>
    <div class="popUP">
      
       <div class="open" id="open">
            <a href="accounts_all.php"><p style="font-size: 20px; font-weight: bolder;justify-content:end; display:flex">x</p></a>
            
            <div class="user">

               <div class="ids">
                    <p>USER ID</p>
                    <p class="ID_number">1</p>
               </div>
                
                <img src="../../images/logo.jpg" alt="">
            </div>
                                        
            <div class="neededInfo">
                <p id="">FULL NAME</p>
                <input type="text" name="" id="OPEN_name">
                <p>EMAIL</p>
                <input type="email" name="" id="" placeholder="DUMMYEMAIL@EMAIL.COM">
                <p>PHONE NUMBER</p>
                <input type="number" name="" id="" placeholder="+639389001154">
                <p>BIRTHDAY</p>
                <input type="date" name="" id="">
            </div>

                                <div class="buttons">
                                    <button type="button" class="change" onclick="ChangePASS()">
                                        CHANGE PASSWORD
                                    </button>

                                    <button type="button" class="delete" onclick="deleting()">
                                        DELETE
                                    </button>

                                    <button type="button" class="edit" onclick="saves()">
                                        SAVE
                                    </button>
                                </div>
        </div>
    </div>
<?php  
}
?>
<script>
    const popup = document.getElementById("popUP");

    function openPOPUP() {
        popup.classList.add("open_popup");
    }
</script>
</body>
</html>