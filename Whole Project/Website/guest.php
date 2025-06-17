<?php
  require '../process/database_connection.php';

  $booksQuery = "SELECT COUNT(*) as totalBooks FROM books WHERE status = 'Approved'";
  $booksResult = mysqli_query($conn, $booksQuery);
  $booksData = mysqli_fetch_assoc($booksResult);
  $totalBooks = $booksData['totalBooks'];

  $editorsQuery = "SELECT COUNT(*) as totalEditors FROM users WHERE user_type = 'Editor'";
  $editorsResult = mysqli_query($conn, $editorsQuery);
  $editorsData = mysqli_fetch_assoc($editorsResult);
  $totalEditors = $editorsData['totalEditors'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Room</title>
  <link rel="icon" href="../images/weblogo.png" type="image/x-icon">
  <link rel="stylesheet" href="guest.css">
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar">
    <div class="left-nav">
      <ul class="nav-links">
        <li><a href="../Guest/login.php">Editor</a></li>
      </ul>
    </div>
    <div class="right-nav">
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#about-section">About Us</a></li>
        <li><a href="#categories1">Top Editors</a></li>
      </ul>
    </div>
  </nav>

 <!-- Hero Section -->
<section id="hero">
  <div class="logo-container">
    <img src="bookroomlogo.png" alt="BookRoom Logo">
  </div>
  <div class="hero-content">
    <a href="../Open/discover.php" class="cta-button">Download Books Now!</a>
  </div>
</section>

  <!-- Top Categories Section -->
  <section id="categories">
  <div class="container">
    <h1>Book Categories</h1>
    <h2>CURRENT CATEGORIES</h2>
    <div class="categories">
      <div class="category">
        <img src="../images/novel.jpg" alt="Book Icon">
        <p>Novel</p>
      </div>
      <div class="category">
        <img src="../images/history.jpg" alt="Book Icon">
        <p>History</p>
      </div>
      <div class="category">
        <img src="../images/fiction.jpg" alt="Book Icon">
        <p>Fiction</p>
      </div>
      <div class="category">
        <img src="../images/science.jpg" alt="Book Icon">
        <p>Science</p>
      </div>
      <div class="category">
        <img src="../images/narrative.jpg" alt="Book Icon">
        <p>Narrative</p>
      </div>
      <div class="category">
        <img src="../images/fantasy.jpg" alt="Book Icon">
        <p>Fantasy</p>
      </div>
      <div class="category">
        <img src="../images/mystery.jpg" alt="Book Icon">
        <p>Mystery</p>
      </div>
    </div>
    <!-- <a href="#hero" class="home-button">Home</a> -->
  </div>
  </section>
  
    <!-- About Section -->
  <section id="about-section" class="about-section">
    <div class="content">
      <h3>About Us</h3>
      <h1>AN ONLINE BOOK LIBRARY</h1>
      <p class="highlight">Design of the book library is very user friendly and easy to use</p>
      <p class="description">
        Our online library features a user-friendly design that ensures easy navigation and accessibility for all users.With an intuitive layout and organized categories, finding and borrowing books is seamless and efficient.Whether you're searching for a specific title or exploring new genres, our platform is designed to enhance <br> your reading experience.
      </p>
      <div class="stats" 
          data-books="<?= $totalBooks ?>" 
          data-editors="<?= $totalEditors ?>">
        <div>
          <h2 id="totalBooks">0</h2>
          <p>All books</p>
        </div>
        <div>
          <h2 id="totalEditors">0</h2>
          <p>Editors</p>
        </div>
      </div>
    </div>
    <div class="image-container">
      <img src="about.jpg" alt="Online Library Illustration">
    </div>
  </section>

   <!-- Top Editors Section -->
   <section id="categories1">
    <div class="container1">
      <h2>Top Editors</h2>
      <div class="categories1">
        <div class="category1">
          <img src="stephen.png" alt="Book Icon">
          <p>Stephen King</p>
        </div>
        <div class="category1">
          <img src="J.K Rowling.png" alt="Book Icon">
          <p>J.K Rowling</p>
        </div>
        <div class="category1">
          <img src="John Ronald Reuel Tolkien.png" alt="Book Icon">
          <p>John Ronald Reuel Tolkien</p>
        </div>
        <div class="category1">
          <img src="George Orwell.png" alt="Book Icon">
          <p>George Orwell</p>
        </div>
        <div class="category1">
          <img src="Agatha Christie.png" alt="Book Icon">
          <p>Agatha Christie </p>
        </div>
        <div class="category1">
          <img src="Charles Dickens.png" alt="Book Icon">
          <p>Charles Dickens</p>
        </div>
        <div class="category1">
          <img src="William Shakespeare.png" alt="Book Icon">
          <p>William Shakespeare</p>
        </div>
      </div>
      <div class="contact-section">
        <h2>Contact Us</h2>
        <p>Get in touch with us.</p>
          <form method="post" action="submit_feedback.php">
            <input type="text" name="name" required placeholder="Your Name">
            <input type="email" name="email" required placeholder="Your Email">
            <textarea name="message" required placeholder="Your Message"></textarea>
            <button class="cta-button">Send Message</button>
          </form>
      </div>
    </div>
  </section><br> <br>

  <!-- Footer Section -->
  <footer>
    <div class="images">
      <div>
        <img src="location.png" alt="Location Icon" width="24" height="24">
        <p>Amundsen-Scott Station</p>
      </div>
      <div>
        <img src="gmail.png" alt="Email Icon" width="24" height="24">
        <p>BookRoom@gmail.com</p>
      </div>
      <div>
        <img src="call.png" alt="Phone Icon" width="24" height="24">
        <p>01223452986</p>
      </div>
    </div>
    <p>2024 BookRoom. All rights reserved.</p>
  </footer>

  <script>
  function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    let startTimestamp = null;
    const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      obj.textContent = Math.floor(progress * (end - start) + start);
      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    };
    window.requestAnimationFrame(step);
  }

  window.addEventListener('DOMContentLoaded', () => {
    const stats = document.querySelector('.stats');
    const books = parseInt(stats.dataset.books);
    const editors = parseInt(stats.dataset.editors);

    animateValue('totalBooks', 0, books, 1500);   // 1.5 seconds
    animateValue('totalEditors', 0, editors, 1500);
  });
</script>

</body>
</html>
