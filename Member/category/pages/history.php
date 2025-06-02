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
    <link rel="stylesheet" href="../css/history.css">
</head>
<body>
<?php
         require '../../db.php';
     
         $id = $_SESSION['ID'];
         $admin_infos = mysqli_query($conn, "SELECT * FROM member_account WHERE memberID = $id");
 
         while ($results = mysqli_fetch_assoc($admin_infos)) {
             
?>
   <div class="sidebar">
        <h1>Book Room</h1>
        <div class="profile">
        <img src="../../images/<?= $results['profile_pic']?>" alt="Profile Picture">
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
            <a href="../../discover.php"> <button class="popular-btn">Discover</button> </a>
            <a href="../../popular.php"><button class="text-btn">Popular</button> </a> 
            <a href="../../newrelease.php"><button class="text-btn">New Release</button> </a> 
            <a href="../../savedbook.php"><button class="text-btn">Saved Books</button> </a>
            <br><br><br><br>
            <a href="../../account.php"><button class="text-btn">Account</button> </a>
            <a href="../../logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="search-bar">
            <input type="text" placeholder="Search book name, author..." />
            <button>🔍</button>
        </div>
        <br> 
        <br>    
       <div class="container-fluid">
        <!-- Categories Section -->
        <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="science.php"> <button type="button" class="btn btn-link">Science</button> </a>
            <a href="novel.php"> <button type="button" class="btn btn-link">Novel</button> </a>
            <a href="mystery.php"> <button type="button" class="btn btn-link">Mystery</button> </a>
            <a href="narrative.php"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="fiction.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <button type="button" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">History</button>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
        
    </div>
    <div class="book-grid">

    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='HISTORY' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_history.php?bookid=<?= $get_BOOKS['bookID']?>">
            <img src="../../images/<?= $get_BOOKS['bookCOVER']?>" alt="Book 1">
            <h4><?= $get_BOOKS['Title']?></h4>
            <p>
                <?php
                    $authorname = $get_BOOKS['authorID'];
                    $selects_the_name = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID= $authorname");
                    while ($name = mysqli_fetch_assoc($selects_the_name)) {
                        echo $name['fname'];
                    }
                ?>
            </p></a>
                </button>
        <?php
            }
            }else {
                ?>
                    <div class="" style=" color:red; font-weight: bold;">
                        NO BOOK POSTED YET 
                    </div>
                <?php
            }
            ?>

        <!-- <div class="book">
            <img src="../../images/archiegreene.jpg" alt="Book 1">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/bringeroflight.jpg" alt="Book 2">
            <h4>Nica</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/darkside.jpg" alt="Book 3">
            <h4>Ivan</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/forgottenshrine.jpg" alt="Book 4">
            <h4>Clarenfe</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/keeperofmyths.jpg" alt="Book 5">
            <h4>Jason</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/lesentremondes.jpg" alt="Book 6">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/projectexodus.jpg" alt="Book 7">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/science.jpg" alt="Book 8">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/secretofvalhalla.jpg" alt="Book 9">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/theconjuresfightofthefallen.jpg" alt="Book 10">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/theelementsoftime.jpg" alt="Book 11">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/theescapers.jpg" alt="Book 12">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/thehouseonhoarderhill.jpg" alt="Book 8">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/theescapers.jpg" alt="Book 9">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/themarvellers.jpg" alt="Book 10">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/theplanet.jpg" alt="Book 11">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/thetenriddlesoftearthquicksmith.jpg" alt="Book 12">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/thethirefoffarrowefell.jpg" alt="Book 12">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div> -->
    </div>

    <?php
         }
    ?>
</body>
</html>