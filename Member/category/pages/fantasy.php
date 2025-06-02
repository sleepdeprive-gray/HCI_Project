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
    <link rel="stylesheet" href="../css/fantasy.css">
</head>
<body>
<?php
         require '../../../db.php';
     
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
        <a href="../../discover.php"><button class="discover-btn">Discover</button>
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
          <a href="science.php"> <button class="btn btn-link">Science</button></a>
            <a href="novel.php"> <button type="button" class="btn btn-link">Novel</button> </a>
            <a href="mystery.php"> <button type="button" class="btn btn-link">Mystery</button> </a>
            <a href="narrative.php"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="fiction.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="history.php"> <button type="button" class="btn btn-link">History</button> </a>
            <button type="button" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">Fantasy</button> 
        </div>
        
    </div>
    <div class="book-grid">
    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='FANTASY' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_fantasy.php?bookid=<?= $get_BOOKS['bookID']?>">
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
            <img src="../../images/breakout.jpg" alt="Book 1">
            <h4>Breakout</h4>
            <p>Kaplan</p>
        </div>
        <div class="book">
            <img src="../../images/era.jpg" alt="Book 2">
            <h4>Sera</h4>
            <p>Martin</p>
        </div>
        <div class="book">
            <img src="../../images/misfitcity.jpg" alt="Book 3">
            <h4>Misfit City</h4>
            <p>Smith</p>
        </div>
        <div class="book">
            <img src="../../images/runaways.jpg" alt="Book 4">
            <h4>Runaways</h4>
            <p>Jenifer</p>
        </div>
        <div class="book">
            <img src="../../images/theimmortaldinner.jpg" alt="Book 5">
            <h4>The Immortal Dinner</h4>
            <p>Penelope-Hallett</p>
        </div>
        <div class="book">
            <img src="../../images/thethroneinthesky.jpg" alt="Book 6">
            <h4>The Throne in the Sky</h4>
            <p>WYND</p>
        </div>
        <div class="book">
            <img src="../../images/thwhousewitch.jpg" alt="Book 7">
            <h4>The House Witch</h4>
            <p>Delemhach</p>
        </div>
        <div class="book">
            <img src="../../images/alandcalledtarot.jpg" alt="Book 8">
            <h4>A Called Tarot</h4>
            <p>Gael Bertrand</p>
        </div>
        <div class="book">
            <img src="../../images/beastlands.jpg" alt="Book 9">
            <h4>Beastlands</h4>
            <p>Curtis Clow</p>
        </div>
        <div class="book">
            <img src="../../images/folklords.jpg" alt="Book 10">
            <h4>Folklords</h4>
            <p>Matt Smith</p>
        </div>
        <div class="book">
            <img src="../../images/ghosted.jpg" alt="Book 11">
            <h4>Ghosted in L.A</h4>
            <p>Cathy Lie</p>
        </div>
        <div class="book">
            <img src="../../images/gothamacademy.jpg" alt="Book 12">
            <h4>Gotham Academy</h4>
            <p>Fletcher</p>
        </div>
        <div class="book">
            <img src="../../images/jeanot.jpg" alt="Book 8">
            <h4>Jeannot</h4>
            <p>Jeremy Reyes</p>
        </div>
        <div class="book">
            <img src="../../images/skyward.jpg" alt="Book 9">
            <h4>Skyward</h4>
            <p>Bowland</p>
        </div>
        <div class="book">
            <img src="../../images/spector inspector.jpg" alt="Book 10">
            <h4>Specter Inspectors</h4>
            <p>Bowen McCurdy</p>
        </div>
        <div class="book">
            <img src="../../images/thelasthope.jpg" alt="Book 11">
            <h4>The Last Hope School</h4>
            <p>Nickie Preto</p>
        </div>
        <div class="book">
            <img src="../../images/thesirens.jpg" alt="Book 12">
            <h4>The Sirens</h4>
            <p>Jacquillin De leon </p>
        </div>
        <div class="book">
            <img src="../../images/theunderwoodtapes.jpg" alt="Book 12">
            <h4>The Underwood Tapes</h4>
            <p>Amanda Dewitt</p>
        </div> -->
    </div>
    <?php
         }
    ?>
</body>
</html>