<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookSearchResult.css">
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
        <h1>Search Results</h1>
    </div>

    <div class="browse-main-container">
        <!-- Ad image -->
        <div>
            <img src="/Free-Write/public/images/ad.png" alt="Ad" class="ad-image">
        </div>

        <main>
            <section class="search-section">
                <form action="/Free-Write/public/Browse/search" method="GET">
                    <input type="text" id="search-bar" name="bookName" placeholder="Search books..."
                        value="<?= htmlspecialchars($_GET['bookName']) ?>" />
                    <button type="submit" id="search-btn">Search</button>
                </form>

                <div class="results-info">
                    <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                        Found <?php echo count($searchResult); ?> book<?php echo count($searchResult) === 1 ? '' : 's'; ?>
                    <?php endif; ?>
                </div>
            </section>

            <div class="searchResult-grid">
                <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                    <?php foreach ($searchResult as $book): ?>
                        <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                            <div class="book-card">
                                <img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                    alt="Cover Image of <?= htmlspecialchars($book['title']); ?>" class="book-cover">
                                <div class="book-info">
                                    <div class="book-title">
                                        <?php echo htmlspecialchars($book['title']); ?>
                                    </div>
                                    <div class="book-author">
                                        by <?php echo htmlspecialchars($book['author']); ?>
                                    </div>
                                    <div class="book-synopsis">
                                        <?php echo htmlspecialchars($book['Synopsis']); ?>
                                    </div>
                                    <div class="book-meta">
                                        <span class="book-price">
                                            <?php echo $book['price'] ? 'LKR ' . number_format($book['price'], 2) : 'FREE'; ?>
                                        </span>
                                        <span class="book-price">
                                            <?php echo ($book['isCompleted'] == 0) ? 'OnGoing ' : 'Completed'; ?>
                                        </span>
                                        <span class="book-type">
                                            <?php echo htmlspecialchars($book['publishType']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-results">
                        <?php if (isset($searchQuery)): ?>
                            No books found matching your search.
                        <?php else: ?>
                            Enter a search term to find books.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <!-- Ad image -->
        <div>
            <img src="/Free-Write/public/images/ad.png" alt="Ad" class="ad-image">
        </div>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="../public/js/bookSearch.js"></script>
</body>

</html>