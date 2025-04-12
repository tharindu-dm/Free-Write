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
    // Check if user type exists in session, else set as guest
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }

    // Include different headers based on user type
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
    ?>

    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <img src="../../app/images/profile/profile-image.jpg" alt="User Profile Image">
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

            <!-- Quotes Section -->
            <section class="quotes-section">
                <h2>My Quotes</h2>

                <?php if (empty($quotes)): ?>
                    <div class="no-requests">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 4v16a2 2 0 0 0 2 2h16"/>
          <path d="M6 2h12a2 2 0 0 1 2 2v16"/>
          <path d="M6 8h12"/>
          </svg><br>
                        <h2>You haven't written any quotes yet.</h2><br>
                    <a href="/Free-Write/public/Writer/NewQuote" class="book-btn">+ Create A New Quote </a>
                    </div>
                 <?php else: ?>

                <a href="/Free-Write/public/Writer/NewQuote" class="button-new">+ New</a>

                <!-- Quotes List -->
                <ul class="quote-item">
                    <?php foreach ($quotes as $quote): ?>
                        <li>
                        <a href="/Free-Write/public/Writer/ViewQuote/<?= htmlspecialchars($quote['quoteID']); ?>" class="quote-link">
                            <p>
                                <?php
                                // Split the quote into an array of words
                                $words = explode(' ', $quote['quote']);
                                // Get the first 7 words
                                $firstSevenWords = implode(' ', array_slice($words, 0, 7));

                                // Display the first 7 words
                                echo htmlspecialchars($firstSevenWords);
                                ?>...
                                <br>
                                <small><strong><?php echo htmlspecialchars($quote['book_name']); ?>  </strong>|  
                                    <?php echo htmlspecialchars($quote['chapter_name']); ?></small>
                            </p>
                        </a>
                            
                        </li>     
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </section>

        </div> <!-- End of Dashboard -->

    </main>

    <!-- Footer Section -->
    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="../public/js/home.js"></script>
</body>

</html>
