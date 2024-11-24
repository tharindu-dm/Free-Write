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
                <img src="/public/images/Writer/profile.png" alt="User Profile">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p><?php echo htmlspecialchars($user['followers']); ?> followers</p>
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
