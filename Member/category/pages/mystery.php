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

    
    <div class="main-content">
        <div class="search-bar">
            <input type="text" placeholder="Search book name, author..." />
            <button>🔍</button>
        </div>
        <br> 
        <br>    
       <div class="container-fluid">
        
        <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="science.php"> <button type="button" class="btn btn-link">Science</button> </a>
            <a href="novel.php"> <button type="button" class="btn btn-link">Novel</button> </a>
            <button type="php" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">Mystery</button>
            <a href="narrative.php"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="fiction.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="history.php"> <button type="button" class="btn btn-link">History</button> </a>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
        
    </div>
    <div class="book-grid">

    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='MYSTERY' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_mystery.php?bookid=<?= $get_BOOKS['bookID']?>">
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
            <img src="../../images/biglittleloies.jpg" alt="Book 1">
            <h4>Big Little Lies</h4>
            <p>Liane Moriarty</p>
        </div>
        <div class="book">
            <img src="../../images/deadmed.jpg" alt="Book 2">
            <h4>Dead Med</h4>
            <p>Freida McFadden</p>
        </div>
        <div class="book">
            <img src="../../images/hideanddont.jpg" alt="Book 3">
            <h4>Hide and Don't</h4>
            <p>Anica Mrose  Riss</p>
        </div>
        <div class="book">
            <img src="../../images/murderontheorientexpress.jpg" alt="Book 4">
            <h4>Muderer on the Orient Express</h4>
            <p>Agatha Chistic</p>
        </div>
        <div class="book">
            <img src="../../images/tellmewhatreallyhappened'.jpg" alt="Book 5">
            <h4>Tell me what really happened</h4>
            <p>Chelsea Sedot</p>
        </div>
        <div class="book">
            <img src="../../images/thebloodedbwetwennus.jpg" alt="Book 6">
            <h4>The Blood Between us</h4>
            <p>Zax Brewer</p>
        </div>
        <div class="book">
            <img src="../../images/aconjuringoflight.jpg" alt="Book 7">
            <h4>A Conjuring of Light</h4>
            <p>V.EC SCHEWAB</p>
        </div>
        <div class="book">
            <img src="../../images/allofusvillians.jpg" alt="Book 8">
            <h4>All of us Villians</h4>
            <p>Amanda  Food</p>
        </div>
        <div class="book">
            <img src="../../images/aspeedoflies.jpg" alt="Book 9">
            <h4>At the Speed of Lies</h4>
            <p>Cindy Otis</p>
        </div>
        <div class="book">
            <img src="../../images/goodgirlsdiefirst.jpg" alt="Book 10">
            <h4>Good Girl Die First</h4>
            <p>Kathryn Foxfield</p>
        </div>
        <div class="book">
            <img src="../../images/iknowyoudidit.jpg" alt="Book 11">
            <h4>I know you did it</h4>
            <p>Sue Wallman/p>
        </div>
        <div class="book">
            <img src="../../images/itshouldhavebeenme.jpg" alt="Book 12">
            <h4>It should have been  me</h4>
            <p>Susan Wilkins</p>
        </div>
        <div class="book">
            <img src="../../images/nowseeme.jpg" alt="Book 8">
            <h4>Now  you see me</h4>
            <p>Chris McGeroge</p>
        </div>
        <div class="book">
            <img src="roomservice.jpg" alt="Book 9">
            <h4>Room Service</h4>
            <p>Maren Storfels</p>
        </div>
        <div class="book">
            <img src="../../images/theappointment.jpg" alt="Book 10">
            <h4>The Appoinment</h4>
            <p>Dylan Young</p>
        </div>
        <div class="book">
            <img src="../../images/thegirldragontattoo.jpg" alt="Book 11">
            <h4>The Girl with thr Dragon Tattoo</h4>
            <p>Daniel Craig</p>
        </div>
        <div class="book">
            <img src="../../images/thesilentpatient.jpg" alt="Book 12">
            <h4>The SIlent Patient</h4>
            <p>Alex Michaelides</p>
        </div>
        <div class="book">
            <img src="../../images/thewomaninwhite.jpg" alt="Book 13">
            <h4>The Woman in White</h4>
            <p>Colines</p>
        </div> -->
    </div>
    <?php
         }
    ?>
</body>
</html>