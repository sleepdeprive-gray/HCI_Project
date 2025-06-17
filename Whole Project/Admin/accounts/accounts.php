<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link rel="icon" href="../images/logos.png" type="image/png">
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
    $type_account = $_GET['at'];
    $admin_infos = mysqli_query($conn, "SELECT * FROM admin_account WHERE adminID = $id");

    while ($results = mysqli_fetch_assoc($admin_infos)) {
        
    
    ?>
    <div class="mainContainer">
       
        <nav class="nav1">
             <div class="logo_TOP_LEFT">
                <img src="../images/logos.png" alt="">
                <p>BOOK <span>ROOM</span></p>
            </div>
            
            <?php
                if(!empty($results['profile_pic'])){
                    ?><img src="../images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                }else{
                    ?><img src="../images/Admin.png" alt=""><?php
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
                
                    <a href="../admin.php"><button><i class="fa-solid fa-house"></i>Dashboard</button></a>
                     <a href="../analytics.php"><button><i class="fa-solid fa-chart-simple"></i>Analytics</button></a>
                    <button class="Active"><i class="fa-solid fa-user"></i>Accounts</button>
                    <a href="../category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i>Books</button></a>
                    <a href="../activity_log.php"><button><i class="fa-solid fa-file"></i>Activity Log</button></a>

                  
                </div>
                 <form action="../../process/Admin/logput.php?id=<?= $id;?>" method="post" class="LOGOUT_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                </form>
            </div>
        </nav>
   


     
       <nav class="nav2">
                <div class="logo">
                    
                    <img src="../../images/weblogo.png" alt="">

                    <p>BOOK <span>ROOM</span></p>
                </div>

               
                <div class="links_button">
                
                    <a href="../admin.php"><button class="Active"><i class="fa-solid fa-house"></i><p>Dashboard</p></button></a>
                    <a href="../analytics.php"><button><i class="fa-solid fa-chart-simple"></i><p>Analytics</p></button></a>
                    <a href="../accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i><p>Accounts</p></button></a>
                    <a href="../category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i><p>Books</p></button></a>
                    <a href="../activity_log.php"><button><i class="fa-solid fa-file"></i><p>Activity Log</p></button></a>
                  
                </div>

              
                <form method="post"  action="../../process/Admin/logput.php?id=<?= $id;?>" class="LOGOUT_AND_PIC_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                     <?php
                        if(!empty($results['profile_pic'])){
                            ?><img src="../images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                        }else{
                            ?><img src="../images/Admin.png" alt=""><?php
                        }
                    ?>
                </form>

        </nav>


      
        <article>
            <div class="time">
                <div class="times">
                    <p>ACCOUNTS</p>
                </div>
            </div>
                <div class="bookcon">
                        <p style="font-weight: bold; color:white">ACCOUNTS</p>
                        <div class="" style="display: flex; justify-content: space-between;">
                            <div class="" style="display: flex;">
                                <p style="font-weight: bold; color: white;">Users</p>
                               
                               <?php
                                    if($type_account == "Editor"){
                                        ?>
                                        <a href="accounts.php?at=Editor" style="margin-left: 10px;background-color: rgb(117, 59, 22); align-items: center; align-content: center;border-radius: 10px;justify-content:center; width: 60px; display:flex">
                                            <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Editor</button>
                                        </a>
                                        <?php
                                    }else {
                                         ?>
                                        <a href="accounts.php?at=Editor" style="align-self: center;margin-left: 10px;background-color: rgb(117, 59, 22); border-radius: 5px; height: 33px; width: 60px; display:flex;justify-content:center;">
                                            <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Editor</button>
                                        </a>
                                        <?php
                                    }
                               ?>
                              

                               <?php
                                    if($type_account == "Admin"){
                                        ?>
                                        <a href="accounts.php?at=Admin" style="margin-left: 10px;background-color: rgb(117, 59, 22); align-items: center; align-content: center;border-radius: 10px;justify-content:center; width: 60px; display:flex">
                                            <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Admin</button>
                                        </a>
                                        <?php
                                    }else {
                                         ?>
                                        <a href="accounts.php?at=Admin" style="align-self: center;margin-left: 10px;background-color: rgb(117, 59, 22); border-radius: 5px; height: 33px; width: 60px; display:flex;justify-content:center;">
                                            <button style=" width: 50px; border: none;background-color: transparent; color: white; cursor: pointer;">Admin</button>
                                        </a>
                                        <?php
                                    }
                               ?>
                            </div>

                            <form method="post" class="" style="display: flex;">
                                <p style="font-weight: bold;">Sort</p>
                                <select name="orderBY" id="" onchange="this.form.submit()" style="color: white; margin-left: 10px; height: 30px; background-color: rgb(117, 59, 22); border: none;
                                display: flex;align-self: center;">
                                    <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                    <option value="ID">ID</option>
                                    <option value="Name">Name</option>
                                    <option value="Email">Email</option>
                                    <option value="Birthdate">Birthdate</option>
                                </select>
                            </form>

                            
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
                                    if ($type_account == "Editor") {
                                        $table = "users WHERE user_type = '$type_account'";
                                        $fname = "first_name";
                                        $bday = "birthdate";
                                        $userID = "user_id";


                                    }else{
                                        $table = 'admin_account';
                                        $fname = "fname";
                                        $bday = "birthday";
                                        $userID = "adminID";
                                    }
                                    if(isset($_POST['orderBY'])){
                                            if ($_POST['orderBY'] == "Name") {
                                            $authorACC = mysqli_query($conn, "SELECT * FROM $table ORDER BY $fname");
                                            }elseif ($_POST['orderBY'] == "Email") {
                                               $authorACC = mysqli_query($conn, "SELECT * FROM $table ORDER BY email");
                                            }elseif ($_POST['orderBY'] == "Birthdate") {
                                                $authorACC = mysqli_query($conn, "SELECT * FROM $table ORDER BY $bday");
                                            }elseif ($_POST['orderBY'] == "ID") {
                                                $authorACC = mysqli_query($conn, "SELECT * FROM $table ORDER BY $userID");
                                            }
                                            else{
                                                $authorACC = mysqli_query($conn, "SELECT * FROM $table");
                                            }
                                     }else {
                                         $authorACC = mysqli_query($conn, "SELECT * FROM $table");
                                     }
                                  

                                        while ($recent_logs = mysqli_fetch_assoc($authorACC)) {
                                       
                                    
                                    ?>
                                        <tr>
                                        
                                            <td><?php echo $recent_logs[$userID]; ?></td>
                                            <td><?php echo $recent_logs[$fname]. " " .$recent_logs['last_name']; ?></td>
                                            <td><?php echo $recent_logs['email'];?></td>
                                            <td><?php echo $recent_logs[$bday];?></td>
                                            <td><?php echo $_GET['at'];?></td>
                                             <td style="display: flex; justify-content:center">
                                                <!-- VIEW BUTTON -->
                                             
                                                        <button type="button" style=" border:none; display:flex;color: white; text-align:center; width:100%; justify-content:space-between; align-items:center;background-color:rgb(117, 59, 22); color:white; border: none; padding: 5px; width: 60px;display: flex;" 
                                                        data-id="<?= $recent_logs[$userID];?>"
                                                        data-user="<?= $_GET['at']?>"
                                                        data-fname="<?= $recent_logs[$fname];?>"
                                                        data-lname="<?= $recent_logs['last_name'];?>"
                                                        data-bday="<?= $recent_logs[$bday];?>"
                                                        data-email="<?= $recent_logs['email'];?>"
                                                        data-pass="<?= $recent_logs['password'];?>"
                                                        data-picture="<?= $recent_logs['profile_pic'];?>"
                                                       
                                                        onclick="handleClick(
                                                        this.getAttribute('data-id'),
                                                        this.getAttribute('data-user'),
                                                        this.getAttribute('data-fname'),
                                                        this.getAttribute('data-lname'),
                                                        this.getAttribute('data-bday'),
                                                        this.getAttribute('data-email'),
                                                        this.getAttribute('data-pass'),
                                                        this.getAttribute('data-picture'),
                                                        )">
                                                            <i class="fa-solid fa-eye" style="color:white"></i>
                                                                View
                                                        </button>
                                                    
                                             </td>

                                        
                                        </tr>
                                    <?php
                                        }
                                        
                                         
                                    ?>
                                    
                                </tbody>
                             </table>
                        </div>
                        <div class="" style="display: flex; justify-content: space-between;">
                           
                            <?php
                            if($_GET['at'] == "Admin"){
                                ?>
                                <button type="button" id="addAccount" style="background-color: #3999AA; border: none; color: white; padding: 5px;" onclick="document.getElementById('asd').style.display = 'flex'">Add account</button>
                                <?php
                            }
                            ?>
                      
                        
                        </div>
                </div>

                 <?php
                                
                                 ?>
             

            

        </article>
    </div>
     <div class="popUP" id="popUP">
      
        <div class="open" id="open">
            <a href="accounts.php?at=<?= $type_account?>" style="text-decoration: none;font-size: 20px; font-weight: bolder;justify-content:end; text-align:end; color:black">
                <i class="fa-solid fa-circle-xmark" ></i></a>
            
            <div class="user">

               <div class="ids">
                    <p>USER ID</p>
                    <p class="ID_number" id="ID_number">1</p>
               </div>
                
                <img src="../images/Admin.png" alt="" id="img">
            </div>
                                       
            <div class="neededInfo">
                <input type="hidden" name="" id="idVALUE">
                <p id="">FULL NAME</p>
                <input type="text" name="OPEN_name" id="OPEN_name">
                <p>EMAIL</p>
                <input type="email" name="email" id="email" placeholder="DUMMYEMAIL@EMAIL.COM">
                <p>PHONE NUMBER</p>
                <input type="number" name="phone" id="phone" placeholder="+639389001154">
                <p>BIRTHDAY</p>
                <input type="date" name="" id="bday">
               
                
            </div>

                                <form method="post" class="buttons">
                                    <button type="button" class="change" onclick="ChangePASS()">
                                        CHANGE PASSWORD
                                    </button>
                                    <a id="my_link" href="#">
                                    <button type="button" class="delete" >
                                        DELETE
                                    </button>
                                    </a>

                                    <button type="button" class="edit" onclick="saving(
                                        document.getElementById('OPEN_name').value,
                                        document.getElementById('user_IDS').value,
                                        document.getElementById('email').value,
                                        document.getElementById('user_types').value,
                                        document.getElementById('phone').value
                                        )">
                                        SAVE
                                    </button>
                                    </form>
        </div>

       
    </div>

    <div class="popUP" id="popUP2">
        <div class="open" id="open2">
                <a href="accounts.php?at=<?= $type_account?>" style="text-decoration: none;font-size: 20px; font-weight: bolder;justify-content:end; text-align:end; color:black">
                    <i class="fa-solid fa-circle-xmark" ></i></a>
            <p>Change Password</p>
            <input type="hidden" id="currentPass"> 
            <input type="hidden" id="user_IDS"> 
            <input type="hidden" id="user_types"> 
            <input type="hidden" id="cha" value="<?php if(isset($_GET['cha'])){echo$_GET['cha'];}?>">
            <?php
            if(isset($_GET['cha'])){
                
                    echo '
                    <input type="hidden" id="passIScorrect" value="'.$_GET['cha'].'"> 
                    ';
                
            }else{
                 echo '
                    <input type="hidden" id="passIScorrect" value=""> 
                    ';
            }
            ?>

                <div class="neededInfo">
                    <p id="oldpassp">Old Password</p>
                    <input type="password" name="oldPASS" id="oldpass">
                    <p id="newpassp">New Password</p>
                    <input type="password" name="newPASS" id="newpass">

                    <p id="confirmpassp">Confirm new Password</p>
                    <input type="password" name="confirmPASS" id="confirmpass">

                </div>

                <div class="buttons">
                    <button type="button" id="verify" class="change" onclick="Verifies()">
                            Verify
                    </button>

                    <button type="button" id="changePASS" class="change" onclick="Changes()">
                            CHANGE PASSWORD
                    </button>

                     <button type="button" class="change" onclick="cancels()">
                            Cancel
                    </button>
                </div>
        </div>
    </div>

    <div class="popUP" id="asd">
        <form method="post" class="open" id="open2">
            <div class="neededInfo">
            <p>First name</p>
               <input type="text" name="createFname" id="" required>
               <p>Email</p>
               <input type="email" name="createEmail" id="" required>
              <p>Password</p>
               <input type="password" name="createPassword" id="" required>
              <button type="submit" name="submitnewaccount"></button>
            </div>
        </form>
       <?php
        if(isset($_POST['submitnewaccount'])){
            if(isset($_POST['createFname']) && isset($_POST['createEmail']) && isset($_POST['createPassword'])){
            echo $fname = $_POST['createFname'];
            $email = $_POST['createEmail'];
            $pass = $_POST['createPassword'];
            $GETexisting = mysqli_query($conn, "SELECT email FROM admin_account WHERE email ='$email'");
                echo mysqli_num_rows($GETexisting);
            if (mysqli_num_rows($GETexisting) > 0) {
                   echo ' <script>
                alert("Email is already used!");
                
                 </script>
                  ';
             }else{
                $insert = mysqli_query($conn, "INSERT INTO admin_account(fname, email, password) VALUES ('$fname', '$email', '$pass')");
                    echo '
                        <script>
                        alert("Successfully added");
                        window.location.href = "accounts.php?at=Admin";
                        </script>
                    ';
             }
     
            
          
             
            
            
            
            }
            
        }
       ?>
    </div>
 
