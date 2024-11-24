<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
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
    <main>
        <div class="dashboard">
            <!-- Profile Section -->
        <div class="profile-section">
        <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>

        <?php if (!empty($userDetails) && is_array($userDetails)): ?>
        <div class="profile-info">
            <h2><?= htmlspecialchars($userDetails[0]['fullName'] ?? 'Unknown User'); ?></h2>
            
        </div>
        <?php else: ?>
            <h2>Michael Thompson</h2>
            <p>250 followers</p>
        <?php endif; ?>
        </div>

            <!-- Navigation for Writer Options -->
            <?php require_once "../app/views/writer/writerNav.php"; ?>

            <!-- Other links to get to pages -->
             <ul>
                <li><a href="/Free-Write/public/Writer/ViewSpinoff">view spin off details</a></li>
                <li><a href="/Free-Write/public/Writer/WriteStory">writeStory.php</a></li>
                <li><a href="/Free-Write/public/Writer/EditStory">editStory.php</a></li>
             </ul>

            <!-- Books Section -->
            <div class="books-section" id="books">
                <h3>Books</h3>

                <!-- Button to Add New Book -->
                <a href="/Free-Write/public/Writer/New" class="button-new">+ New</a>

                <!-- Books List -->
    <div class="book-grid">
        <?php if (!empty($MyBooks) && is_array($MyBooks)): ?>
           <?php foreach ($MyBooks as $book): ?>
            <div class="book-card">
            <img src="../public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">

            <h3>
                <?= htmlspecialchars($book['title']); ?>
            </h3><br>
            <p>
                <?= htmlspecialchars($book['author']); ?>
            </p>
            <h4>
                <?= $book['price'] === null ? 'FREE' : 'LKR ' . number_format($book['price'], 2); ?>
            </h4>
            <a
                href="/Free-Write/public/writer/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                <button class="select-book-btn"
                    data-id="<?= htmlspecialchars($book['bookID']); ?>">Select Book</button>
            </a>
            </div>
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
