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
    <link rel="stylesheet" href="../css/science.css">
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
                <button type="button" class="btn btn-link" style="font-weight: bold; font-size:large; margin-top: -4px">Science</button>
            <a href="novel.php"> <button type="button" class="btn btn-link">Novel</button> </a>
            <a href="mystery.php"> <button type="button" class="btn btn-link">Mystery</button> </a>
            <a href="narrative.php"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="fiction.php"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="history.php"> <button type="button" class="btn btn-link">History</button> </a>
            <a href="fantasy.php"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
        
    </div>

    
    <div class="book-grid">
    <?php
        $SELECTS_ALL_SCIENCE_BOOK = mysqli_query($conn, "SELECT * FROM books WHERE category ='SCIENCE' AND status= 'available'");
        if(mysqli_num_rows($SELECTS_ALL_SCIENCE_BOOK) > 0){
        while ($get_BOOKS = mysqli_fetch_assoc($SELECTS_ALL_SCIENCE_BOOK) ) {
            # code...
       
    ?>
        <button class="book"><a href="../pages/view_science.php?bookid=<?= $get_BOOKS['bookID']?>">
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
            </p>
            </a>
        </button>
        <?php
            }
            }else {
                echo "asda";
            }
            ?>

        <!-- <div class="book">
            <img src="../../images/archiegreene.jpg" alt="Book 1">
            <h4>Archie Green</h4>
            <p>D.D. Everest</p>
        </div>
        <div class="book">
            <img src="../../images/bringeroflight.jpg" alt="Book 2">
            <h4>Bringer of Light</h4>
            <p>Justin M. Stone</p>
        </div>
        <div class="book">
            <img src="../../images/darkside.jpg" alt="Book 3">
            <h4>Dark Side</h4>
            <p>Nica Ilang Ilang</p>
        </div>
        <div class="book">
            <img src="../../images/forgottenshrine.jpg" alt="Book 4">
            <h4>Forgotten the Shrine</h4>
            <p>Monica Tesler</p>
        </div>
        <div class="book">
            <img src="../../images/keeperofmyths.jpg" alt="Book 5">
            <h4>Keeper of Myths</h4>
            <p>Jasmine Richards</p>
        </div>
        <div class="book">
            <img src="../../images/lesentremondes.jpg" alt="Book 6">
            <h4>Les Entremondes</h4>
            <p>Sean Easley</p>
        </div>
        <div class="book">
            <img src="../../images/projectexodus.jpg" alt="Book 7">
            <h4>Project Exodus</h4>
            <p>Jesse Gerlach</p>
        </div>
        <div class="book">
            <img src="../../images/science.jpg" alt="Book 8">
            <h4>Science</h4>
            <p>Sarah Duterte</p>
        </div>
        <div class="book">
            <img src="../../images/secretofvalhalla.jpg" alt="Book 9">
            <h4>Secret of Salvalhalla</h4>
            <p>Jasmine Richards</p>
        </div>
        <div class="book">
            <img src="../../images/theconjuresfightofthefallen.jpg" alt="Book 10">
            <h4>The Conjures Tight of the Fallen</h4>
            <p>Brian Andersen</p>
        </div>
        <div class="book">
            <img src="../../images/theelementsoftime.jpg" alt="Book 11">
            <h4>The Elements of Time</h4>
            <p>Sam Paisley</p>
        </div>
        <div class="book">
            <img src="../../images/theescapers.jpg" alt="Book 12">
            <h4>The Escapers</h4>
            <p>L.J Monahan</p>
        </div>
        <div class="book">
            <img src="../../images/thehouseonhoarderhill.jpg" alt="Book 8">
            <h4>The House on Hoarder Hill </h4>
            <p>Miski Lish</p>
        </div>
        <div class="book">
            <img src="../../images/theescapers.jpg" alt="Book 9">
            <h4>Nicole</h4>
            <p>Archie Greene</p>
        </div>
        <div class="book">
            <img src="../../images/themarvellers.jpg" alt="Book 10">
            <h4>The Marvellers</h4>
            <p>Dhionelle Clayton</p>
        </div>
        <div class="book">
            <img src="../../images/theplanet.jpg" alt="Book 11">
            <h4>The  Planet</h4>
            <p>J Swift</p>
        </div>
        <div class="book">
            <img src="../../images/thetenriddlesoftearthquicksmith.jpg" alt="Book 12">
            <h4>The Ten Riddles of EarthQuickSmith</h4>
            <p>Loris Owen</p>
        </div>
        <div class="book">
            <img src="../../images/thethirefoffarrowefell.jpg" alt="Book 12">
            <h4>The Thief of Farrowfell</h4>
            <p>Ravena Guron</p>
        </div> -->
    </div>
            
    <?php
         }
    ?>
</body>
</html>