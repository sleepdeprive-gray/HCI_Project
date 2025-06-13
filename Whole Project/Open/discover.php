<?php
    require 'db.php';
    require 'includes/get_book_of_the_day.php';
    require 'includes/get_new_releases.php';
    require 'includes/get_famous_authors.php';

    $bookOfTheDay = getBookOfTheDay($conn);
    $newReleases = getNewReleases($conn);
    $famousAuthors = getFamousAuthors($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover | Book Room</title>
    <link rel="shortcut icon" href="../images/weblogo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/discover.css">
</head>
<body>

    <header class="logo-and-title">
      <a href="../Website/guest.php" style ="text-decoration: none;">
        <h2>Book<br><span style="color: #A1BE95;">Room</span></h2>
      </a>
        <img src="../images/weblogo.png" alt="book room logo">
    </header>


    <div class="sidebar">
        <div class="menu">
            <button class="discover-btn">Discover</button>
            <a href="popular.php"><button class="text-btn">Popular</button></a>
            <a href="newrelease.php"><button class="text-btn">New Release</button></a>
        </div>
    </div>

    <div class="main-content"> 
        <div class="categories-container">
            <div class="categories d-flex flex-wrap justify-content-center gap-3 mt-4">
                <?php
                    $genres = ["Science", "Novel", "Mystery", "Narrative", "Fiction", "History", "Fantasy"];
                    foreach ($genres as $genre):
                ?>
                    <a href="category/pages/books.php?genre=<?= urlencode($genre) ?>">
                        <button class="btn btn-link"><?= htmlspecialchars($genre) ?></button>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <h1 class="mt-4" style="font-size: 35px;">Recommendations</h1>
        <?php if ($bookOfTheDay): ?>
            <div class="BOOKoftheDay d-flex">
                <div class="TwoBook">
                    <img src="data:image/jpeg;base64,<?= base64_encode($bookOfTheDay['back_cover']) ?>" class="Pic1" alt="Back Cover">
                    <img src="data:image/jpeg;base64,<?= base64_encode($bookOfTheDay['front_cover']) ?>" class="Pic2" alt="Front Cover">
                </div>

                <div class="sCon">
                    <div class="texts">
                        <h2>
                            <a href="view.php?bookID=<?= $bookOfTheDay['book_id'] ?>&p=1" style="text-decoration: none; color: black;">
                                <?= htmlspecialchars($bookOfTheDay['title']) ?>
                            </a>
                        </h2>
                        <p><?= htmlspecialchars($bookOfTheDay['author_name']) ?></p>
                        <p style="font-size: 13px;">
                            <?= htmlspecialchars(mb_substr($bookOfTheDay['description'], 0, 350)) ?>
                            <?= strlen($bookOfTheDay['description']) > 150 ? '...' : '' ?>
                        </p>
                    </div>
                    <div class="foot">Genre: <?= htmlspecialchars($bookOfTheDay['genre']) ?></div>
                </div>
            </div>
        <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>

        <br>
            <h2 style="font-size: 19px;">New Release</h2>
        <br>

        <div class="newCon">
            <div class="booksCon">
                <?php foreach (array_slice($newReleases, 0, 5) as $book): ?>
                    <a href="view.php?bookID=<?= $book['book_id'] ?>&p=1" style="text-decoration: none; color: inherit;">
                        <div class="imgs">
                            <img src="data:image/jpeg;base64,<?= base64_encode($book['front_cover']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
                            <p class="title">
                                <?= htmlspecialchars(mb_substr($book['title'], 0, 15)) ?>
                                <?= htmlspecialchars ($book['title'] > 5 ? '...' : '' ) ?>
                            </p>
                            <p class="author"><?= htmlspecialchars($book['author_name']) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="famous">
                <h3>Famous Authors</h3>
                <?php foreach ($famousAuthors as $author): ?>
                    <div class="imgFam">
                        <?php if (!empty($author['author_photo'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($author['author_photo']) ?>" alt="<?= htmlspecialchars($author['author_name']) ?>">
                        <?php else: ?>
                            <img src="../images/default.jpg" alt="Default Author Photo">
                        <?php endif; ?>
                        <div class="det">
                            <p class="name"><?= htmlspecialchars($author['author_name']) ?></p>
                            <p><?= $author['book_count'] ?> books</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>
</html>