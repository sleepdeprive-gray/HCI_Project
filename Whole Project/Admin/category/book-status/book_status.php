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
        background-color: rgb(117, 59, 22);
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
         
                    <img src="apate.png" alt="">

             
                    <p>BOOK <span>ROOM</span></p>
                </div>

              
                <div class="links_button">
                
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                    <button>SULAT HERE</button>
                  
                </div>

       
                <div class="LOGOUT_AND_PIC_CONTAINER">
                    <button>LOGOUT</button>
                    <img src="mytyping test.png" alt="" >
                </div>

        </nav>
   



        <article>
            <div class="time">
                <div class="times">
                    <p>BOOKS</p>
                </div>
            </div>
                <div class="bookcon">

                    <div class="bookconState">
                        <div class="bookPage">   
                            <p style="color: black"><?= $statusofBook ." ". $category?> BOOK</p>
                        </div>            
                    </div>
                        
                       
                    <div class="bookSORTcon">
                            
                          
                        <form method="POST">
                            <p>Sort</p>
                            <select name="orderBY" id="" onchange="this.form.submit()">
                                <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                <option value="book_id">Book ID</option>
                                <option value="title">Title</option>
                                <option value="author_id">Author</option>
                                <option value="Highest">Highest downloaded books</option>
                                <option value="Lowest">Lowest downloaded books</option>
                            </select>
                        </form>

                           
                        <ol>
                        
                            <a href="../science.php?s=<?= $statusofBook?>&c=Science" ><ul>Science</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=Novel" ><ul>Novel</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=Mystery" ><ul>Mystery</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=Narrative" ><ul>Narrative</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=Fiction" ><ul>Fiction</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=History" ><ul>History</ul></a>
                            <a href="../science.php?s=<?= $statusofBook?>&c=Fantasy" ><ul>Fantasy</ul></a>
                        </ol>

                            
                             <div class="category-in-selection-mode" style="display: none;">
                                <p>Category</p>
                                <select name="" id="linkSelect" onchange="navigateToLink()" style="color: white; margin-left: 10px; height: 30px; background-color: rgb(117, 59, 22); border: none;
                                display: flex;align-self: center;">
                                    <option value="admin.html">Science</option>
                                    <option value="">Novel</option>
                                    <option value="">Mystery</option>
                                    <option value="">Narrative</option>
                                    <option value="">Fiction</option>
                                    <option value="">History</option>
                                    <option value="">Fantasy</option>
                                </select>
                             </div>
                           
                    </div>


                        <div class="table_body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Book No.</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>no. of downloaded books</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  

                                  
                                  
                                  
                                 
                               
                                    
                                     <?php
                                     
                                    if(isset($_POST['orderBY'])){
                                         if($_POST['orderBY'] == "author_id" || $_POST['orderBY'] == "book_id" || $_POST['orderBY'] == "title"){
                                            $oderBY = $_POST['orderBY'];
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= '$category' AND status = '$statusofBook' ORDER BY $oderBY");
                                    }elseif($_POST['orderBY'] == "Highest"){
                                         $oderBY = 'downloads';
                                          $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= '$category' AND status = '$statusofBook' ORDER BY $oderBY DESC");
                                    }elseif ($_POST['orderBY'] == "Lowest") {
                                        $oderBY = 'downloads';
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= '$category' AND status = '$statusofBook' ORDER BY $oderBY ASC");
                                    }
                                    }else{
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= '$category' AND status = '$statusofBook' ORDER BY author_id");
                                    }
                                    if(mysqli_num_rows($selects_logs) > 0){
                                    // TABLE
                                    while ($recent_logs = mysqli_fetch_assoc($selects_logs)) {
                                        # code...
                                    
                                        ?>
                                        <tr>
                                        
                                            <td><?php echo $recent_logs['book_id']; ?></td>
                                            <td><?php echo $recent_logs['title']; ?></td>
                                            <td>
                                                <?php
                                                    $authorIDS = $recent_logs['author_id'];
                                                    $SELECT_AUTHOR_NAME = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorIDS");
                                                    while ($nameAUTHOR = mysqli_fetch_assoc($SELECT_AUTHOR_NAME)) {
                                                        echo $nameAUTHOR['fname'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $recent_logs['downloads'];?></td>
                                            <td>
                                                <?php 
                                                    if($recent_logs['status'] == "Approved"){
                                                        ?>
                                                        <span style="color: green;"><?= $recent_logs['status'];?></span>
                                                        <?php
                                                    }elseif($recent_logs['status'] == "Pending"){
                                                        ?>
                                                        <span style="color: blue;"><?= $recent_logs['status'];?></span>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <span style="color: red;"><?= $recent_logs['status'];?></span>
                                                        <?php
                                                    }
                                                ?></td>
                                                
                                            <td style="display: flex; justify-content: center; gap:10px">
                                                   
                                                    <?php include '../fnc/buttons2.php' ?>

                                                  
                                                    <a href="../view-book/view.php?book=<?= $recent_logs['book_id']?>&c=<?= $category?>&s=<?= $statusofBook?>">
                                                        <button style="background-color:rgb(40, 75, 109); color: white; border: none; padding: 5px; width: 30px;display: flex;
                                                            justify-content: space-around; align-items: center;cursor: pointer;">
                                                            <i class="fa-solid fa-eye" style="color: white;"></i>
                                                                
                                                        </button>
                                                    </a>
                                              
                                            </td>
                                        
                                        </tr>
                                        <?php
                                            }}else{
                                                ?>
                                                    <tr>
                                                        <td colspan="6" style="color: red;">No available data</td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                </tbody>
                             </table>
                        </div>

                        <div class="bookstatuscon">
                   

                            <a href="book_status.php?s=<?= 'Pending&c='.$category;?>" style="background-color: rgb(117, 59, 22);">
                                <button>
                                    Pending
                                </button>
                            </a>
                           
                            <a href="book_status.php?s=<?= 'Approved&c='.$category;?>" style="background-color: rgb(117, 59, 22);"
                               >
                                <button>
                                    Approved
                                </button>
                            </a>
                            <a href="book_status.php?s=<?= 'Rejected&c='.$category;?>" style="background-color: rgb(117, 59, 22);"
                               >
                                <button>
                                    Rejected
                                </button>
                            </a>
                            <a href="book_status.php?s=<?= 'Archive&c='.$category;?>" style="background-color: rgb(117, 59, 22);"
                               >
                                <button>
                                    Archive
                                </button>
                            </a>
                          
                        </div>
                      
                </div>

       <div class="confirmPOPUP" id="asd">
        
                
                
                <form method="post" action="../fnc/approved.php">
                    <div class="exsBUTTON">
                        <a href="../science.php?s=<?= $statusofBook?>&c=<?= $category?>"><i class="fa-solid fa-circle-xmark" style="font-size: 25px"></i></a>
                    </div>
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <p>Are you sure you want to</p>
                    <p>approved this book ?</p>
                    <input type="hidden" id="ids" name="ids" value="123">
                     <input type="hidden" name="category" value="<?= $category?>">
                    <div class="button">
                        <button type="submit" name="Cancel" class="Cancel">Cancel</button>
                        <button type="submit" name="Approve" class="Approved">Approve</button>
                    </div>
                </form>
           
        </div>
    </div>

        </article>
        <?php
    
    ?>
    <script src="../../js/navigation.js"></script>
    
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