<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
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

            <!-- Quotes Section -->
            <section class="quotes-section">
                <h2>Quotes</h2>
                <a href="/Free-Write/public/Writer/NewQuote" class="button-new">+ New</a>

                <!-- Quotes List -->
                <ul class="quotes-list">
                    <?php foreach ($quotes as $quote): ?>
                        <li class="quote-item">
                            <div class="quote-info">
                                <h3><?php echo htmlspecialchars($quote['title']); ?></h3>
                                <p><?php echo htmlspecialchars($quote['chapter']); ?></p>
                            </div>
                            <button class="quote-options">...</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>
    </main>

    <!-- Footer Section -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="../public/js/home.js"></script>
</body>

</html>