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
    <link rel="stylesheet" href="css/popular.css">
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
            <a href="discover.php"> <button class="text-btn">Discover</button> </a>
            <button class="popular-btn">Popular</button> </a> 
            <a href="newrelease.php"><button class="text-btn">New Release</button> </a> 
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
      
        <div class="container">
            <!-- Book 1 -->
            <div class="book">
              <img src="images/soul.jpg" alt="Soul">
              <div class="book-content">
                <h3>Soul</h3>
                <p>By Olivia Wilson</p>
                <p>The life that Kim and Krickitt Carpenter knew changed completely on November 24, 1993, two months after their wedding, when the back of their car was hit by a speeding pickup truck. A serious head injury left Krickitt in a coma for several weeks. When she finally woke up, part of her memory was compromised and she couldn't remember her husband. She had no idea who he was. Essentially, the "Krickitt" Kim had married died in the accident, and at that moment he needed to win back the woman he loved.</p>
              </div>
            </div>
        
            <!-- Book 2 -->
            <div class="book">
              <img src="images/walk.png" alt="Walk into the Shadow">
              <div class="book-content">
                <h3>Walk into the Shadow</h3>
                <p>By Estelle Darcy</p>
                <p>In a world where shadows whispered secrets and darkness hid truths, the line between reality and the unknown was often blurred. It was in this twilight
                  realm that our story begins, where the ordinary met the extraordinary, and where courage would be tested against the very fabric of fear. </p>
              </div>
            </div>
        
            <!-- Book 3 -->
            <div class="book">
              <img src="images/harry.jpg" alt="Harry Potter and the Cursed Child">
              <div class="book-content">
                <h3>Harry Potter and the Cursed Child</h3>
                <p>By J.K. Rowling, John Tiffany & Jack Thorne</p>
                <p>The plot occurs nineteen years after the events of Rowling's novel Harry Potter and the Deathly Hallows. It follows Albus Severus Potter, the son of Harry Potter, who is now Head of the Department of Magical Law Enforcement at the Ministry of Magic. When Albus arrives at Hogwarts, he gets sorted into Slytherin, and fails to live up to his father's legacy, making him resentful of his father. Rowling has referred to the play as "the eighth Harry Potter story".</p>
              </div>
            </div>
        
            <!-- Book 4 -->
            <div class="book">
              <img src="images/hide.jpg" alt="Hide and Seek">
              <div class="book-content">
                <h3>Hide and Seek</h3>
                <p>By Andrea Mara</p>
                <p>The game of hide and seek is over, everyone has gone home, but little Lily Murphy hasn't been found. Her parents search the woods and tell themselves that the worst hasn't happened - but deep down they know this peaceful Dublin suburb will never be the same again.
                  Years later, Joanna moves into a new house. It seems perfect in every way, until she learns that this was once Lily Murphy's home. </p>
              </div>
            </div>
        
            <!-- Book 5 -->
            <div class="book">
              <img src="images/amillion.jpg" alt="A Million to One">
              <div class="book-content">
                <h3>A Million to One</h3>
                <p>By Tony Faggioli</p>
                <p>Faggioli’s latest novel (A Million to One) offers out-of-this-world encounters as well as earthly chills. New players, several who are in danger and one who’s a monster, join the series’ original characters. The scary newbie is Troy “The Bread Man” Forester, a psychopathic torturer and serial killer in the tradition of Hannibal Lecter.</p>
              </div>
            </div>
        
            <!-- Book 6 -->
            <div class="book">
              <img src="images/dontlook.jpg" alt="Don't Look Back">
              <div class="book-content">
                <h3>Don't Look Back</h3>
                <p>By Achut Deng and Keely Hutton</p>
                <p>After a deadly attack in South Sudan left six-year-old Achut Deng without a family, she lived in refugee camps for ten years, until a refugee relocation program gave her the opportunity to move to the United States. When asked why she should be given a chance to leave the camp, Achut simply told the interviewer: I want life.</p>
              </div>
            </div>

             <!-- Book 7 -->
             <div class="book">
              <img src="images/funnystory.jpg" alt="Don't Look Back">
              <div class="book-content">
                <h3>Funny Story</h3>
                <p>By Emily Henry</p>
                <p>Daphne always loved the way her fiancé, Peter, told their story. How they met (on a blustery day), fell in love (over an errant hat), and moved back to his lakeside hometown to begin their life together. He really was good at telling it... right up until the moment he realized he was actually in love with his childhood best friend Petra.
                </p>
              </div>
            </div>

            <!-- Book 8 -->
            <div class="book">
              <img src="images/thewomen.jpg" alt="Don't Look Back">
              <div class="book-content">
                <h3>The Women</h3>
                <p>By Kristin Hannah</p>
                <p>Women can be heroes. When twenty-year-old nursing student Frances “Frankie” McGrath hears these words, it is a revelation. Raised in the sun-drenched, idyllic world of Southern California and sheltered by her conservative parents, she has always prided herself on doing the right thing. But in 1965, the world is changing, and she suddenly dares to imagine a different future for herself.</p>
              </div>
            </div>

             <!-- Book 9 -->
             <div class="book">
              <img src="images/firstliewins.jpg" alt="Don't Look Back">
              <div class="book-content">
                <h3>First Lie Wins</h3>
                <p>By Ashley Elston</p>
                <p>Evie Porter has everything a nice, Southern girl could want: a perfect, doting boyfriend, a house with a white picket fence and a garden, a fancy group of friends. The only catch: Evie Porter doesn’t exist.</p>
              </div>
            </div>

             <!-- Book 10 -->
             <div class="book">
              <img src="images/theteacher.jpg" alt="Don't Look Back">
              <div class="book-content">
                <h3>The Teacher</h3>
                <p>By Freida McFadden</p>
                <p>Eve has a good life. She gets up each day, gets a kiss from her husband Nate, and heads off to teach math at the local high school. All is as it should be.Last year, Caseham High was rocked by a scandal involving a student-teacher affair, with one student, Addie, at its center. But Eve knows there is far more to these ugly rumors than meets the eye.</p>
              </div>
            </div>

        </div>
        
    </div>
<?php
         }
?>
</body>
</html>
