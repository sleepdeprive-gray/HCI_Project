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
                <img src="../../images/logos.png" alt="">
                <p>BOOK <span>ROOM</span></p>
            </div>
             <?php
                if(!empty($results['profile_pic'])){
                    ?><img src="../../images/<?php echo $results['profile_pic'] ?>" alt=""><?php
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
                
                    <a href="../admin.php" style="margin-bottom: -15px;"><button style="color:black"><i class="fa-solid fa-house" style="margin-right: 10px;"></i>Dashboard</button></a>
                     <a href="../analytics.php" style="margin-bottom: -15px;color:black"><button style="color:black"><i class="fa-solid fa-chart-simple" style="margin-right: 10px;"></i>Analytics</button></a>
                    <a href="../accounts/accounts.php?at=Editor" style="margin-bottom: -15px;color:black"><button style="color:black"><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <button class="Active" style="margin-bottom: 0px;color:black"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button>
                    <a href="../activity_log.php" style="color:black"><button style="color:black"><i class="fa-solid fa-file" style="margin-right: 10px;"></i>Activity Log</button></a>

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


       
        <article >
            <?php
            $bookID = $_GET['book'];

            $selects_all_info_per_book = mysqli_query($conn, "SELECT * FROM books WHERE book_id= $bookID");

           while ($results=mysqli_fetch_array($selects_all_info_per_book)) {
            ?>
        <div class="" style="width:90%; 
                position:relative; display: flex; justify-self:center; margin:20px; height:500px;
                flex-wrap:wrap; justify-content: space-around">
            <div class="" style="border: 3px dashed white; min-width:25%; display:flex; justify-content:center; align-items:center;
                                background-color:#6A9C89">
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
                                     <img src="data:image/jpeg;base64, '.base64_encode($results['front_cover']).'" width=300/>
                                     ';
                                }
               ?>
            </div>
            <div class="" style="width: 70%; display:flex; flex-direction: column; background-color: var(--background-color)">
                <div class="" style="display:flex ; justify-content:end" >
                    <a href="../science.php?c=<?=$category?>&s=Pending" style="color:rgb(255, 54, 54);"><i class="fa-solid fa-circle-xmark" style="font-size: 30px; margin-right: 20px; margin-top: 20px"></i></a>
                </div>
                <div class="" style=" height:460px; width:90%; padding:5px" >

                

                 <form action="rejected.php?book=<?= $_GET['book']?>&c=<?= $_GET['c']?>&s=Rejected" method="POST">
                        <h1 >Feedback:</h1>
                        <h4><?= $results['title']?></h4>

                            <select name="mainReason" id="" style="background-color:rgb(117, 59, 22) ; color: white" required>
                                <option value="The book is not a real book!">The book is not a real book!</option>
                                <option value="The book is not complete">The book is not complete</option>
                                <option value="The book vaulate the rule">The book vaulate the rule</option>
                            </select>
                    <input type="hidden" name="bookID" value="<?= $_GET['book']?>">
                    <input type="hidden" name="category" value="<?= $_GET['c']?>">
                    <textarea id="feedback" name="feedback" rows="5" placeholder="Your feedback" required></textarea>

                    <button type="submit" name="rejectIT" style="background-color: rgb(117, 59, 22);"><i class="fa-solid fa-paper-plane" style="color:white"></i>  Send</button>
                </form>

            <style>
            
                form {
                    max-width: 90%;
                    margin: auto;
                    /* justify-self: center;
                    align-self: center;
                    display:flex;
                    flex-direction: column; */
                }
                label {
                    display: block;
                    margin-bottom: 5px;
                    font-weight: bold;
                }
                input, textarea, button{
                    width: 100%;
                    margin-bottom: 15px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                select{
                    width: 30%;
                    margin-bottom: 15px;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
                button:hover {
                    background-color: #45a049;
                }
            </style>

                </div>
            </div>
        </div>
            <?php
           }
            ?>

        </article>
        <?php
    
    ?>

    <script src="../js/navigation.js"></script>
    <script>
       
       
    function navigateToLink() {
      const select = document.getElementById('linkSelect');
      const url = select.value;
      if (url) {
        window.location.href = url;
      }
    }
     function handleClick(dataId,dataName) {
    document.getElementById("asd").style.display = "flex";

     const ids = document.getElementById("ids").value = dataId;


    
        console.log(ids);
  
   
  }

  </script>
<?php  
}
?>
</body>
</html>