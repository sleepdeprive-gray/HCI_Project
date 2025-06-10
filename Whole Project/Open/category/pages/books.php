<?php
session_start();
require '../../db.php';

$BOOKgenre = $_GET['genre'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Room</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/science.css"/>
</head>
<body>

<div class="sidebar">
  <h1>Book Room</h1>
  <div class="menu">
    <a href="../../discover.php"><button class="popular-btn">Discover</button></a>
    <a href="../../popular.php"><button class="text-btn">Popular</button></a>
    <a href="../../newrelease.php"><button class="text-btn">New Release</button></a>
  </div>
</div>

<!-- Main Content Area -->
<div class="main-content">
  <div class="search-bar">
    <input type="text" placeholder="Search book name, author..." />
    <button>🔍</button>
  </div>

  <br><br>

  <div class="container-fluid">
    <!-- Categories Section -->
    <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
      <a href="books.php?genre=Science"><button type="button" class="btn btn-link fw-bold fs-5">Science</button></a>
      <a href="books.php?genre=Novel"><button type="button" class="btn btn-link">Novel</button></a>
      <a href="books.php?genre=Mystery"><button type="button" class="btn btn-link">Mystery</button></a>
      <a href="books.php?genre=Narrative"><button type="button" class="btn btn-link">Narrative</button></a>
      <a href="books.php?genre=Fiction"><button type="button" class="btn btn-link">Fiction</button></a>
      <a href="books.php?genre=History"><button type="button" class="btn btn-link">History</button></a>
      <a href="books.php?genre=Fantasy"><button type="button" class="btn btn-link">Fantasy</button></a>
    </div>
  </div>

  <!-- Books Grid -->
  <div class="book-grid">
    <?php
    $query = mysqli_query($conn, "SELECT * FROM books WHERE genre = '$BOOKgenre' AND status = 'Approved'");

    if (mysqli_num_rows($query) > 0) {
      while ($book = mysqli_fetch_assoc($query)) {
        $editorId = $book['editor_id'];
        $editorNameQuery = mysqli_query($conn, "SELECT first_name FROM users WHERE user_id = $editorId");
        $editorName = mysqli_fetch_assoc($editorNameQuery)['first_name'] ?? 'Unknown';
    ?>
      <button class="book">
        <a href="../../view.php?bookID=<?= $book['book_id'] ?>&genre=<?= $book['genre'] ?>">
          <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover" />
          <h4><?= htmlspecialchars($book['title']) ?></h4>
          <p><?= htmlspecialchars($editorName) ?></p>
        </a>
      </button>
    <?php
      }
    } else {
      echo "<p class='text-center mt-5'>No available books for this genre.</p>";
    }
    ?>
  </div>
</div>

</body>
</html>