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

                <!-- Books List -->
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