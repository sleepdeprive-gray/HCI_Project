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
       
        <nav class="nav1">
            <div class="logo_TOP_LEFT">
                <img src="../../../images/weblogo.png" alt="">
                <p>BOOK <span>ROOM</span></p>
            </div>
             <?php
                if(!empty($results['profile_pic'])){
                    ?><img src="../../images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                }else{
                    ?><img src="../../images/Admin.png" alt=""><?php
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
                
                    <a href="../../admin.php"><button><i class="fa-solid fa-house"></i>Dashboard</button></a>
                    <a href="../../analytics.php"><button><i class="fa-solid fa-chart-simple"></i>Analytics</button></a>
                    <a href="../../accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i>Accounts</button></a>
                    <button class="Active"><i class="fa-solid fa-book"></i>Books</button>
                    <a href="../../activity_log.php"><button><i class="fa-solid fa-file"></i>Activity Log</button></a>

                    
                  
                </div>
                <form action="../../../process/Admin/logput.php?id=<?= $id;?>" method="post" class="LOGOUT_CONTAINER">
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
                
                    <a href="../../admin.php"><button class="Active"><i class="fa-solid fa-house"></i><p>Dashboard</p></button></a>
                    <a href="../../analytics.php"><button><i class="fa-solid fa-chart-simple"></i><p>Analytics</p></button></a>
                    <a href="../../accounts/accounts.php?at=Editor"><button><i class="fa-solid fa-user"></i><p>Accounts</p></button></a>
                    <a href="../../category/science.php?s=Pending&c=Science"><button><i class="fa-solid fa-book"></i><p>Books</p></button></a>
                    <a href="../../activity_log.php"><button><i class="fa-solid fa-file"></i><p>Activity Log</p></button></a>
                  
                </div>

              
                <form method="post"  action="../../../process/Admin/logput.php?id=<?= $id;?>" class="LOGOUT_AND_PIC_CONTAINER">
                    <button type="submit" name="LOGOUT">LOGOUT</button>
                     <?php
                        if(!empty($results['profile_pic'])){
                            ?><img src="../../images/<?php echo $results['profile_pic'] ?>" alt=""><?php
                        }else{
                            ?><img src="../../images/Admin.png" alt=""><?php
                        }
                    ?>
                </form>

        </nav>
      


       
         <?php
            $bookID = $_GET['book'];

            $selects_all_info_per_book = mysqli_query($conn, "SELECT * FROM books WHERE book_id= $bookID");

           while ($results=mysqli_fetch_array($selects_all_info_per_book)) {
                
            
         ?>
        <article>
            <div class="time">
                <div class="times">
                    <p>VIEW BOOKS</p>
                </div>
            </div>
            
                <div class="viewbookcon">
                    <p style="font-weight: bold; color:white;">SCIENCE BOOK</p>   
                   
                        <div class="viewbook">
                            <?php
                                if(base64_encode($results['front_cover']) == ""){
                                    ?>
                                    <div class="ifIMAGE_notAVAILABLE">
                                        <i class="fa-solid fa-face-sad-tear"></i>

                                        <p>We're sorry but</p>
                                        <p style="margin-top:-18px;">this book doesnt have</p>
                                        <p style="margin-top:-18px;margin-bottom:-9px">book cover</p>
                                    </div>
                                    <?php
                                }else{
                                    echo '
                                     <img src="data:image/jpeg;base64, '.base64_encode($results['front_cover']).'"/>
                                     ';
                                }
                            ?>
                           
                                        
                            <div class="rightcontent">
                                <h1><?= $results['title']?></h1>

                                <div class="topcon">
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
                                
                                    <a href="../<?php echo "science.php?s=".$statusofBook."&c=".$category?>">
                                        <button>
                                            <i class="fa-solid fa-arrow-left"></i>   BACK
                                        </button>
                                    </a>
                                    
                                </div>

                                <div class="bottomleft">
                         
                                        <div class="descriptioncon">
                                            <p>Description</p>
                                            <p><?= $results['description']?></p>
                                        </div>
                                        
                                
                                        <div class="bottomright" >
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

                        <?php include '../fnc/view_status.php' ?>
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
        window.location.href = url;
      }
    }
  </script>
<?php  
}
?>
</body>
</html>