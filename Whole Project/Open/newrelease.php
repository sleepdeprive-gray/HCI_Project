<?php
  session_start();
  require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Room - New Releases</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/newrelease.css" />
</head>
<body>
  <div class="sidebar">
    <h1>Book Room</h1>
    <div class="menu">
      <a href="discover.php"><button class="text-btn">Discover</button></a>
      <a href="popular.php"><button class="text-btn">Popular</button></a> 
      <button class="newrelease-btn">New Release</button>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="main-content">
    <form method="GET" class="search-bar">
      <img id="mic" src="../icons/microphone-icon.png" alt="Voice Search" height="25px" style="cursor: pointer;">
      <input type="text" id="searchInput" name="search" placeholder="Search book name, author..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <button type="submit">🔍</button>
    </form>
    
    <br><br>

    <div class="container">
      <?php
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $currentMonth = date('n'); // 1-12 (no leading zero)
        $currentYear = date('Y');

        $sql = "SELECT books.*, authors.author_name, 
                YEAR(books.date_published) AS year, 
                MONTH(books.date_published) AS month 
                FROM books 
                JOIN authors ON books.author_id = authors.author_id 
                WHERE books.status = 'Approved' 
                AND YEAR(books.date_published) = $currentYear 
                AND MONTH(books.date_published) = $currentMonth";

        if (!empty($search)) {
          $safeSearch = mysqli_real_escape_string($conn, $search);
          $sql .= " AND (books.title LIKE '%$safeSearch%' OR authors.author_name LIKE '%$safeSearch%')";
        }

        $sql .= " ORDER BY books.date_published DESC";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0):
          while ($book = mysqli_fetch_assoc($result)):
      ?>
        <a href="view.php?bookID=<?= $book['book_id'] ?>&p=3" class="text-decoration-none text-dark">
          <div class="book mb-4 d-flex">
            <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover" style="height: 150px; width: auto;">
            <div class="book-content ms-3">
              <h3><?= htmlspecialchars($book['title']) ?></h3>
              <p><strong>By:</strong> <?= htmlspecialchars($book['author_name']) ?></p>
              <p><?= htmlspecialchars(mb_strimwidth($book['description'], 0, 250, '...')) ?></p>
            </div>
          </div>
        </a>
      <?php
          endwhile;
        else:
          echo "<p>No books found for this month's release.</p>";
        endif;
      ?>
    </div>
  </div>

<script src="js/voice-search.js"></script>
  
</body>
</html>
