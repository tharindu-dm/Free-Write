<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher Profile - Reader View</title>
    <style>
        :root {
            --primary-color: #8C805E;
            --accent-color: #FFD052;
            --light-bg: #F5F0E5;
            --text-dark: #1C160C;
            --text-medium: #555;
            --text-light: #777;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: #f9f7f2;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 20px;
        }

        .banner {
            height: 250px;
            background-image: url('//Free-Write/app/images/coverDesign/sampleCover.jpg');
            background-size: cover;
            background-position: center;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            position: relative;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.1));
        }

        .profile {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile:hover {
            box-shadow: var(--shadow-lg);
        }

        .profile-left {
            flex: 0 0 200px;
            margin-right: 2rem;
        }

        .profile-right {
            flex: 1;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: var(--radius-md);
            margin-bottom: 1rem;
            object-fit: cover;
            box-shadow: var(--shadow-sm);
            border: 3px solid white;
            transition: transform 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.02);
        }

        .stats {
            display: flex;
            gap: 1.5rem;
            margin: 1rem 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .follow-button {
            background-color: var(--accent-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .message-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .follow-button:hover,
        .message-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        h2 {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-top: 0;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        h3 {
            font-size: 1.6rem;
            color: var(--primary-color);
            margin-top: 0;
        }

        .publisher-info {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }

        .publisher-info p {
            margin: 0.7rem 0;
            display: flex;
            align-items: center;
        }

        .publisher-info p:before {
            content: '•';
            color: var(--accent-color);
            font-weight: bold;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .published-works {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin: 1.5rem 0;
        }

        .book-card {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .book-card a {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .book-card img {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: var(--radius-sm) var(--radius-sm) 0 0;
            transition: filter 0.3s ease;
        }

        .book-card:hover img {
            filter: brightness(1.05);
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .tag {
            background-color: var(--light-bg);
            padding: 0.4rem 0.8rem;
            border-radius: var(--radius-lg);
            font-size: 0.9rem;
            color: var(--primary-color);
            transition: background-color 0.2s ease;
        }

        .tag:hover {
            background-color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .profile {
                flex-direction: column;
            }

            .profile-left {
                margin-right: 0;
                margin-bottom: 2rem;
                align-self: center;
            }

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .publications-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .filter-button {
            background-color: var(--light-bg);
            border: 1px solid var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-lg);
            color: var(--primary-color);
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-button.active {
            background-color: var(--primary-color);
            color: white;
        }

        .filter-button:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .view-all-button {
            background-color: var(--accent-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
            display: block;
            text-decoration: none;
            color: var(--text-dark);
        }

        .view-all-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background-color: #E0B94A;
        }

        .book-info {
            padding: 1rem;
        }

        .book-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
            transition: color 0.2s ease;
        }

        .book-card:hover .book-title {
            color: var(--primary-color);
        }

        .book-author {
            font-size: 0.9rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .book-date {
            font-size: 0.8rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
        }

        .book-date:before {
            content: '📅';
            margin-right: 5px;
        }

        .publications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .publication-category {
            margin-bottom: 3rem;
        }

        .category-header {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--accent-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-header h3 {
            margin: 0;
        }

        @media (max-width: 768px) {
            .publications-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .filter-controls {
                flex-wrap: wrap;
            }
        }

        .no-books-message {
            text-align: center;
            padding: 2rem;
            background-color: var(--light-bg);
            border-radius: var(--radius-md);
            color: var(--text-medium);
            font-style: italic;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>
    
    <main>
        

        <section class="profile">
            <div class="profile-left">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                    alt="<?= htmlspecialchars($publisherDetails['name']) ?>" class="profile-picture">
            </div>

            <div class="profile-right">
                <h1><?= htmlspecialchars($publisherDetails['name']) ?></h1>
                <p><?= htmlspecialchars($publisherDetails['bio']) ?></p>
            </div>
        </section>

        <section class="publisher-info">
            <h2>About the Publisher</h2>
            <p>Office Address: <?= htmlspecialchars($publisherDetails['hqAddress']) ?></p>
            <p>Office Email: <?= htmlspecialchars($publisherDetails['officeEmail']) ?></p>
            <p>Contact No: <?= htmlspecialchars($publisherDetails['contactNo']) ?></p>
        </section>

        <section class="published-works">
            <div class="publication-category">
                <div class="category-header">
                    <h3>All Releases</h3>
                </div>
                <div class="publications-grid">
                    <?php if (!empty($data['recentBooks'])): ?>
                        <?php foreach ($data['recentBooks'] as $recentBooks): ?>
                            <div class="book-card">
                                <a href="/Free-Write/public/Publisher/bookProfile4Users/<?= htmlspecialchars($recentBooks['isbnID']) ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= !empty($recentBooks['coverImage']) ? htmlspecialchars($recentBooks['coverImage']) : 'sampleCover.jpg' ?>"
                                        alt="<?= htmlspecialchars($recentBooks['title']) ?>">
                                    <div class="book-info">
                                        <div class="book-title"><?= htmlspecialchars($recentBooks['title']) ?></div>
                                        <div class="book-author">by <?= htmlspecialchars($recentBooks['author_name']) ?></div>
                                        <div class="book-date">
                                            <?= date('Y-m-d', strtotime($recentBooks['created_at'])) ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-books-message">
                            <p>No books available at this time.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>