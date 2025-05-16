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
            <img src="../images/<?php echo $results['profile_pic'] ?>" alt="">
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
                    <a href="../accounts/accounts_all.php"><button><i class="fa-solid fa-user" style="margin-right: 10px;"></i>Accounts</button></a>
                    <button class="Active"><i class="fa-solid fa-book" style="margin-right: 10px;"></i>Books</button>
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
                    <p>BOOKS</p>
                </div>
            </div>
                <div class="" style="width: 90%; height: 500px;position: relative;background-color: #6A9C89; display: flex;margin: 5px;justify-self: center; padding: 10px; display: flex; flex-direction: column;
                flex-wrap: wrap; ">
                     
                        
                        <!-- SEARCH BAR -->
                        <div class="" style="display: flex; justify-content: space-between;">
                            <div class="">   
                                <p style="font-weight: bold; color:white">HISTORY BOOK</p>
                            </div>
                            <div class="" style=" justify-content: end; display: flex;">
                                <i class="fa-solid fa-microphone" style="display: flex; align-items: center; display: flex;"></i>
                                <input placeholder="Search for title or Author... " type="text" style="height: 20px;align-self: center; width: 180px; margin-left: 10px;">
                            </div>
                                
                        </div>
                        
                        <!-- SORTING AND CATEGORY -->
                        <div class="" style="display: flex; justify-content: space-between;">
                            
                            <!-- SORTING OPTION -->
                            <form method="POST" class="" style="display: flex;">
                                <p style="font-weight: bold; color: white;">Sort</p>
                                <select name="orderBY" id="" onchange="this.form.submit()" 
                                style="color: white; margin-left: 10px; height: 30px; background-color: #3c554c; border: none;
                                display: flex;align-self: center;">
                                    <option value="<?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "";} ?>"><?php if(isset($_POST['orderBY'])){echo $_POST['orderBY'];}else{echo "Select";} ?></option>
                                    <option value="book_id">Book ID</option>
                                    <option value="title">Title</option>
                                    <option value="author_id">Author</option>
                                    <option value="Highest">Highest downloaded books</option>
                                    <option value="Lowest">Lowest downloaded books</option>
                                </select>
                            </form>

                            <!-- CATEGORY -->
                             <ol style="display: flex; color: white; font-weight: bold; gap: 40px;margin-right: 10px;">
                                <ul style="color:black">Category :</ul>
                                <a href="science.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Science</ul></a>
                                <a href="novel.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Novel</ul></a>
                                <a href="mystery.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Mystery</ul></a>
                                <a href="narrative.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Narrative</ul></a>
                                <a href="fiction.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Fiction</ul></a>
                                <a href="history.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">History</ul></a>
                                <a href="fantasy.php" style="text-decoration: none; color: white;"><ul style="padding: 0; cursor: pointer;">Fantasy</ul></a>
                             </ol>

                             <!-- CATEGORY WHEN THE SCREEN IS SMALL -->
                             <div class="category-in-selection-mode" style="display: none;">
                                <p>Category</p>
                                <select name="" id="linkSelect" onchange="navigateToLink()" style="color: white; margin-left: 10px; height: 30px; background-color: #3c554c; border: none;
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
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= 'History' ORDER BY $oderBY");
                                    }elseif($_POST['orderBY'] == "Highest"){
                                         $oderBY = 'downloads';
                                          $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= 'History' ORDER BY $oderBY DESC");
                                    }elseif ($_POST['orderBY'] == "Lowest") {
                                        $oderBY = 'downloads';
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= 'History' ORDER BY $oderBY ASC");
                                    }
                                    }else{
                                         $selects_logs = mysqli_query($conn, "SELECT * FROM books WHERE `genre`= 'History' ORDER BY author_id");
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
                                                    <!-- REJECT BUTTON -->
                                                    <?php
                                                        if($recent_logs['status'] == "Approved" || $recent_logs['status'] == "Archive" || $recent_logs['status'] == "Rejected" ){
                                                            
                                                            ?>

                                                               
                                                                
                                                                <button style="background-color: gray; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                                                    justify-content: space-around; align-items: center;cursor:not-allowed;"
                                                                     onclick="alert('You cannot Reject an Archive one')">
                                                                        <i class="fa-solid fa-square-check"></i>
                                                                        Reject
                                                                     
                                                                </button>
                                                      
                                                           
                                                          
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a href="fnc/pending.php?book=<?= $recent_logs['book_id']; ?>">
                                                                <button style="background-color: maroon; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                                                    justify-content: space-around; align-items: center;cursor: pointer;">
                                                                        <i class="fa-solid fa-circle-xmark"></i>
                                                                        Reject
                                                                </button>
                                                            </a>
                                                            <?php
                                                        }
                                                    ?>
                                                
                                                    <!-- ARCHIVE AND APPROVED  BUTTON -->
                                                    <?php
                                                        if($recent_logs['status'] == "Pending"){
                                                            
                                                            ?>

                                                               
                                                                
                                                                <button style="background-color: #3c554c; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                                                    justify-content: space-around; align-items: center;cursor: pointer;"
                                                                    data-id="<?= $recent_logs['book_id']; ?>" data-name="Clarence" onclick="handleClick(
                                                                    this.getAttribute('data-id'))">
                                                                        <i class="fa-solid fa-square-check"></i>
                                                                        Approved
                                                                     
                                                                </button>
                                                      
                                                           
                                                          
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <a href="fnc/pending.php?book=<?= $recent_logs['book_id']; ?>">
                                                                <button style="background-color: red; color: white; border: none; padding: 5px; width: 80px;display: flex;
                                                                    justify-content: space-around; align-items: center;cursor: pointer;">
                                                                        <i class="fa-solid fa-circle-xmark"></i>
                                                                        Archive
                                                                </button>
                                                            </a>
                                                            <?php
                                                        }
                                                    ?>

                                                    <!-- VIEW BUTTON -->
                                                    <a href="view-book/view.php?book=<?= $recent_logs['book_id']; ?>">
                                                        <button style="background-color:rgb(40, 75, 109); color: white; border: none; padding: 5px; width: 30px;display: flex;
                                                            justify-content: space-around; align-items: center;cursor: pointer;">
                                                            <i class="fa-solid fa-eye"></i>
                                                                
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

                        <div class="" style="display: flex; justify-content:end; align-items:center">
                            <p style="margin-right:10px; font-weight:bold">Book status: </p>

                            <a href="book-status/book_status.php?s=<?= 'Pending&c=History';?>"
                                style="margin-left: 10px;background-color: #3c554c; align-items: center; border-radius: 10px; display:flex; justify-content:center;box-shadow:5px 5px 5px rgba(0,0,0,0.8)">
                                <button style="width: 100%; border: none;background-color: transparent; color: white; cursor: pointer; padding:10px; ">
                                    Pending
                                </button>
                            </a>
                            <a href="book-status/book_status.php?s=<?= 'Approved&c=History';?>"
                                style="margin-left: 10px;background-color: #3c554c; align-items: center; border-radius: 10px; display:flex; justify-content:center;box-shadow:5px 5px 5px rgba(0,0,0,0.8)">
                                <button style="width: 100%; border: none;background-color: transparent; color: white; cursor: pointer; padding:10px;">
                                    Approved
                                </button>
                            </a>
                            <a href="book-status/book_status.php?s=<?= 'Rejected&c=History';?>"
                                style="margin-left: 10px;background-color: #3c554c; align-items: center; border-radius: 10px; display:flex; justify-content:center;box-shadow:5px 5px 5px rgba(0,0,0,0.8)">
                                <button style="width: 100%; border: none;background-color: transparent; color: white; cursor: pointer; padding:10px;">
                                    Rejected
                                </button>
                            </a>
                            <a href="book-status/book_status.php?s=<?= 'Archive&c=History';?>"
                                style="margin-left: 10px;background-color: #3c554c; align-items: center; border-radius: 10px; display:flex; justify-content:center;box-shadow:5px 5px 5px rgba(0,0,0,0.8)">
                                <button style="width: 100%; border: none;background-color: transparent; color: white; cursor: pointer; padding:10px;">
                                    Archive
                                </button>
                            </a>
                          
                        </div>
                      
                </div>

       <div class="asd" id="asd" style="width:100%;height:100vh; top:0; left:0;
         position:absolute; display:none; justify-content:center;align-items:center;
          font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color:rgba(0, 0, 0, 0.7);">
        
                
                
                <form method="post" action="fnc/approved.php" class="" style="display: flex; flex-direction:column; justify-content:center; align-items:center; width: 35%;height:300px; background-color:white; padding:10px">
                    <div class="" style="display: flex;justify-content:end; width:100%;margin-top:-40px; margin-bottom:20px">
                        <i class="fa-solid fa-circle-xmark" style="font-size: 25px"></i>
                    </div>
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 70px;"></i>
                    <p>Are you sure you want to</p>
                    <p>approved this book ?</p>
                    <input type="hidden" id="ids" name="ids" value="123">
                    <div class="" style="display: flex; width: 80%;justify-content:space-around">
                        <button type="submit" name="Cancel" style="border:none; padding:5px; background-color:brown; color:white; width:100px">Cancel</button>
                        <button type="submit" name="Approve" style="border:none; padding:5px; background-color:green; color:white; width:100px">Approve</button>
                    </div>
                </form>
           
        </div>
    </div>

        </article>
        <?php
    
    ?>

    
    <script>
       
    function navigateToLink() {
      const select = document.getElementById('linkSelect');
      const url = select.value;
      if (url) {
        window.location.href = url; // Redirects to the selected URL
      }
    }
     function handleClick(dataId,dataName) {
    document.getElementById("asd").style.display = "flex";

     const ids = document.getElementById("ids").value = dataId;


    
        console.log(ids);
  
   
    // Add your logic here
  }

  </script>
<?php  
}
?>
</body>
</html>