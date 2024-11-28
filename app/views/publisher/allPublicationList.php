<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Publications - Acme Publishing</title>
    <style>
        main {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .publisher-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .publisher-logo {
            width: 60px;
            height: 60px;
            border-radius: 8px;
        }

        .filters-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .filter-options {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .filter-chip {
            background-color: #F5F0E5;
            border: 1px solid #8C805E;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #8C805E;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-chip.active {
            background-color: #8C805E;
            color: white;
        }

        .filter-chip:hover {
            background-color: #8C805E;
            color: white;
        }

        .sort-select {
            padding: 0.5rem;
            border: 1px solid #8C805E;
            border-radius: 8px;
            background-color: white;
            color: #8C805E;
        }

        .publications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
        }

        .book-info {
            padding: 1rem;
        }

        .book-title {
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .book-author {
            color: #8C805E;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .book-details {
            font-size: 0.8rem;
            color: #666;
        }

        .book-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.8rem;
        }

        .book-tag {
            background-color: #F5F0E5;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
            color: #8C805E;
        }

        .load-more {
            background-color: #FFD052;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin: 2rem auto;
            display: block;
            transition: transform 0.2s;
        }

        .load-more:hover {
            transform: translateY(-2px);
            background-color: #E0B94A;
        }

        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }

            .publications-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .filter-options {
                gap: 0.5rem;
            }
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
        <div class="page-header">
            <div class="publisher-info">
                <img src="/Free-Write/public/images/profile-image.jpg" alt="Acme Publishing" class="publisher-logo">
                <div>
                    <h1>All Publications</h1>
                    <p>Acme Publishing</p>
                </div>
            </div>
        </div>

        <section class="filters-section">
            <div class="filter-group">
                <div class="filter-header">
                    <h3>Categories</h3>
                </div>
                <div class="filter-options">
                    <button class="filter-chip active">All</button>
                    <button class="filter-chip">Fiction</button>
                    <button class="filter-chip">Non-Fiction</button>
                    <button class="filter-chip">Poetry</button>
                    <button class="filter-chip">Young Adult</button>
                    <button class="filter-chip">Children's</button>
                    <button class="filter-chip">Romance</button>
                    <button class="filter-chip">Mystery</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-header">
                    <h3>Publication Year</h3>
                </div>
                <div class="filter-options">
                    <button class="filter-chip active">All Time</button>
                    <button class="filter-chip">2024</button>
                    <button class="filter-chip">2023</button>
                    <button class="filter-chip">2022</button>
                    <button class="filter-chip">2021</button>
                    <button class="filter-chip">Earlier</button>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-header">
                    <h3>Sort By</h3>
                    <select class="sort-select">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="title-asc">Title A-Z</option>
                        <option value="title-desc">Title Z-A</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </section>

        <div class="publications-grid">
            <!-- Example book cards -->
            <a href="/Free-Write/public/Publisher/bookProfile">  <div class="book-card">
                <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book Title" class="book-cover">
                <div class="book-info">
                    <div class="book-title">The Hidden Path</div>
                    <div class="book-author">by Sarah Johnson</div>
                    <div class="book-details">Published: Oct 2024</div>
                    <div class="book-tags">
                        <span class="book-tag">Fiction</span>
                        <span class="book-tag">Mystery</span>
                    </div>
                </div>
            </div>
            </a>

            <!-- Repeat book cards for demonstration -->
            <a href="/Free-Write/public/Publisher/bookProfile"> <div class="book-card">
                <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book Title" class="book-cover">
                <div class="book-info">
                    <div class="book-title">Beyond the Horizon</div>
                    <div class="book-author">by Michael Chen</div>
                    <div class="book-details">Published: Sep 2024</div>
                    <div class="book-tags">
                        <span class="book-tag">Fiction</span>
                        <span class="book-tag">Adventure</span>
                    </div>
                </div>
            </div>
            </a>

            <!-- Add more book cards as needed -->
            <!-- Repeat similar book cards 10 more times for demonstration -->
        </div>

        <button class="load-more">Load More</button>
    </main>
</body>
</html>