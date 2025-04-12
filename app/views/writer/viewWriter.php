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
        <div class="viewDashboard">

            <!-- Featured Section - First Row -->
            <div class="featured-section">
                <!-- Most Viewed Book Card -->
                <?php if (!empty($MostViewed) && is_array($MostViewed) && count($MostViewed) > 0): ?>
                    <div class="featured-book-card">
                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($MostViewed[0]['coverImage'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($MostViewed[0]['title']); ?>">
                            <div>
                                <h3><?= htmlspecialchars($MostViewed[0]['title']) ?></h3>
                                <span><?= htmlspecialchars(($MostViewed[0]['views'] ?? 'No')) ?> views</span>
                            </div>                          
                        </div>
                <?php endif; ?>
                

                <!-- Quotes Card -->
                <div id="quotes-carousel" class="featured-book-card">
                    <?php if (!empty($quotes) && is_array($quotes)): ?>
                        <?php foreach ($quotes as $index => $quote): ?>
                            <div class="quote-slide" style="display: <?= $index === 0 ? 'block' : 'none' ?>;">
                                <p class="quote-content"><?= htmlspecialchars($quote['quote']) ?></p>
                                <p class="quote-book">— <?= htmlspecialchars($quote['book_name']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Most Viewed Books Section -->
            <div>
                <h2 class="section-title">Most Viewed Books</h2>
                <div class="books-grid">
                    <?php 
                    if (!empty($MostViewed) && is_array($MostViewed)):
                        // Skip the first book as it's already featured
                        $count = 0;
                        foreach ($MostViewed as $book):
                            if ($count++ === 0) continue; // Skip the first book
                            if ($count > 6) break; // Only show 5 more books
                    ?>
                        <div class="book-card">
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['coverImage'] ?? 'sampleCover.jpg'); ?>">

                                <h3 class="book-card-title"><?= htmlspecialchars($book['title']) ?></h3>
                                    <span><?= htmlspecialchars($book['views']) ?> views</span>
                        </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                        <div class="book-card">
                            <div class="book-card-cover">
                            <img src="../app/images/coverDesign/ <?= htmlspecialchars($MostViewed['coverImage'] ?? 'sampleCover.jpg'); ?>">
                            </div>
                            <div class="book-card-details">
                                <h3 class="book-card-title">No Books Available</h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Latest Books Section -->
            <div>
                <h2 class="section-title">Latest Books</h2>
                <div class="books-grid">
                    <?php 
                    if (!empty($Latest) && is_array($Latest)):
                        foreach ($Latest as $index => $book):
                            if ($index >= 5) break; // Only show 5 books
                    ?>
                        <div class="book-card">
                            <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['coverImage'] ?? 'sampleCover.jpg'); ?>"
                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                                <h3 class="book-card-title"><?= htmlspecialchars($book['title']) ?></h3>
                                    <span><?= htmlspecialchars(date('M d, Y', strtotime($book['created_at']))) ?></span>
                            </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                        <div class="book-card">
                            <div class="book-card-cover">
                                <img src="../../app/images/books/default-cover.jpg" alt="No books available">
                            </div>
                            <div class="book-card-details">
                                <h3 class="book-card-title">No Books Available</h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    
</body>
    <!-- Footer Section -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>


<script>
        // Quotes carousel functionality
        const quoteSlides = document.querySelectorAll('.quote-slide');
        let currentQuoteIndex = 0;

        function showNextQuote() {
            // Hide current quote
            quoteSlides[currentQuoteIndex].style.display = 'none';
            
            // Move to next quote or reset to first
            currentQuoteIndex = (currentQuoteIndex + 1) % quoteSlides.length;
            
            // Show next quote with fade-in effect
            const nextQuote = quoteSlides[currentQuoteIndex];
            nextQuote.style.opacity = 0;
            nextQuote.style.display = 'block';
            
            // Fade in animation
            let opacity = 0;
            const fadeIn = setInterval(() => {
                opacity += 0.1;
                nextQuote.style.opacity = opacity;
                if (opacity >= 1) clearInterval(fadeIn);
            }, 50);
        }

        // Change quote every 5 seconds if there are multiple quotes
        if (quoteSlides.length > 1) {
            setInterval(showNextQuote, 5000);
        }
    </script>
</body>

</html>