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
    <link rel="stylesheet" href="../css/mystery.css">
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
            <button type="button" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">Narrative</button>
            <a href="fiction.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="history.php"> <button type="button" class="btn btn-link">History</button> </a>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
        
    </div>
    <div class="book-grid">

    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='NARRATIVE' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_narrative.php?bookid=<?= $get_BOOKS['bookID']?>">
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
                echo "asda";
            }
            ?>

        <!-- <div class="book">
            <img src="../../images/herbodyandotherparty.jpg" alt="Book 1">
            <h4>Her Body and other Parties</h4>
            <p>Carmen Machado</p>
        </div>
        <div class="book">
            <img src="../../images/letspretend.jpg" alt="Book 2">
            <h4>Let's Pretend tgis Never Happened</h4>
            <p>Jenny Lawson</p>
        </div>
        <div class="book">
            <img src="../../images/tess.jpg" alt="Book 3">
            <h4>Tess</h4>
            <p>Thomas Hardy</p>
        </div>
        <div class="book">
            <img src="../../images/thecrucible.jpg" alt="Book 4">
            <h4>The Crucible</h4>
            <p>Arthur Miller</p>
        </div>
        <div class="book">
            <img src="darkkmatter.jpg" alt="Book 5">
            <h4>Dark Matter</h4>
            <p>Wayward Pinks</p>
        </div>
        <div class="book">
            <img src="iam.jpg" alt="Book 6">
            <h4>I am</h4>
            <p>Maggie O'Farrell</p>
        </div>
        <div class="book">
            <img src="lincoln.jpg" alt="Book 7">
            <h4>Lincoln in the Bardo</h4>
            <p>George Saunders</p>
        </div>
        <div class="book">
            <img src="theplague.jpg" alt="Book 8">
            <h4>The Plague</p></h4>
            <p>Albert Camus</p>
        </div>
        <div class="book">
            <img src="thereafymadde.jpg" alt="Book 9">
            <h4>The Ready Made</h4>
            <p>Augustus Rose</p>
        </div>
        <div class="book">
            <img src="thestranger.jpg" alt="Book 10">
            <h4>The Stranger</h4>
            <p>Albert Camus</p>
        </div>
        <div class="book">
            <img src="thestranger2.jpg" alt="Book 11">
            <h4>The Stranger</h4>
            <p>Albert Camus</p>
        </div>
        <div class="book">
            <img src="thestranger3.jpg" alt="Book 12">
            <h4>The Stranger</h4>
            <p>Albert Camus</p>
        </div>
        <div class="book">
            <img src="tyll.jpg" alt="Book 8">
            <h4>Tyll</h4>
            <p>Daniel Kehlmann</p>
        </div>
        <div class="book">
            <img src="winterpeople.jpg" alt="Book 9">
            <h4>Winter People</h4>
            <p>Jennifer McMahon</p>
        </div>
        <div class="book">
            <img src="thestangers1.jpg" alt="Book 10">
            <h4>The Stranger</h4>
            <p>Albert Camus</p>
        </div>
        <div class="book">
            <img src="theplanet.jpg" alt="Book 11">
            <h4>The Planet</h4>
            <p>Archie Smith</p>
        </div>
        <div class="book">
            <img src="thetenriddlesoftearthquicksmith.jpg" alt="Book 12">
            <h4>The Earquickksmith</h4>
            <p>Archie Daniel</p>
        </div>
        <div class="book">
            <img src="thethirefoffarrowefell.jpg" alt="Book 12">
            <h4>The Thire of Farrowfell</h4>
            <p>Archie Salazar</p>
        </div> -->
    </div>
    <?php
         }
    ?>
</body>
</html>