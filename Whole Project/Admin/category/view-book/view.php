<?php
    session_start();
    $statusofBook = $_GET['s'];
    $category = $_GET['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../admin.css">
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
    require '../../db/db.php';
    $id = $_SESSION['ID'];
    $admin_infos = mysqli_query($conn, "SELECT * FROM admin_account WHERE adminID = $id");

    while ($results = mysqli_fetch_assoc($admin_infos)) {
        
    
    ?>
    <div class="mainContainer">
        <!-- NAVIGATION 1 -->
        <nav class="nav1">
            <div class="" style="display: flex; justify-self: center;margin-top: 10px;margin-bottom: 10px;">
                <img src="../../../images/weblogo.png" alt="" style="width: 40px;height: 40px; border-radius: 0; border: none;">
                <p style="font-size: 15px;margin-left: 4px;font-weight: bold;">BOOK <span style="color: #A1BE95;">ROOM</span></p>
            </div>
            <img src="../../../images/<?php echo $results['profile_pic'] ?>" alt="">
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
                
                    <a href="../../admin.php"><button><i class="fa-solid fa-house" style="margin-right: 10px;"></i>Dashboard</button></a>
                    <button><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button>
                    <a href="../../accounts/accounts_editor.php"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <button class="Active"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button>
                    <a href="../../activity_log.php"><button><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button></a>

                    
                  
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
         <?php
            $bookID = $_GET['book'];

            $selects_all_info_per_book = mysqli_query($conn, "SELECT * FROM books WHERE book_id= $bookID");

            while ($results = mysqli_fetch_assoc($selects_all_info_per_book)) {
                
            
         ?>
        <article>
            <div class="time">
                <div class="times">
                    <p>VIEW BOOKS</p>
                </div>
            </div>
                <!-- MAIN CONTAINER -->
                <div class="" style="width: 90%; height:600px;position: relative;background-color: #6A9C89; display: flex;margin: 5px;justify-self: center; padding: 10px;  flex-direction: column;
                flex-wrap: wrap; ">
                    <p style="font-weight: bold; color:white;">SCIENCE BOOK</p>   
                    <!-- MAIN CONTENT -->
                        <div class="" style="width: 100%; display:flex; flex-wrap:wrap; justify-content:space-around">
                            <?php
                                if(empty($results['bookCOVER'])){
                                    ?>
                                    <div class="" style="width: 290px; border:4px dashed white; display:flex; justify-content:center; align-items:center; flex-direction:column; color:white">
                                        <i class="fa-solid fa-face-sad-tear" style="font-size: 60px;"></i>

                                        <p>We're sorry but</p>
                                        <p style="margin-top:-18px;">this book doesnt have</p>
                                        <p style="margin-top:-18px;margin-bottom:-9px">book cover</p>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                     <img src="../../../images/<?= $results['bookCOVER']?>" alt="" style="width: 290px; border:4px dashed white">
                                    <?php
                                }
                            ?>
                           
                                        
                            <div class="" style="width:70%;">
                                <h1 style="background-color:white;padding:10px "><?= $results['title']?></h1>

                                <div class="" style="display: flex; justify-content: space-between; background-color:white;align-items:center;margin-top:5px; margin-bottom:5px; padding-left:10px; padding-right:10px">
                                    <p>
                                        <?php
                                            $authorID = $results['author_id'];
                                            $name_of_the_author = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorID") ;
                                            while ($name = mysqli_fetch_assoc($name_of_the_author)) {
                                                echo $name['fname'];
                                            }  
                                        ?>
                                    </p>
                                    <?php
                                        
                                    ?>
                                    <!-- EXIT -->
                                    <a href="../<?php echo "science.php?s=".$statusofBook."&c=".$category?>"><button style="background-color: #3c554c; color:white;border:none;padding:5px; cursor:pointer"><i class="fa-solid fa-arrow-left" style="margin-right: 5px;"></i>   BACK</button></a>
                                    
                                </div>

                                <div class="" style="width: 100%;display:flex; gap: 10px;">
                                    <!-- DESCRIPTION  -->
                                        <div class="" style="width:70%; background-color:white;padding:10px ">
                                            <p>Description</p>
                                            <p><?= $results['description']?></p>
                                        </div>
                                        
                                    <!-- AUTHOR, LANGUAGE AND DATE PUBLISED -->
                                        <div class="" style="width:30%;background-color:white;padding:10px ">
                                            <p>Editor</p>
                                            <p>Name HERe</p>

                                            <p>Language</p>
                                            <p><?= $results['language']?></p>

                                            <p>Date Published</p>
                                            <p><?= $results['date_published']?></p>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            if($results['status'] == "Pending"){
                        ?>
                            <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed red">
                                <p style="color: red; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book is Pending</p>
                            </div>
                        <?php
                            }else{
                                    ?>
                                    <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed green;">
                                        <p style="color: green; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book Approved</p>
                                    </div>
                                    <?php
                                }
                        ?>
                </div>

            

        </article>
        <?php
            }
        ?>
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