<?php  
}
   if(isset($_GET['id'])){
     ?><input type="hidden" id="newID" value="<?=$_GET['id']?>"><?php
    ?><input type="hidden" id="newUser" value="<?=$_GET['at']?>"><?php
    ?><input type="hidden" id="cpass" value="<?=$_GET['c']?>"><?php
   }


?>
<script>

    function handleClick(dataID,users, fname , lname , bday, email,pass, profilePic) {
    document.getElementById("popUP").style.display = "flex";
    document.getElementById("ID_number").innerHTML = dataID;

    document.getElementById("user_IDS").value = dataID;
    document.getElementById("user_types").value = users;
    document.getElementById("OPEN_name").value = fname + lname;
    document.getElementById("email").value = email;
    document.getElementById("currentPass").value = pass;
    document.getElementById("bday").value = bday;
    

    if(profilePic == ""){
     
    }else{
        document.getElementById("img").src = "../images/" +profilePic;
    }

   
     const link = document.getElementById('my_link');

    link.addEventListener('click', function (event) {
 
      event.preventDefault();

      const userConfirmed = confirm('Do you want to proceed?');


      if (userConfirmed) {
        
       window.location.href = 'deleting.php?id='+dataID+'&at='+users;
      } else {
       
      }
    });
  
   
   
  }
