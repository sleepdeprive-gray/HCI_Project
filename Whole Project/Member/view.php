<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor | Book Room</title>

    <!-- Icon Import -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!--Web Icon-->
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">

    <!--CSS Stylesheets-->
    <link rel="stylesheet" href="css/bg-and-nav.css">
    <link rel="stylesheet" href="css/book-view.css">

</head>
<body>
    <!--Logo and Title -->
    <header class ="logo-and-title">
        <img src="../images/weblogo.png" alt="book room logo">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
    </header>
    <?php
         require 'db.php';

        //  $id = $_SESSION['user_id'];
        //  $admin_infos = mysqli_query($conn, "SELECT * FROM member_account WHERE memberID = $id");
 
        //  while ($results = mysqli_fetch_assoc($admin_infos)) {
             
    ?>
    <!-- Navigations Panel-->
    <div class="sidebar">
        <h1>Book Room</h1>
        <div class="profile">
            <img src="images/sarahduterte.jpeg" alt="Profile Picture">
            <!-- <img src="images/<?= $results['profile_pic']?>" alt="Profile Picture"> -->
            <h2>Sarah duterte</h2>
            <!-- <h2><?= $results['fname']?></h2> -->
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
            <a href="newrelease.php"><button class="text-btn">Discover</button> </a> 
            <a href="popular.php"><button <?php if($_GET['p'] == '2'){echo 'class="discover-btn"';}elseif ($_GET['p'] == '3') {echo 'class="text-btn"';} ?>>Popular</button> </a> 
            <a href="newrelease.php"><button <?php if($_GET['p'] == '2'){echo 'class="text-btn"';}elseif ($_GET['p'] == '3') {echo 'class="discover-btn"';} ?>>New Release</button></a>
            <a href="savedbook.php"><button class="text-btn">Saved Books</button> </a>
            <br><br><br><br>
            <a href="account.php"><button class="text-btn">Account</button> </a>
            <a href="logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!--
    
        Main Content
        - Upper Content (Book Picture, Name, Title, Back Button)
        - Left Details (Description)
        - right Details (Author, Language, Date Published)
    
                    -->
    <?php
    $bookID = $_GET['bookID'];
    $view_the_selected_book = mysqli_query($conn, "SELECT * FROM books WHERE book_id = $bookID");
        while ($bookINFO = mysqli_fetch_assoc($view_the_selected_book)) {
            # code...
    
    ?>
    <div class="content-part">
        <div class="upper-content">
            <img src="data:image/jpeg;base64, <?=base64_encode($bookINFO['front_cover'])?>" />
            <div class="title-and-author">
                <h1><?= $bookINFO['title']?></h1>
                <h4><?php
                // $authorID = $bookINFO['authorID'];
                // $selectBook = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorID");

                // while ($names = mysqli_fetch_assoc($selectBook)) {
                //  echo $names['fname'];
                // }
                ?></h4>
            </div>
            <a href="<?php switch ($_GET['p']) {
                case 2:
                    echo "popular";
                    break;
                case 3:
                    echo "newrelease";
                    break;
                default:
                    # code...
                    break;
            }?>.php">
                <button>Back</button>
            </a>
        </div>
        <div class="section-bg">
            <div class="divider"></div>
            <div class="details-part">  
                <div class="left-details">
                    <h4>Description</h4>
                    <p>
                   <?= $bookINFO['description']?>
                   
                    </p>
                </div>
                <div class="right-details">
                    <h4>Editor</h4>
                    <p><?php
                    $authorID = $bookINFO['editor_id'];
                    $selectBook = mysqli_query($conn, "SELECT first_name FROM users WHERE user_id= $authorID");
    
                    while ($names = mysqli_fetch_assoc($selectBook)) {
                     echo $names['first_name'];
                    }
                    ?></p>
                    <h4>Language</h4>
                    <p><?= $bookINFO['language']?></p>
                    <h4>Date Published</h4>
                    <p><?= $bookINFO['date_published']?></p>
                  
                   <a href="../Member/member_function/savebook.php?id=1&bookid=<?= $_GET['bookID']?>&p=<?= $_GET['p']?>">
                   <button style="background-color: #A1BE95; width:200px; height:50px; color:aliceblue; font-weight:bold">SAVE BOOK</button>
                   </a>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    // }
    ?>
</body>
</html>