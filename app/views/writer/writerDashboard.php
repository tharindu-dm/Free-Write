<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                        alt="Profile Picture" class="user-profile-picture">
                </div>

                <?php if (!empty($userDetails) && is_array($userDetails)): ?>
                    <h2 style="color: var(--black);">
                        <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                    </h2>
                    <div class="profile-info">
                        <p><strong><?= htmlspecialchars($followers['followers']) ?> Followers</strong></p>
                        <p><strong><?= htmlspecialchars((string) $views); ?> Views</strong></p>

                    </div>

                <?php else: ?>
                    <h2>User Name</h2>
                <?php endif; ?>
            </div>

            <!-- Navigation for Writer Options -->
            <?php require_once "../app/views/writer/writerNav.php"; ?>

            <!-- Books Section -->

            <div class="books-section" id="books">
                <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                    <h2>My Books</h2>
                <?php endif; ?>

                <!-- Button to Add New Book -->
                <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                    <div>
                        <a href="/Free-Write/public/Writer/New" class="button-new">+ New</a>
                    </div>
                <?php endif; ?>

                <!-- Books List for author-->
                <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                <div class="books-grid">
                    <?php if (!empty($MyBooks) && is_array($MyBooks)): ?>
                        <?php foreach ($MyBooks as $book): ?>
                            <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                                <a href="/Free-Write/public/writer/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                <?php else: ?>
                                    <a href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                    <?php endif; ?>
                                    <div class="book-card">
                                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                                        <h4>
                                            <?= strlen($book['title']) > 20 ? htmlspecialchars(substr($book['title'], 0, 17)) . '...' : htmlspecialchars($book['title']); ?>
                                        </h4>
                                        <p>
                                            <?= date('Y-m-d', strtotime($book['creationDate'])); ?>
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
                <?php else: ?>

                     <!-- Most Viewed Books Section -->
            <div>
                <h2 class="section-title">Most Viewed</h2>
                <div class="books-grid">
                    <?php
                    if (!empty($MostViewed) && is_array($MostViewed)):
                        $count = 0;
                        foreach ($MostViewed as $book):
                            if ($count++ === 0)
                                continue;
                            if ($count > 6)
                                break;
                            ?>
                            <a href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                <div class="book-card">
                                    <img
                                        src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['coverImage'] ?? 'sampleCover.jpg'); ?>">
                                    <h4>
                                        <?= strlen($book['title']) > 20 ? htmlspecialchars(substr($book['title'], 0, 17)) . '...' : htmlspecialchars($book['title']); ?>
                                    </h4>
                                    <p><?= htmlspecialchars($book['views']) ?> Views</p>
                                </div>
                            </a>
                        <?php endforeach; else: ?>
                        <div class="book-card">
                            <img src="../app/images/coverDesign/sampleCover.jpg">
                            <h3 class="book-card-title">No Books Available</h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Rated Section -->
            <div>
                <h2 class="section-title">Highest Rated</h2>
                <div class="books-grid">
                    <?php
                    if (!empty($Rated) && is_array($Rated)):
                        foreach ($Rated as $index => $book):
                            if ($index >= 5)
                                break; // Only show 5 books
                            ?><a href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                <div class="book-card">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['coverImage'] ?? 'sampleCover.jpg'); ?>"
                                        alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                                    <h4>
                                        <?= strlen($book['title']) > 20 ? htmlspecialchars(substr($book['title'], 0, 17)) . '...' : htmlspecialchars($book['title']); ?>
                                    </h4>
                                    <p>
                                        <?= !empty($book['AverageRating']) ? htmlspecialchars($book['AverageRating']) : '0' ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </p>
                                </div>
                            </a>
                        <?php
                        endforeach;
                    else:
                        ?>
                        <div>
                            <div class="book-card-details">
                                <p class="book-card-title">No Books Available</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

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