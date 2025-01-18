<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Writing Competitions</title>
    <style>
        :root {
            --primary-color: #ffd700;
            --text-color: #333;
            --background-color: #f4f4f4;
            --card-background: #ffffff;
            --hover-color: #ffec8b;
        }

        main {
            max-width: 1200px;
            height: 100vh;
            margin: 0 auto;
            padding: 20px;
            background-color: var(--background-color);
        }

        .competitions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .competitions-header h1 {
            color: var(--text-color);
            font-size: 2.5rem;
            font-weight: bold;
        }

        .filter-section {
            display: flex;
            gap: 15px;
        }

        .filter-section select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
        }

        .competitions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .competition-card {
            background-color: var(--card-background);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .competition-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .competition-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .competition-details {
            padding: 0.25rem;
        }

        .competition-details h2 {
            color: var(--text-color);
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .competition-details .publisher {
            color: #666;
            margin-bottom: 10px;
        }

        .competition-details .deadline {
            display: flex;
            flex-direction: column;
            gap:1rem;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .deadline-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .view-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .view-button:hover {
            background-color: var(--hover-color);
        }
    </style>
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
        case 'mod':
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
        <div class="competitions-header">
            <h1>Writing Competitions</h1>
            <div class="filter-section">
                <select>
                    <option>All Genres</option>
                    <option>Fiction</option>
                    <option>Non-Fiction</option>
                    <option>Poetry</option>
                </select>
                <select>
                    <option>Sort by: Newest</option>
                    <option>Most Popular</option>
                    <option>Ending Soon</option>
                </select>
            </div>
        </div>

        <div class="competitions-grid">
            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Summer Short Story ...</h2>
                    <div class="publisher">By Creative Writers Hub</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 30 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Sci-Fi Writing ...</h2>
                    <div class="publisher">By Galactic Writers</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 45 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

            <div class="competition-card">
                <img src="/Free-Write/public/images/bnw.jpg" alt="Competition Image">
                <div class="competition-details">
                    <h2>Poetry Slam Challenge</h2>
                    <div class="publisher">By Verse Creators</div>
                    <div class="deadline">
                        <span class="deadline-badge">Ends in 60 days</span>
                        <a href="/Free-Write/public/Competition/ProfileUser" class="view-button">View Details</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>