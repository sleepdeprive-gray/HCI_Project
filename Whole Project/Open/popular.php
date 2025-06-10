<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Book Room - Popular</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/popular.css">
</head>
<body>

<?php
require 'db.php';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
?>

<div class="sidebar">
  <h1>Book Room</h1>
  <div class="menu">
    <a href="discover.php"><button class="text-btn">Discover</button></a>
    <button class="popular-btn">Popular</button>
    <a href="newrelease.php"><button class="text-btn">New Release</button></a>
  </div>
</div>

<div class="main-content">
  <!-- Search bar -->
  <form method="GET" class="search-bar">
    <input type="text" name="search" placeholder="Search book name, author..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">🔍</button>
  </form>
  <br>

  <div class="container">
    <?php
    // Prepare search query
   $sql = "SELECT books.*, authors_name.name AS author_name 
        FROM books 
        JOIN authors_name ON books.author_id = authors_name.id 
        WHERE books.status = 'Approved' 
        ORDER BY books.downloads DESC";
    if (!empty($search)) {
        $searchSafe = mysqli_real_escape_string($conn, $search);
        $sql .= " AND (title LIKE '%$searchSafe%' OR author_id LIKE '%$searchSafe%')";
    }
    $sql .= " ORDER BY downloads DESC";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0):
        while ($book = mysqli_fetch_assoc($result)):
    ?>
      <a href="view.php?bookID=<?= $book['book_id'] ?>&p=2" class="text-decoration-none text-dark">
        <div class="book mb-4 d-flex">
          <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover" />
          <div class="book-content ms-3">
            <h3><?= htmlspecialchars($book['title']) ?></h3>
            <p><strong>By:</strong> <?= htmlspecialchars($book['author_name']) ?></p>
            <p><?= htmlspecialchars($book['description']) ?></p>
          </div>
        </div>
      </a>
    <?php
        endwhile;
    else:
        echo "<p>No books found matching your search.</p>";
    endif;
    ?>
  </div>
</div>

</body>
</html>