function  saving(names, ID, email,users, phone) {
   let userResponse = confirm('Do you want to proceed?');

   
    if (userResponse) {
        window.location.href = "changeinfo.php?name="+names+"&id="+ID+"&email="+email+"&phone="+phone+"&at="+users;
    } else {
        console.log('User clicked Cancel!');
    }
}

const cha = document.getElementById('cha').value;

if (cha == 2) {

    document.getElementById("verify").style.display = "none";
    const popup = document.getElementById("popUP2").style.display = "flex";
    document.getElementById("oldpassp").style.display = "none";
    document.getElementById("oldpass").style.display = "none";
    document.getElementById("changePASS").style.display = "flex";
    document.getElementById("newpassp").style.display = "flex";
    document.getElementById("confirmpassp").style.display = "flex";
  
   
  
                
  
   function Changes(){
    
        const newpass = document.getElementById("newpass").value;
        const confirmpass = document.getElementById("confirmpass").value;

    
   
        if (newpass == "" || confirmpass == "") {
            alert("Please Enter all inputs");
        }else{
            if (newpass != confirmpass) {
                alert("Passwords did not Match!");
            }else{
                let userResponse = confirm('Are tou sure you want to change your Password?');

                // Check the user's response
                if (userResponse) {
                    const newIDElement = document.getElementById("newID");
                    const newUserElement = document.getElementById("newUser");

                    const user_id = newIDElement.value;
                    const user_type = newUserElement.value;
                    
                    window.location.href = "changepass.php?id="+user_id+"&user="+user_type+"&n="+newpass;
                } else {
                    console.log('User clicked Cancel!');
                }
            
            }
        }
    }
}else if(cha == 1){
    const popup = document.getElementById("popUP2").style.display = "flex";
    document.getElementById("changePASS").style.display = "none";
    document.getElementById("newpassp").style.display = "none";
    document.getElementById("confirmpassp").style.display = "none";
    document.getElementById("newpass").style.display = "none";
    document.getElementById("confirmpass").style.display = "none";

     function Verifies(){
        const oldpass = document.getElementById("oldpass").value;


        if(oldpass == ""){
            alert("Please Enter your Current Password");
        }else{
            const user_type = document.getElementById("user_types").value;
            const currentPass = document.getElementById("currentPass").value;

           if(user_type != "Admin"){
               const newIDElement = document.getElementById("newID");
                    const newUserElement = document.getElementById("newUser");
                    const cpass = document.getElementById("cpass");

                    const user_id = newIDElement.value;
                    const user_type = newUserElement.value;
                    const user_pass = cpass.value;
                    window.location.href = "verifyHash.php?o="+oldpass+"&c="+user_pass+"&id="+user_id+"&at="+user_type;
           }
 
        }     
        
    }
}
  
</script>
<script src="change.js"></script>
</body>
</html>