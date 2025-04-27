<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookSearchResult.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <!-- Page Title -->
    <div id="title">
        <h1>Search Results</h1>
    </div>

    <div class="browse-main-container">
        <!-- Ad image -->
        <?php include "../app/views/layout/advertisement.php"; ?>

        <main>
            <section class="search-section">
                <form action="/Free-Write/public/Browse/search" method="GET">
                    <div class="search-container">
                        <select id="search-type" name="searchType" aria-label="Search type">
                            <option value="book">Book</option>
                            <option value="spinoff">Spinoff</option>
                            <option value="user">User</option>
                            <option value="writer">Author</option>
                            <option value="covdes">Cover Designer</option>
                        </select>
                        <input type="text" id="search-bar" name="itemName" placeholder="Search..."
                            value="<?= htmlspecialchars($_GET['itemName']) ?>" aria-label="Search query" />
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

            <div class="results-info">
                <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                    Found <?php echo count($searchResult); ?>
                    <?= htmlspecialchars($_GET['searchType']) ?><?php echo count($searchResult) === 1 ? '' : 's'; ?>
                <?php endif; ?>
            </div>

            <!-- Books -->
            <?php if (isset($_GET['searchType']) && $_GET['searchType'] == 'book'): ?>
                <div class="searchResult-grid">
                    <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                        <?php foreach ($searchResult as $book): ?>
                            <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                <div class="book-card">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.png'); ?>"
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
            <?php endif; ?>


            <!-- Users -->
            <?php if (isset($_GET['searchType']) && ($_GET['searchType'] == 'user' || $_GET['searchType'] == 'writer' || $_GET['searchType'] == 'covdes')): ?>
                <div class="searchResult-grid">
                    <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                        <?php foreach ($searchResult as $user): ?>
                            <a href="/Free-Write/public/user/Profile?user=<?= htmlspecialchars($user['userID']); ?>">
                                <div class="book-card">
                                    <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($user['profileImage'] ?? 'profile-image.jpg'); ?>"
                                        alt="Cover Image of <?= htmlspecialchars($user['fullName']); ?>" class="profile-cover">
                                    <div class="book-info">
                                        <div class="book-title">
                                            <?php echo htmlspecialchars($user['fullName']); ?>
                                        </div>
                                        <div class="book-synopsis">
                                            <?php echo htmlspecialchars($user['bio']); ?>
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
            <?php endif; ?>

            <!-- Spinoffs -->
            <?php if (isset($_GET['searchType']) && $_GET['searchType'] == 'spinoff'): ?>
                <div class="searchResult-grid">
                    <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                        <?php foreach ($searchResult as $spinoff): ?>
                            <a href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                <div class="book-card">
                                    <img src="/Free-Write/public/images/spinoff.png"
                                        alt="Cover of <?= htmlspecialchars($spinoff['title']); ?>" class="book-cover">
                                    <div class="book-info">
                                        <div class="book-title">
                                            <?php echo htmlspecialchars($spinoff['title']); ?>
                                        </div>
                                        <div class="book-author">
                                            by <?php echo htmlspecialchars($spinoff['creator']); ?>
                                        </div>
                                        <div class="book-synopsis">
                                            <?php echo htmlspecialchars($spinoff['synopsis']); ?>
                                        </div>
                                        <div class="book-meta">
                                            <a
                                                href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($spinoff['fromBookID']); ?>">
                                                <span class="book-type">
                                                    <?php echo htmlspecialchars($spinoff['fromBook']); ?>
                                                </span>
                                            </a>
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
            <?php endif; ?>

            <!-- Covers -->
            <?php if (isset($_GET['searchType']) && $_GET['searchType'] == 'cover'): ?>
                <div class="searchResult-grid">
                    <?php if (isset($searchResult) && count($searchResult) > 0): ?>
                        <?php foreach ($searchResult as $book): ?>
                            <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                <div class="book-card">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.png'); ?>"
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
            <?php endif; ?>
        </main>

        <!-- Ad image -->
        <?php include "../app/views/layout/advertisement.php"; ?>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="../public/js/bookSearch.js"></script>
</body>

</html>