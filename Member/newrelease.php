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
    <link rel="stylesheet" href="css/newrelease.css">
</head>
<body>
<?php
         require 'db.php';
     
         $id = $_SESSION['ID'];
         $admin_infos = mysqli_query($conn, "SELECT * FROM member_account WHERE memberID = $id");
 
         while ($results = mysqli_fetch_assoc($admin_infos)) {
             
?>
    <div class="sidebar">
        <h1>Book Room</h1>
        <div class="profile">
        <img src="images/<?= $results['profile_pic']?>" alt="Profile Picture">
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
            <a href="discover.php"><button class="text-btn">Discover</button></a>
            <a href="popular.php"><button class="text-btn">Popular</button> </a> 
            <button class="newrelease-btn">New Release</button>
            <a href="savedbook.php"><button class="text-btn">Saved Books</button> </a>
            <br><br><br><br>
            <a href="account.php"><button class="text-btn">Account</button> </a>
            <a href="logout.php"><button class="logout">Logout</button></a>
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

        
       
        <div class="container">
          <!-- Book 1 -->
          <?php
          $dateOFpublished = mysqli_query($conn, "SELECT *, YEAR(date_published) AS year
          , MONTH(date_published) AS month
          FROM books;");
         //echo "Number of BOOKS  :".mysqli_num_rows($dateOFpublished)."<br>";
          while ($dates = mysqli_fetch_assoc($dateOFpublished)) {
            $currentMONTH = date('m');
            $currentYEAR = date('Y');
      
            $month = $dates['month'];
            $year = $dates['year'];
          

            


            if($currentMONTH == $month && $currentYEAR == $year){
              // echo "ITO LANG UNG LALABAS"."<br>";
              // echo $dates['Title']."  YEAR : ".$dates['year']." MONTH : ".$dates['month']."<br>";
           
          // echo "Current Month : ".date('m')."<br>";
          // echo "Current Year  : ".date('Y')."<br>";
          // echo "Curent DAY   : ".date('d');

         
        ?>
        <a href="view.php?bookID=<?=$dates['bookID']?>">
            <div class="book">
              <img src="images/<?=$dates['bookCOVER']?>" alt="Soul">
              <div class="book-content">
                <h3><?= $dates['Title'];?></h3>
            
                <p><?php
                $authorID = $dates['authorID'];
                 $selectBook = mysqli_query($conn, "SELECT fname FROM author_account WHERE authorID = $authorID");

                 while ($names = mysqli_fetch_assoc($selectBook)) {
                  echo $names['fname'];
                 }
                ?></p>
              
                <p><?= $dates['About'];?></p>
                
              </div>
                </div>
                </a>
           <?php
            }
            }
           ?>
      
          <!-- Book 2 -->
          <!-- <div class="book">
            <img src="images/thefury.jpg" alt="Walk into the Shadow">
            <div class="book-content">
              <h3>The Fury</h3>
              <p>By Alex Michaelides</p>
              <p>A masterfully paced thriller about a reclusive ex–movie star and her famous friends whose spontaneous trip to a private Greek island is upended by a murder ― from the #1 New York Times bestselling author of The Silent Patient.</p>
            </div>
          </div> -->
      
          <!-- Book 3 -->
          <!-- <div class="book">
            <img src="images/daydream.jpg" alt="Harry Potter and the Cursed Child">
            <div class="book-content">
              <h3>Daydream</h3>
              <p>By Hannah Grace</p>
              <p>When his procrastination lands him in a difficult class with his least favorite professor, Henry Turner knows he’s going to have to work extra hard to survive his junior year of college. And now with his new title of captain for the hockey team—which he didn’t even want—Henry absolutely cannot fail. Enter Halle Jacobs, a fellow junior who finds herself befriended by Henry when he accidentally crashes her book club.</p>
            </div>
          </div> -->
      
          <!-- Book 4 -->
          <!-- <div class="book">
            <img src="images/ladymacbeth.jpg" alt="Hide and Seek">
            <div class="book-content">
              <h3>Lady Macbeth</h3>
              <p>By Ava Reid</p>
              <p>From #1 New York Times bestselling author Ava Reid comes a reimagining of Lady Macbeth, Shakespeare’s most famous villainess, giving her a voice, a past, and a power that transforms the story men have written for her.</p>
            </div>
          </div>
       -->
          <!-- Book 5 -->
          <!-- <div class="book">
            <img src="images/wildlove.jpg" alt="A Million to One">
            <div class="book-content">
              <h3>Wild Love</h3>
              <p>By Elsie Silver</p>
              <p>Forbes may have labeled Ford Grant the World's Hottest Billionaire, but all he cares about is escaping the press and opening a recording studio in gorgeous small town Rose Hill. Something that comes to a screeching halt when he ends up face-to-face with a young girl who claims he's her biological father. </p>
            </div>
          </div> -->
      
          <!-- Book 6 -->
          <!-- <div class="book">
            <img src="images/thespellshop.jpg" alt="Don't Look Back">
            <div class="book-content">
              <h3>The Spell Shop</h3>
              <p>By Sarah Beth Durst</p>
              <p>Kiela has always had trouble dealing with people. Thankfully, as a librarian at the Great Library of Alyssium, she and her assistant, Caz—a magically sentient spider plant—have spent the last decade sequestered among the empire’s most precious spellbooks, preserving their magic for the city’s elite.</p>
            </div>
          </div> -->

           <!-- Book 7 -->
           <!-- <div class="book">
            <img src="images/reckless.jpg" alt="Don't Look Back">
            <div class="book-content">
              <h3>Reckless</h3>
              <p>By Lauren Roberts</p>
              <p>After surviving the Purging Trials, Ordinary-born Paedyn Gray has killed the King, and kickstarted a Resistance throughout the land. Now she’s running from the one person she had wanted to run to.Kai Azer is now Ilya’s Enforcer, loyal to his brother Kitt, the new King. He has vowed to find Paedyn and bring her to justice.</p>
            </div>
          </div> -->

          <!-- Book 8 -->
          <!-- <div class="book">
            <img src="images/faebound.jpg" alt="Don't Look Back">
            <div class="book-content">
              <h3>Faebound</h3>
              <p>By Saara El-Arifi</p>
              <p>Yeeran is a warrior in the elven army and has known nothing but violence her whole life. Her sister, Lettle, is trying to make a living as a diviner, seeking prophecies of a better future.When a fatal mistake leads to Yeeran’s exile from the Elven lands, they are both forced into the terrifying wilderness beyond their borders. There they encounter the the fae court.</p>
            </div>
          </div> -->

           <!-- Book 9 -->
           <!-- <div class="book">
            <img src="images/therulebook.jpg" alt="Don't Look Back">
            <div class="book-content">
              <h3>The Rule Book</h3>
              <p>By Sarah Adams</p>
              <p>Nora Mackenzie’s entire career lies in the hands of famous NFL tight end Derek Pender, who happens to be her extremely hot college ex-boyfriend. Nora didn’t end things as gracefully as she could have back then, and now it has come back to haunt her. Derek is her first client as an official full-time sports agent, and he’s holding a grudge.</p>
            </div>
          </div> -->

           <!-- Book 10 -->
           <!-- <div class="book">
            <img src="images/thebookofdoors.jpg" alt="Don't Look Back">
            <div class="book-content">
              <h3>The Book of Doors</h3>
              <p>By Gareth Brown</p>
              <p>In New York City, bookseller Cassie Andrews is living an unassuming life when she is given a gift by a favourite customer. It's a book - an unusual book, full of strange writing and mysterious drawings. And at the very front there is a handwritten message to Cassie, telling her that this is the Book of Doors, and that any door is every door.</p>
            </div>
          </div> -->
      </div>
        
    </div>
    <?php
         }
    ?>
</body>
</html>