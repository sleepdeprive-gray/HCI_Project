<?php
session_start();
require '../../db.php';

$BOOKgenre = $_GET['genre'] ?? '';
$searchTerm = $_GET['search'] ?? '';

// Escape values to prevent SQL injection
$escapedGenre = mysqli_real_escape_string($conn, $BOOKgenre);
$escapedSearch = mysqli_real_escape_string($conn, $searchTerm);
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

<header class="logo-and-title">
  <h2>Book<br><span style="color: #BB5C22;">Room</span></h2>
  <img src="../../../images/weblogo.png" alt="book room logo">
</header>

<div class="sidebar">
  <div class="menu">
    <a href="../../discover.php"><button class="text-btn">Discover</button></a>
    <a href="../../popular.php"><button class="text-btn">Popular</button></a>
    <a href="../../newrelease.php"><button class="text-btn">New Release</button></a>
  </div>
</div>

<!-- Main Content Area -->
<div class="main-content">
  <form method="GET" class="search-bar">
    <input type="hidden" name="genre" value="<?= htmlspecialchars($BOOKgenre) ?>">
    <img id="mic" src="../../../icons/microphone-icon.png" alt="Voice Search" height="25px" style="cursor: pointer;">
    <input type="text" name="search" value="<?= htmlspecialchars($searchTerm) ?>" placeholder="Search book name, author..." />
    <button type="submit">🔍</button>
  </form>

  <br>

  <div class="container-fluid">
    <!-- Categories Section -->
    <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
      <?php
      $genreQuery = mysqli_query($conn, "SELECT DISTINCT genre FROM books WHERE genre IS NOT NULL AND genre != '' ORDER BY genre ASC");
      while ($genreRow = mysqli_fetch_assoc($genreQuery)) {
        $genre = htmlspecialchars($genreRow['genre']);
        $isActive = ($BOOKgenre === $genre) ? 'fw-bold fs-5' : '';
        echo "<a href='books.php?genre=" . urlencode($genre) . "'>
                <button type='button' class='btn btn-link $isActive'>$genre</button>
              </a>";
      }
      ?>
    </div>
  </div>

  <!-- Books Grid -->
  <div class="book-grid">
    <?php
    $query = "
      SELECT books.*, authors.author_name 
      FROM books 
      LEFT JOIN authors ON books.author_id = authors.author_id 
      WHERE books.genre = '$escapedGenre' 
      AND books.status = 'Approved'
    ";

    if (!empty($escapedSearch)) {
      $query .= " AND (
        books.title LIKE '%$escapedSearch%' OR 
        authors.author_name LIKE '%$escapedSearch%'
      )";
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($book = mysqli_fetch_assoc($result)) {
        $editorId = $book['editor_id'];
        $editorNameQuery = mysqli_query($conn, "SELECT first_name FROM users WHERE user_id = $editorId");
        $editorName = mysqli_fetch_assoc($editorNameQuery)['first_name'] ?? 'Unknown';
    ?>
      <button class="book">
        <a href="../../view.php?bookID=<?= $book['book_id'] ?>&genre=<?= urlencode($book['genre']) ?>&p=4">
          <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="Book Cover" />
          <h4><?= htmlspecialchars($book['title']) ?></h4>
          <p><?= htmlspecialchars($book['author_name']) ?></p>
        </a>
      </button>
    <?php
      }
    } else {
      echo "<p class='text-center mt-5'>No available books found.</p>";
    }
    ?>
  </div>
</div>

<script src="../../js/voice-search.js"></script>

</body>
</html>