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
                    <button  class="Active"><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button>
                    <a href="accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <a href="category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button></a>
                    <a href="activity_log.php"><button><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button></a>

                  
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
                    <p>Analytics</p>
                </div>
            </div>
                <div class="activitycon" style="height: 850px;">
                     
   
                    <div class="activityPage" style="flex-direction:column;">
                        <p class="pbook" style="margin-bottom: -220px;">Books</p>
                        <div class="booksCard" style="width: 90%; display:flex; justify-content:space-around; 
                            align-items:center;  align-self:center;  flex-wrap:wrap; gap:10px;  ">
                            <a href="category/science.php?s=Approve&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; ">
                                <i style="font-size: 100px;margin-top:20px" class="fa-solid fa-book"></i>
                                <p style="color: green; font-size:30px" >
                                    <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Approved'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: green;font-size:25px;margin-top:-10px "><i class="fa-solid fa-thumbs-up" style="margin-right: 10px;"></i>Approved</p>
                                <p style="color: green;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Pending&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px" class="fa-solid fa-book"></i>
                                <p style="color: blue; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Pending'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: blue;font-size:25px;margin-top:-10px "><i class="fa-solid fa-hourglass-half" style="margin-right: 10px;"></i></i>Pending</p>
                                <p style="color: blue;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Rejected&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px" class="fa-solid fa-book"></i>
                                <p style="color: red; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Rejected'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: red;font-size:25px;margin-top:-10px "><i class="fa-solid fa-circle-xmark" style="margin-right: 10px;"></i></i>Rejected</p>
                                <p style="color: red;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Archive&c=Science" class="" style="background-color: rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px" class="fa-solid fa-book"></i>
                                <p style="color: white; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Archive'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: white;font-size:25px;margin-top:-10px "><i class="fa-solid fa-trash" style="margin-right: 10px;"></i></i>Archive</p>
                                <p style="color: white;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                           
                        </div> 
                        <h1 style=" color:white;margin-bottom: -220px; margin-top:-220px">Total Books: 
                            <?php 
                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                            ?>
                        </h1>
                        <div class="" style="width: 90%;  display:flex; justify-content:space-around; align-items:center;  align-self:center; flex-wrap:wrap">
                            <div class="" >
                                    <a href="category/science.php?s=Approved&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Approved)
                                                        <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Science'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                    
                                                        </a>

                                <a href="category/science.php?s=Approved&c=Novel" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Novel'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Approved&c=Mystery" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Mystery'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Approved&c=Narrative" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Narrative'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Approved&c=Fiction" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Fiction'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Approved&c=History" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='History'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Approved&c=Fantasy" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:green; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Approved)
                                                    <p style="color: green;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Approved' AND genre='Fantasy'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                            </div>
                                                            <!-- PENDING -->
                             <div class="">
                                    <a href="category/science.php?s=Pending&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Pending)
                                                        <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Science'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                    
                                                        </a>

                                <a href="category/science.php?s=Pending&c=Novel" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Novel'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Pending&c=Mystery" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Mystery'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Pending&c=Narrative" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Narrative'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Pending&c=Fiction" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Fiction'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Pending&c=History" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='History'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Pending&c=Fantasy" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:blue; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Pending)
                                                    <p style="color: blue;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Pending' AND genre='Fantasy'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                            </div>
                                
                             <div class="">
                                    <a href="category/science.php?s=Rejected&c=Science" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Rejected)
                                                        <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Science'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                    
                                                        </a>

                                <a href="category/science.php?s=Rejected&c=Novel" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Novel'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Rejected&c=Mystery" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Mystery'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Rejected&c=Narrative" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Narrative'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Rejected&c=Fiction" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Fiction'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Rejected&c=History" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='History'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Rejected&c=Fantasy" class="" style="background-color:white; width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:red; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Rejected)
                                                    <p style="color: red;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Rejected' AND genre='Fantasy'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                            </div>

                             <div class="">
                                    <a href="category/science.php?s=Archive&c=Science" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Archive)
                                                        <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Science'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                    
                                                        </a>

                                <a href="category/science.php?s=Archive&c=Novel" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Novel'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Archive&c=Mystery" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Mystery'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Archive&c=Narrative" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Narrative'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Archive&c=Fiction" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Fiction'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Archive&c=History" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='History'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                                <a href="category/science.php?s=Archive&c=Fantasy" class="" style="background-color:rgb(224, 66, 66); width:240px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Archive)
                                                    <p style="color: white;margin:0">
                                                            <?php
                                                            try {
                                                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status ='Archive' AND genre='Fantasy'");
                                                            while ($counts = mysqli_fetch_assoc($numberOFbooks)) {
                                                                echo $counts['COUNT(status)'];
                                                            }
                                                            } catch (\Throwable $th) {
                                                            echo "0";
                                                            }
                                                            ?>
                                                        </p>
                                                        </a>
                            </div>
                        </div>
                    </div>
                        
                        
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