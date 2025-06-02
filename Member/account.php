<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
<?php
         require 'db.php';
     
         $id = $_SESSION['ID'];
         $admin_infos = mysqli_query($conn, "SELECT * FROM member_account WHERE memberID = $id");
 
         while ($results = mysqli_fetch_assoc($admin_infos)) {
             
?>
    <div class="sidebar">
        <h1>Book Room</h1>
        <div class="profile">
        <img src="images/<?= $results['profile_pic']?>" alt="Profile Picture">
            <h2><?= $results['fname']?></h2>
            <p><?php 
                if(empty($results['lname'])){
                    echo " Not provided";
                }else{
                    echo $results['lname'];
                }
            ?></p>
            <hr>
        </div>
        <div class="menu">
            <a href="discover.php"> <button class="text-btn">Discover</button> </a>
            <a href="popular.php"><button class="text-btn">Popular</button> </a>
            <a href="newrelease.php"><button class="text-btn">New Release</button> </a> 
            <a href="savedbook.php"><button class="text-btn">Saved Books</button> </a>
            <br><br><br><br>
            <button class="account-btn">Account</button> </a>
            <a href="logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1 style="font-size: 30px">ACCOUNT SETTINGS</h1>
       
        <div class="cons">
            <div class="personalInfo">
                <h3>Personal Information</h3>
                <div class="bday">
                    <input type="date" name="birthday" id="birthday" value="<?php
                        if(empty($results['birthday'])){
                            echo "";
                        }else{
                            echo $results['birthday'];
                        }
                    ?>">
                    <p>Birthday</p>
                </div>
        
                <div class="bday">
                    <select type="gender" name="gender" id="gender" placeholder="gender">
                        <option value=""><?php
                            if(empty($results['gender'])){
                                echo "Not Provided yet";
                            }else{
                                echo $results['gender'];
                            }
                        ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <p>Gender</p>
                </div>
        
                <div class="bday">
                    <input type="text" name="location" id="location" placeholder="
  <?php
                        if(empty($results['location'])){
                            echo "Not Provided yet";
                        }else{
                            echo $results['location'];
                        }
                    ?>
                    ">
                    <p>Location</p>
                </div>
        
                <div class="profEDIT">
                    <button type="button" onclick="editPersonal_info()">EDIT</button>
        </div>
        

            </div>

            <div class="prof">

                <div class="top">
                    <div class="conte">
                        <div class="picNmae">
                            <img src="images/<?= $results['profile_pic']?>" alt="">
                            <h3>Sarah Duterte</h3>
                        </div>
                    </div>

                    <div class="id">
                        <p>User ID</p>
                        <div class="IDnum">
                        <?= $results['memberID']?>
                        </div>  
                    </div>
                </div>


                <div class="bottom">
                    <h4>Account Credentials</h4>
                    <div class="mainBot">
                        <div class="left">
                            <label for="">Email</label>
                            <br>
                            <input type="email" name="" id="" placeholder="example@email.com">
                            <br>
                            <label for="">Phone number</label>
                            <br>
                            <input type="number" name="" id="" placeholder="+639389042134">
                            <br>
                            <label for="">Secondary email</label>
                            <br>
                            <input type="email" name="" id="" placeholder="2ndexample@email.com">
                            <br>
                        </div>

                        <div class="right">
                            <label for="">Secondary email</label>
                            <br>
                            <input type="email" name="" id="" placeholder="2ndexample@email.com">
                            <br>
                          
                            

                            <div class="lastBot">
                                <button type="button" onclick="updateProf()">Update</button>
                                <button type="button" onclick="changeProf()">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
    <div class="editprofile" id="editprofile">
        <h2>Update Personal Info</h2>
        <div class="eds">
            <div class="inputs">
                <label for="">First Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                <label for="">Last Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                <label for="">Gender Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                <label for="">Location Name</label><br>
                <input type="text" name="" id="" placeholder="Select Gender ..."><br>
                <label for="">Birthday</label><br>
                <input type="date" name="" id="" placeholder=""><br>
            </div>

            <div class="ups">
                <div class="uplo">
                    <img src="images/<?= $results['profile_pic']?>" alt="">
                </div>
                <button>Upload Profile Picture...</button>
            </div>
        </div>

        <div class="lowbot">
            <a href=""><button class="cancel">CANCEL</button></a>
            <a href=""><button class="update">UPDATE</button></a>
        </div>
    </div>

    <div class="updateprofile" id="updateprofile">
        <h2>Update Credentials</h2>
        <div class="eds">
            <div class="inputs">
                <label for="">First Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                <label for="">Last Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                <label for="">Gender Name</label><br>
                <input type="text" name="" id="" placeholder="Type here ..."><br>
                
            </div>

            <div class="asd">
                <div class="inputs">
                    <label for="">Security  Question</label><br>
                    <input type="text" name="" id="" placeholder="Type here ..."><br>
                    <label for="">Answer</label><br>
                    <input type="text" name="" id="" placeholder="Type here ..."><br>  
                </div>
            </div>
        </div>

        <div class="lowbot">
            <a href=""><button class="cancel">CANCEL</button></a>
            <a href=""><button class="update">UPDATE</button></a>
        </div>
    </div>

    <div class="changeprofile" id="changeprofile">
        <h2>Change Password</h2>
        <div class="eds">
            <div class="inputs">
                <label for="">Old Password :</label><br>
                <input type="password" name="" id="" placeholder="Type here ..."><br>
                <label for="">New Password :</label><br>
                <input type="password" name="" id="" placeholder="Type here ..."><br>
                <label for="">Confirm New Password :</label><br>
                <input type="password" name="" id="" placeholder="Type here ..."><br>
                
            </div>

        </div>

        <div class="lowbot">
            <a href=""><button class="cancel">CANCEL</button></a>
            <a href=""><button class="update">UPDATE</button></a>
        </div>
    </div>
    <?php
         }
    ?>
    <script>
        let ads = document.getElementById('editprofile');
        let adsa = document.getElementById('updateprofile');
        let adsas = document.getElementById('changeprofile');

        function editPersonal_info(){
            ads.classList.add('pop');
        }
        function updateProf(){
            adsa.classList.add('pop');
        }

        function changeProf(){
            adsas.classList.add('pop');
        }

        
    </script>
</body>
</html>