<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/browse.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";

    ?>

    <div id="title">
        <h1>Browse Masterpieces</h1>
    </div>

    <div class="browse-main-container">

        <?php include "../app/views/layout/advertisement.php"; ?>

        <main>
            <section class="browse-body-section">

                <section class="search-section">
                    <form action="/Free-Write/public/Browse/search" method="GET">
                        <div class="search-container">
                            <select id="search-type" name="searchType" aria-label="Search type">
                                <option value="book">Book</option>
                                <option value="spinoff">Spinoff</option>
                                <option value="covers">Design</option>
                                <option value="user">User</option>
                                <option value="writer">Author</option>
                                <option value="covdes">Cover Designer</option>
                                <option value="pub">Publisher</option>
                            </select>
                            <input type="text" id="search-bar" name="itemName" placeholder="Search..."
                                aria-label="Search query" />
                            <button type="submit" id="search-btn" aria-label="Search">
                                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                Search
                            </button>
                        </div>
                    </form>
                </section>


                <?php foreach ($data as $categoryVar => $books): ?>
                    <?php
                    $sectionTitle = ucwords(preg_replace('/([a-z])([A-Z])/', '$1 $2', $categoryVar));
                    ?>
                    <section class="book-category">
                        <h2><?= htmlspecialchars($sectionTitle); ?></h2>
                        <div class="book-grid">
                            <?php if (!empty($books) && is_array($books)): ?>
                                <?php foreach ($books as $book): ?>
                                    <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                        <div class="book-card">
                                            <img src="../app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.png'); ?>"
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


        <?php include "../app/views/layout/advertisement.php"; ?>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="../public/js/browse.js"></script>
</body>

</html>