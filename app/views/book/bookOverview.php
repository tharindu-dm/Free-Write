<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookOverview.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header.php";
    ?>

    <div class="container">
        <div class="product-layout">
            <div class="product-image">
                <img src="../public/images/sampleCover.jpg" alt="Swallow">
                <div class="author-details">
                    <h3>Author Details</h3>
                    <p><strong>Author:</strong> John Doe</p>
                    <p><strong>Published:</strong> September 15, 2023</p>
                    <p><strong>Status:</strong> Ongoing</p>
                </div>
            </div>
            <div class="product-info">
                <h1>The Book Title</h1>
                <p class="description">
                    "An awe-inspiring artwork capturing the majestic journey of a
                    bird soaring through towering mountain peaks. The vibrant
                    colors of the sky blend with the rugged terrain below,
                    illustrating a sense of freedom and tranquility. The bird's
                    graceful flight symbolizes the spirit of adventure and the
                    boundless connection between nature and the skies."
                </p>
                <div class="read-button-container">
                    <button class="buy-button">
                        Read &nbsp;
                        <svg style="height: 1.5rem; width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                    <div class="purchase-description">
                        Purchase the book to read
                    </div>
                </div>


                <div class="table-of-contents">
                    <h2>Table of Contents</h2>
                    <ul id="chapters-list">
                        <!-- Chapters will be added here by JavaScript -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="../public/js/Book/bookOverview.js"></script>
</body>

</html>