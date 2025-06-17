<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
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

        <?php require_once 'component/nav1.php' ?>
        <?php require_once 'component/nav2.php' ?>

      


        <article>
            <div class="time">
                <div class="times" style="background-color:rgb(168, 83, 30); ">
                    <p style="color: white;">Analytics</p>
                </div>
            </div>
                <div class="activitycon" style="height: 850px; color: rgb(94, 47, 18);">
                     
   
                    <div class="activityPage" style="flex-direction:column;">
                        <p class="pbook" style="margin-bottom: -220px; color:black">Books</p>
                        <div class="booksCard" style="width: 90%; display:flex; justify-content:space-around; 
                            align-items:center;  align-self:center;  flex-wrap:wrap; gap:10px;  ">
                            <a href="category/science.php?s=Approve&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; ">
                                <i style="font-size: 100px;margin-top:20px; color: white" class="fa-solid fa-book"></i>
                                <p style="color: white; font-size:30px" >
                                    <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Approved'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: white;font-size:25px;margin-top:-10px "><i class="fa-solid fa-thumbs-up" style="margin-right: 10px;color: white"></i>Approved</p>
                                <p style="color: white;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Pending&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px;color: white;" class="fa-solid fa-book"></i>
                                <p style="color: white; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Pending'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: white;font-size:25px;margin-top:-10px "><i class="fa-solid fa-hourglass-half" style="margin-right: 10px;color: white;"></i></i>Pending</p>
                                <p style="color: white;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Rejected&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px;color: white" class="fa-solid fa-book"></i>
                                <p style="color: white; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Rejected'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: white;font-size:25px;margin-top:-10px "><i class="fa-solid fa-circle-xmark" style="margin-right: 10px;color: white"></i></i>Rejected</p>
                                <p style="color: white;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                            <a href="category/science.php?s=Archive&c=Science" class="" style="background-color: rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
                                                    box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer">
                                <i style="font-size: 100px;margin-top:20px;color: white;" class="fa-solid fa-book"></i>
                                <p style="color: white; font-size:30px" >
                                     <?php
                                        $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books WHERE status='Archive'");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                                    ?>
                                </p>
                                <p style="color: white;font-size:25px;margin-top:-10px "><i class="fa-solid fa-trash" style="margin-right: 10px;color: white;"></i></i>Archive</p>
                                <p style="color: white;font-size:23px;margin-top:-10px">Accoount</p>
                            </a>
                           
                        </div> 
                        <h1 style=" color:black;margin-bottom: -220px; margin-top:-220px">Total Books: 
                            <?php 
                                $numberOFbooks = mysqli_query($conn, "SELECT COUNT(status) FROM books");

                                        while ($fetching = mysqli_fetch_assoc($numberOFbooks)) {
                                            echo $fetching['COUNT(status)'];
                                        }
                            ?>
                        </h1>
                        <div class="" style="width: 90%;  display:flex; justify-content:space-around; align-items:center;  align-self:center; flex-wrap:wrap">
                            <div class="" >
                                    <a href="category/science.php?s=Approved&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Approved)
                                                        <p style="color: white;margin:0">
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

                                <a href="category/science.php?s=Approved&c=Novel" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Approved&c=Mystery" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Approved&c=Narrative" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Approved&c=Fiction" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Approved&c=History" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Approved&c=Fantasy" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Approved)
                                                    <p style="color: white;margin:0">
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
                                    <a href="category/science.php?s=Pending&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Pending)
                                                        <p style="color: white;margin:0">
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

                                <a href="category/science.php?s=Pending&c=Novel" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Pending&c=Mystery" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Pending&c=Narrative" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Pending&c=Fiction" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Pending&c=History" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Pending&c=Fantasy" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Pending)
                                                    <p style="color: white;margin:0">
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
                                    <a href="category/science.php?s=Rejected&c=Science" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Science Book (Rejected)
                                                        <p style="color: white;margin:0">
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

                                <a href="category/science.php?s=Rejected&c=Novel" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Novel Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Rejected&c=Mystery" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Mystery Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Rejected&c=Narrative" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Narrative Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Rejected&c=Fiction" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fiction Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Rejected&c=History" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        History Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                <a href="category/science.php?s=Rejected&c=Fantasy" class="" style="background-color: #BB5C22; width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color: white; border-radius:15px;
                                                        box-shadow: 0 10px 10px rgba(0, 0, 0, .7); cursor:pointer; padding:5px;margin-bottom:10px">
                                                        Fantasy Book (Rejected)
                                                    <p style="color: white;margin:0">
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
                                    <a href="category/science.php?s=Archive&c=Science" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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

                                <a href="category/science.php?s=Archive&c=Novel" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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
                                <a href="category/science.php?s=Archive&c=Mystery" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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
                                <a href="category/science.php?s=Archive&c=Narrative" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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
                                <a href="category/science.php?s=Archive&c=Fiction" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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
                                <a href="category/science.php?s=Archive&c=History" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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
                                <a href="category/science.php?s=Archive&c=Fantasy" class="" style="background-color:rgb(224, 66, 66); width:200px;display:flex; flex-direction:column; align-items:center; justify-content:center; color:white; border-radius:15px;
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