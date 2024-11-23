<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/browse.css">
</head>

<body>
    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <!-- Page Title -->
    <div id="title">
        <h1>Browse Books</h1>
    </div>

    <div class="browse-main-container">
        <!-- Ad image -->
        <div>
            <img src="../public/images/ad.png" alt="Ad" class="ad-image">
        </div>

        <main>
            <section class="browse-body-section">
                <!-- Search Bar Section -->
                <section class="search-section">
                    <form action="/Free-Write/public/Browse/search" method="GET">
                        <input type="text" id="search-bar" name="bookName" placeholder="Search books..." />
                        <button type="submit" id="search-btn">Search</button>
                    </form>
                </section>

                <!-- Book Categories -->
                <section class="book-category">
                    <h2>Freewrite Originals For You</h2>
                    <div class="book-grid">

                        <?php if (!empty($FWObooks) && is_array($FWObooks)): ?>
                            <?php foreach ($FWObooks as $book): ?>
                                <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                    <div class="book-card">
                                        <img src="../public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">

                                        <h3>
                                            <?= strlen($book['title']) > 20 ? htmlspecialchars(substr($book['title'], 0, 17)) . '...' : htmlspecialchars($book['title']); ?>
                                        </h3>
                                        <p>
                                            <?= htmlspecialchars($book['author']); ?>
                                        </p>
                                        <h4>
                                            <?= $book['price'] === null ? 'FREE' : 'LKR ' . number_format($book['price'], 2); ?>
                                        </h4>
                                    </div>
                                </a>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <p>No books available.</p>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="book-category">
                    <h2>Top Paid Books</h2>
                    <div class="book-grid">
                        <?php if (!empty($paidBooks) && is_array($paidBooks)): ?>
                            <?php foreach ($paidBooks as $pbook): ?>
                                <div class="book-card">
                                    <img src="../public/images/<?= htmlspecialchars($pbook['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                        alt="Cover Image of <?= htmlspecialchars($pbook['title']); ?>">

                                    <h3>
                                        <?= strlen($pbook['title']) > 20 ? htmlspecialchars(substr($pbook['title'], 0, 17)) . '...' : htmlspecialchars($pbook['title']); ?>
                                    </h3>
                                    <p> <?= htmlspecialchars($pbook['author']); ?></p>
                                    <h4><?= $pbook['price'] === null ? 'FREE' : 'LKR ' . number_format($pbook['price'], 2); ?>
                                    </h4>
                                    <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($pbook['bookID']); ?>">
                                        <button class="select-book-btn"
                                            data-id="<?= htmlspecialchars($pbook['bookID']); ?>">Select Book</button>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <p>No books available.</p>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="book-category">
                    <h2>Who Will Be Left Standing?</h2>
                    <div class="book-grid">
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Heartless">
                            <h3>Heartless</h3>
                            <p>Romance</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="GroundBound">
                            <h3>GroundBound</h3>
                            <p>Horror</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Comatose">
                            <h3>Comatose</h3>
                            <p>Psychology</p>
                        </div>

                    </div>
                </section>
            </section>
        </main>

        <!-- Ad image -->
        <div>
            <img src="../public/images/ad.png" alt="Ad" class="ad-image">
        </div>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="../public/js/browse.js"></script>
</body>

</html>