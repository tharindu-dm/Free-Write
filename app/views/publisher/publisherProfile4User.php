<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher Profile - Reader View</title>
    <style>
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 20px;
        }

        .banner {
            height: 200px;
            background-image: url('//Free-Write/public/images/sampleCover.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            border-radius: 12px;
            margin-bottom: 1rem;
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
            color: #8C805E;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .follow-button {
            background-color: #FFD052;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .message-button {
            background-color: #8C805E;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .follow-button:hover, .message-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .publisher-info {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .published-works {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-card img {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: 8px;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .tag {
            background-color: #F5F0E5;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #8C805E;
        }

        @media (max-width: 768px) {

            .profile {
                flex-direction: column;
            }

            .profile-left {
                margin-right: 0;
                margin-bottom: 2rem;
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
            background-color: #F5F0E5;
            border: 1px solid #8C805E;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: #8C805E;
            cursor: pointer;
            transition: all 0.2s;
        }

        .filter-button.active {
            background-color: #8C805E;
            color: white;
        }

        .filter-button:hover {
            background-color: #8C805E;
            color: white;
        }

        .view-all-button {
            background-color: #FFD052;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
            display: block;
            text-decoration: none;
            color: #1C160C;
        }

        .view-all-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #E0B94A;
        }

        .book-card {
            position: relative;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .book-info {
            padding: 1rem;
        }

        .book-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .book-author {
            font-size: 0.8rem;
            color: #8C805E;
        }

        .book-date {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.3rem;
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
            border-bottom: 2px solid #FFD052;
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
      <div class="banner"></div>

      <section class="profile">
          <div class="profile-left">
              <img src="/Free-Write/public/images/profile-image.jpg" alt="Acme Publishing" class="profile-picture">
              <div class="stats">
                  <div class="stat-item">
                      <div class="stat-number">245</div>
                      <div class="stat-label">Published</div>
                  </div>
                  <div class="stat-item">
                      <div class="stat-number">15.2K</div>
                      <div class="stat-label">Followers</div>
                  </div>
              </div>
              <div class="action-buttons">
                  <button class="follow-button">Follow</button>
                  <button class="message-button">Message</button>
              </div>
          </div>
          
          <div class="profile-right">
              <h1>Acme Publishing</h1>
              <p>Independent Publisher since 1995</p>
              <div class="tags">
                  <span class="tag">Fiction</span>
                  <span class="tag">Non-Fiction</span>
                  <span class="tag">Young Adult</span>
                  <span class="tag">Poetry</span>
              </div>
              <p>A leading independent publisher dedicated to discovering new voices and bringing compelling stories to readers worldwide. We specialize in contemporary fiction, literary non-fiction, and groundbreaking poetry.</p>
          </div>
      </section>

      <section class="publisher-info">
          <h2>About the Publisher</h2>
          <p>Submission Guidelines</p>
          <p>We accept manuscripts in the following categories:</p>
          <div class="tags">
              <span class="tag">Literary Fiction</span>
              <span class="tag">Contemporary Romance</span>
              <span class="tag">Science Fiction</span>
              <span class="tag">Memoir</span>
          </div>
          <p>Average Response Time: 4-6 weeks</p>
      </section>
      
    <section class="published-works">
        <div class="publications-header">
            <h2>Publications</h2>
            <div class="filter-controls">
                <button class="filter-button active">All</button>
                <button class="filter-button">Fiction</button>
                <button class="filter-button">Non-Fiction</button>
                <button class="filter-button">Poetry</button>
                <button class="filter-button">Young Adult</button>
            </div>
        </div>

        <div class="publication-category">
            <div class="category-header">
                <h3>Latest Releases</h3>
            </div>
            <div class="publications-grid">
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 1">
                    <div class="book-info">
                        <div class="book-title">The Hidden Path</div>
                        <div class="book-author">by Sarah Johnson</div>
                        <div class="book-date">Published: Oct 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 2">
                    <div class="book-info">
                        <div class="book-title">Beyond the Horizon</div>
                        <div class="book-author">by Michael Chen</div>
                        <div class="book-date">Published: Sep 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 3">
                    <div class="book-info">
                        <div class="book-title">Midnight Tales</div>
                        <div class="book-author">by Emma Roberts</div>
                        <div class="book-date">Published: Sep 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 4">
                    <div class="book-info">
                        <div class="book-title">The Last Summer</div>
                        <div class="book-author">by David Miller</div>
                        <div class="book-date">Published: Aug 2024</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="publication-category">
            <div class="category-header">
                <h3>Best Sellers</h3>
            </div>
            <div class="publications-grid">
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 5">
                    <div class="book-info">
                        <div class="book-title">Winter's Edge</div>
                        <div class="book-author">by Robert Frost</div>
                        <div class="book-date">Published: Jul 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 6">
                    <div class="book-info">
                        <div class="book-title">Silent Echo</div>
                        <div class="book-author">by Lisa Chang</div>
                        <div class="book-date">Published: Jun 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 7">
                    <div class="book-info">
                        <div class="book-title">The Dark Woods</div>
                        <div class="book-author">by James Black</div>
                        <div class="book-date">Published: May 2024</div>
                    </div>
                </div>
                <div class="book-card">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Book 8">
                    <div class="book-info">
                        <div class="book-title">Morning Light</div>
                        <div class="book-author">by Anna White</div>
                        <div class="book-date">Published: Apr 2024</div>
                    </div>
                </div>
            </div>
        </div>

        <a href="/Free-Write/public/Publisher/bookList" class="view-all-button">View All Publications</a>
    </section>

    <!-- Previous sections remain the same -->
</body>
</html>