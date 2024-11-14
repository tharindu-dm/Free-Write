<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Spin-off Requests</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <!-- Main Content -->
    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="/public/images/Writer/profile.png" alt="User Profile">
                <h2>Michael Thompson</h2>
                <p>250 followers</p>
            </div>

            <!-- Navigation for Writer Options -->
            <nav class="writer-nav">
                <a href="/Free-Write/public/writer/books">Books</a>
                <a href="/Free-Write/public/writer/quotes">Quotes</a>
                <a href="/Free-Write/public/writer/spinoffs">Spin-offs</a>
                <a href="/Free-Write/public/writer/competitions">Competitions</a>
            </nav>

            <!-- Spin-off  Section -->
            <h3>Spin-off requests</h3>

            <div class="spinoff-list">
                

                <!-- Spin-off  items -->
                <div class="spinoff-item">
                    <p>The Cat Who Saved the World<br>
                        <small>Requested by: <a href="#">@user123</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>

                <div class="spinoff-item">
                    <p>The Mystery of the Missing Sock<br>
                        <small>Requested by: <a href="#">@user456</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>

                <div class="spinoff-item">
                    <p>The Dragon Who Loved Ice Cream<br>
                        <small>Requested by: <a href="#">@user789</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>
