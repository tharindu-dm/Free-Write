<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/browse.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header.php";
    ?>

    <!-- Page Title -->
     <div id="title">
    <h1>Designers</h1></div>

    <div class="browse-main-container">
        <!-- Ad image -->
        <div>
            <img src="../public/images/ad.png" alt="Ad" class="ad-image">
        </div>

        <main>

            <!-- Book Filters -->
            <aside>
                <h2>Filters</h2>
                <div class="filter">
                    <h3>Genre</h3>
                    <label>
                        <input type="checkbox" name="genre" value="fiction" /> Fiction
                    </label>
                    <label>
                        <input type="checkbox" name="genre" value="comedy" /> Comedy
                    </label>
                    <label>
                        <input type="checkbox" name="genre" value="romance" /> Romance
                    </label>
                    <!-- Add more genres as needed -->
                </div>
                <div class="filter">
                    <h3>Price</h3>
                    <label>
                        <input type="radio" name="price" value="free" /> Free
                    </label>
                    <label>
                        <input type="radio" name="price" value="paid" /> Paid
                    </label>
                </div>
                <div class="filter">
                    <h3>Rating</h3>
                    <label>
                        <input type="radio" name="rating" value="1" /> 1 Star
                    </label>
                    <label>
                        <input type="radio" name="rating" value="2" /> 2 Stars
                    </label>
                    <label>
                        <input type="radio" name="rating" value="3" /> 3 Stars
                    </label>
                    <label>
                        <input type="radio" name="rating" value="4" /> 4 Stars
                    </label>
                    <label>
                        <input type="radio" name="rating" value="5" /> 5 Stars
                    </label>
                </div>
            </aside>

            <section class="browse-body-section">
                <!-- Search Bar Section -->
                <section class="search-section">
                    <input type="text" id="search-bar" placeholder="Search books..." />
                    <button id="search-btn">Search</button>
                </section>

                <!-- Book Categories -->
                <section class="book-category">
                    <h2>Freewrite Originals For You</h2>
                    <div class="book-grid">
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Swallow">
                            <h3>Swallow</h3>
                            <p>Voodoo</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="3,003">
                            <h3>3,003</h3>
                            <p>Fiction</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="The 239">
                            <h3>The 239</h3>
                            <p>Comedy</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="The Last She">
                            <h3>The Last She</h3>
                            <p>Dystopia</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Day After">
                            <h3>Day After</h3>
                            <p>Mythology</p>
                        </div>
                    </div>
                </section>

                <section class="book-category">
                    <h2>Top Paid Books</h2>
                    <div class="book-grid">
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Swallow">
                            <h3>Swallow</h3>
                            <p>Voodoo</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="3,003">
                            <h3>3,003</h3>
                            <p>Fiction</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="The 239">
                            <h3>The 239</h3>
                            <p>Comedy</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="The Last She">
                            <h3>The Last She</h3>
                            <p>Dystopia</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Day After">
                            <h3>Day After</h3>
                            <p>Mythology</p>
                        </div>
                    </div>
                </section>

                <section class="book-category">
                    <h2>Who Will Be Left Standing?</h2>
                    <div class="book-grid">
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Heartless">
                            <h3>Heartless</h3>
                            <p>Romance</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="GroundBound">
                            <h3>GroundBound</h3>
                            <p>Horror</p>
                        </div>
                        <div class="book-card">
                            <img src="../public/images/sampleCover.jpg" alt="Comatose">
                            <h3>Comatose</h3>
                            <p>Psychology</p>
                        </div>

                    </div>
                </section>
            </section>
        </main>

        <!-- Ad image -->
        <div>
            <img src="../public/images/ad.png" alt="Ad" class="ad-image">
        </div>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>