<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publisher Profile - Reader View</title>
  <style>
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
      background-color: #f5f0e5;
      border: 1px solid #8c805e;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      color: #8c805e;
      cursor: pointer;
      transition: all 0.2s;
    }

    .filter-button.active {
      background-color: #8c805e;
      color: white;
    }

    .filter-button:hover {
      background-color: #8c805e;
      color: white;
    }

    .view-all-button {
      background-color: #ffd052;
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
      color: #1c160c;
    }

    .view-all-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #e0b94a;
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
      color: #8c805e;
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
      border-bottom: 2px solid #ffd052;
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
  <?php require_once "../app/views/layout/headerSelector.php";

  ?>
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
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 1" />
          <div class="book-info">
            <div class="book-title">The Hidden Path</div>
            <div class="book-author">by Sarah Johnson</div>
            <div class="book-date">Published: Oct 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 2" />
          <div class="book-info">
            <div class="book-title">Beyond the Horizon</div>
            <div class="book-author">by Michael Chen</div>
            <div class="book-date">Published: Sep 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 3" />
          <div class="book-info">
            <div class="book-title">Midnight Tales</div>
            <div class="book-author">by Emma Roberts</div>
            <div class="book-date">Published: Sep 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 4" />
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
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 5" />
          <div class="book-info">
            <div class="book-title">Winter's Edge</div>
            <div class="book-author">by Robert Frost</div>
            <div class="book-date">Published: Jul 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 6" />
          <div class="book-info">
            <div class="book-title">Silent Echo</div>
            <div class="book-author">by Lisa Chang</div>
            <div class="book-date">Published: Jun 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 7" />
          <div class="book-info">
            <div class="book-title">The Dark Woods</div>
            <div class="book-author">by James Black</div>
            <div class="book-date">Published: May 2024</div>
          </div>
        </div>
        <div class="book-card">
          <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 8" />
          <div class="book-info">
            <div class="book-title">Morning Light</div>
            <div class="book-author">by Anna White</div>
            <div class="book-date">Published: Apr 2024</div>
          </div>
        </div>
      </div>
    </div>

    <a href="#" class="view-all-button">View All Publications</a>
  </section>

</body>

</html>