
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/discover.css">
</head>
<body>
<?php
         require 'db.php';
             
    ?>
    <div class="sidebar">
        <h1>Book Room</h1>
        <img src="../images/weblogo.png" alt="Website Logo" height="100px" wi>
        <div class="menu">
            <button class="discover-btn">Discover</button>
            <a href="popular.php"><button class="text-btn">Popular</button> </a> 
            <a href="newrelease.php"><button class="text-btn">New Release</button> </a> 
        </div>
    </div>

    
    <div class="main-content"> 
       <div class="categories-container">
        <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="category/pages/books.php?genre=Science"> <button type="button" class="btn btn-link">Science</button> </a>
            <a href="category/pages/books.php?genre=Novel"> <button class="btn btn-link">Novel</button> </a>
            <a href="category/pages/books.php?genre=Mystery"> <button type="button" class="btn btn-link">Mystery</button> </a>
            <a href="category/pages/books.php?genre=Narrative"> <button type="button" class="btn btn-link">Narrative</button> </a>
            <a href="category/pages/books.php?genre=Fiction"> <button type="button" class="btn btn-link">Fiction</button> </a>
            <a href="category/pages/books.php?genre=History"> <button type="button" class="btn btn-link">History</button> </a>
            <a href="category/pages/books.php?genre=Fantasy"> <button type="button" class="btn btn-link">Fantasy</button> </a>
        </div>
       </div>
       <h1 style="color: black; font-size: 35px;">Book of the Day</h1>


       <div class="BOOKoftheDay">
            <div class="TwoBook">
                <img src="images/backcover.png" alt="" class="Pic1">
                <img src="images/frontcover.png" alt="" class="Pic2">
            </div>

            <div class="sCon">
                <div class="texts">
                    <h1 style="font-size: 30px;">IT ENDS WITH US</h1>
                    <p style="padding: 2px; margin-top: -10px;">Novel by Colleen Hoover</p>
                    <p style="font-size: 13px; padding: 2px;">
                        It Ends with Us is a book that follows a girl named Lily who has just moved and is 
                        ready to start her life after college. Lily then meets a guy named Ryle and she falls for 
                        him. As she is developing feelings for Ryle, Atlas, her first love, reappears and challenges 
                        the relationship between Lily and Ryle.
                    </p>
                </div>
                <div class="foot">
                    Genre: Romance Novel
                    
                </div>
            </div>
       </div>

       <h2 style="color: black; font-size: 19px; ">New Release</h2>  <br>
       <div class="newCon">
        <div class="booksCon">
            <div class="imgs">
                <img src="images/demoninthewood.jpg" alt="">
                <p class="title">Demon in the Hood</p>
                <p class="author">Leigh Bardugo</p>
            </div>
            <div class="imgs">
                <img src="images/ifweweregiants.jpg" alt="">
                <p class="title">If We Were Giants</p>
                <p class="author">Dave Matthews</p>
            </div>
            <div class="imgs">
                <img src="images/thebrigdehome.jpg" alt="">
                <p class="title">The Bridge Home</p>
                <p class="author">Padma Venkatraman</p>
            </div>
            <div class="imgs">
                <img src="images/thelostedruid.jpg" alt="">
                <p class="title">The Lost Druid</p>
                <p class="author">Aetherra</p>
            </div>
            <div class="imgs">
                <img src="images/imagineme.jpg" alt="">
                <p class="title">Imagine Me</p>
                <p class="author">Tahereh Mafi</p>
            </div>
           
           
        </div>
        <br>
        <div class="famous">
            <h3>Famous Authors</h3>
            <div class="imgFam">
                <img src="images/fam1.jpg" alt="">
                <div class="det">
                    <p class="name">Rico Yan</p>
                    <p>100 books</p>
                </div>
            </div>
            <div class="imgFam">
                <img src="images/fam2.jpg" alt="">
                <div class="det">
                    <p class="name">Jam Villanueva</p>
                    <p>100 books</p>
                </div>
            </div>
            <div class="imgFam">
                <img src="images/fam3.jpg" alt="">
                <div class="det">
                    <p class="name">Maris Racal</p>
                    <p>100 books</p>
                </div>
            </div>
        </div>
       </div>
    </div>
    <?php
        //  }
    ?>
</body>
</html>