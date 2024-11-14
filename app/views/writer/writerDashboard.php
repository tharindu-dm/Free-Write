<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <!-- Header Section -->
    <header>
        <h2>Freewrite</h2>
    </header>

    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="/Free-Write/public/images/profile-image.jpg" alt="User Profile">
                <h2><?= htmlspecialchars($writer['name']) ?></h2>
                <p><?= htmlspecialchars($writer['followers']) ?> followers</p>
            </div>

            <!-- Navigation for Writer Options -->
            <nav>
                <a href="/Free-Write/public/Writer/Dashboard">Books</a>
                <a href="/Free-Write/public/Writer/Quotes">Quotes</a>
                <a href="/Free-Write/public/Writer/Spinoffs">Spin-offs</a>
                <a href="/Free-Write/public/Writer/Competitions">Competitions</a>
            </nav>

            <!-- Books Section -->
            <div class="books-section" id="books">
                <h3>Books</h3>

                <!-- Button to Add New Book -->
                <a href="/Free-Write/public/Writer/New" class="button-new">+ New</a>

                <!-- Books List -->
                <div class="books-list">
                    <!--remove this link-->
                    <a href="/Free-Write/public/Writer/BookDetails/1" class="book-item">
                        <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book Cover">
                        <div class="book-info">
                            <h4>Book Title</h4>
                            <p>Published on: 2021-01-01</p>
                        </div>
                    </a>


                    <?php foreach ($books as $book): ?>
                        <div class="book-item">
                            <img src="<?= htmlspecialchars($book['cover_image'] ?? '/public/images/writer/cover.png') ?>" alt="Book Cover">
                            <div class="book-info">
                                <h4><?= htmlspecialchars($book['title']) ?></h4>
                                <p>Published on: <?= htmlspecialchars($book['published_date']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="/public/js/home.js"></script>
</body>

</html>
