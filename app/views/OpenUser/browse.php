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
    //show($data);
    ?>

    <!-- Page Title -->
    <div id="title">
        <h1>Browse Books</h1>
    </div>

    <div class="browse-main-container">
        <!-- Ad image -->
        <?php if ((isset($_SESSION['user_premium']) && $_SESSION['user_premium'] == 0) || !isset($_SESSION['user_id'])): ?>
            <div>
                <img src="/Free-Write/public/images/ad.png" alt="Ad" class="ad-image">
            </div>
        <?php endif; ?>

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
                <?php foreach ($data as $categoryVar => $books): ?>
                    <?php
                    // Convert camelCase to Title Case for section title
                    $sectionTitle = ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2', $categoryVar));
                    ?>
                    <section class="book-category">
                        <h2><?= htmlspecialchars($sectionTitle); ?></h2>
                        <div class="book-grid">
                            <?php if (!empty($books) && is_array($books)): ?>
                                <?php foreach ($books as $book): ?>
                                    <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                        <div class="book-card">
                                            <img src="../app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                                            <h3>
                                                <?= strlen($book['title']) > 20 ? htmlspecialchars(substr($book['title'], 0, 17)) . '...' : htmlspecialchars($book['title']); ?>
                                            </h3>
                                            <p><?= htmlspecialchars($book['author']); ?></p>
                                            <h4>
                                                <?= $book['price'] === null || $book['price'] === '' ? 'FREE' : 'LKR ' . number_format($book['price'], 2); ?>
                                            </h4>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No books available.</p>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </section>
        </main>

        <!-- Ad image -->
        <?php if ((isset($_SESSION['user_premium']) && $_SESSION['user_premium'] == 0) || !isset($_SESSION['user_id'])): ?>
            <div>
                <img src="/Free-Write/public/images/ad.png" alt="Ad" class="ad-image">
            </div>
        <?php endif; ?>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="../public/js/browse.js"></script>
</body>

</html>