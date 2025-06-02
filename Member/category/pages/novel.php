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
    <link rel="stylesheet" href="../css/novel.css">
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
            <button type="button" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">Novel</button>
            <a href="mystery.php"> <button type="button" class="btn btn-link">Mystery</button> </a>
            <a href="narrative.php"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="history.php"> <button type="button" class="btn btn-link">History</button> </a>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
        
    </div>
    <div class="book-grid">
    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='NOVEL' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_novel.php?bookid=<?= $get_BOOKS['bookID']?>">
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
            }
            ?>
        <!-- <div class="book">
            <img src="../../images/thegoldfinch.jpg" alt="Book 1">
            <h4>The GoldFinch</h4>
            <p>Donna Tartt</p>
        </div>
        <div class="book">
            <img src="../../images/theroad.jpg" alt="Book 2">
            <h4>The Road</h4>
            <p>McCarthy</p>
        </div>
        <div class="book">
            <img src="../../images/thepainofbeingwoman.jpg" alt="Book 3">
            <h4>The Pain of Being Woman</h4>
            <p>Eugene Kennedy</p>
        </div>
        <div class="book">
            <img src="../../images/alonewithyou.jpg" alt="Book 4">
            <h4>Alone with you in the Ether</h4>
            <p>Olivie Blake</p>
        </div>
        <div class="book">
            <img src="../../images/theperks.jpg" alt="Book 5">
            <h4>The Perks of being a Wallflower</h4>
            <p>Stephen Chbosky</p>
        </div>
        <div class="book">
            <img src="thegreatgatsby.jpg" alt="Book 6">
            <h4>The Great Gatsby</h4>
            <p>F-Scott-FitzGerald</p>
        </div>
        <div class="book">
            <img src="prideandprejudice.jpg" alt="Book 7">
            <h4>Pride and Prejudice</h4>
            <p>Jane Austin</p>
        </div>
        <div class="book">
            <img src="theurge.jpg" alt="Book 8">
            <h4>The Urge</h4>
            <p>Carl  Erik Fisher</p>
        </div>
        <div class="book">
            <img src="fiftybeaststobreakyourheart.jpg" alt="Book 9">
            <h4>Fifty Beasts of Break your Heart </h4>
            <p>Gennarose Nethercott</p>
        </div>
        <div class="book">
            <img src="moby.jpg" alt="Book 10">
            <h4>Moby-Dick</h4>
            <p>Herman Melville</p>
        </div>
        <div class="book">
            <img src="lestexplorediabeteswithowls.jpg" alt="Book 11">
            <h4>Let's Explore Diabetes with Owls</h4>
            <p>David Sedaris</p>
        </div>
        <div class="book">
            <img src="wutheringheightsd.jpg" alt="Book 12">
            <h4>Wuthering Heights</h4>
            <p>Emily Bronte</p>
        </div>
        <div class="book">
            <img src="oneday.jpg" alt="Book 8">
            <h4>One Day</h4>
            <p>David Nicholls</p>
        </div>
        <div class="book">
            <img src="adeliciouslife.jpg" alt="Book 9">
            <h4>A Delicious Life</h4>
            <p>Nell Stevens</p>
        </div>
        <div class="book">
            <img src="thesecrethistory.jpg" alt="Book 10">
            <h4>The Secret History</h4>
            <p>Donna Tartt</p>
        </div>
        <div class="book">
            <img src="invisibility.jpg" alt="Book 11">
            <h4>invisibility</h4>
            <p>Steve Richard</p>
        </div>
        <div class="book">
            <img src="crimeandpunishment.jpg" alt="Book 12">
            <h4>Crime and Punishment</h4>
            <p>Michael Katz</p>
        </div>
        <div class="book">
            <img src="normalpeople.jpg" alt="Book 12">
            <h4>Normal People</h4>
            <p>Sally Rooney</p>
        </div> -->
    </div>

    <?php
         }
    ?>
</body>
</html>