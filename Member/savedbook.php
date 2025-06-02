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
    <link rel="stylesheet" href="css/savedbook.css">
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
            <a href="newrelease.php"><button class="text-btn">New Release</button> </a> 
            <button class="savedbook-btn">Saved Books</button> 
            <br><br><br><br>
            <a href="account.php"><button class="text-btn">Account</button> </a>
            <a href="logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="header">
            <br>
          
            <h1>SAVED BOOKS</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search book name, author..." />
                <button>🔍</button>
            </div>
        </div>

        
       <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Categories</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                      include 'member_function/removeSAVEDbooks.php';
                    $selectsALLsaveBooks = mysqli_query($conn, "SELECT * FROM `books` 
                    LEFT JOIN save_book on books.bookID = save_book.savedBookID 
                    WHERE save_book.memberID = $id");

                    while ($bookSAVED = mysqli_fetch_assoc($selectsALLsaveBooks)) {
                    
                    
                ?>
                <tr>
                    <td><?= $bookSAVED['Title']?></td>
                    <td><?= $bookSAVED['category']?></td>
                    <td>
                        <form action="" method="post">
                            <input type="number" name="nums" id="" value="<?= $bookSAVED['savedBookID']?>" hidden>
                            <button type="submit" class="remove-btn" name="remove">Remove</button>
                        </form>
                   </td>
                </tr>
              <?php
                    }
              ?>
            </tbody>
        </table>
    </div>
</div>
<?php
         }
?>
</body>
</html>
