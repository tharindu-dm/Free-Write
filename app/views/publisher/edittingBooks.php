<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Library Display System - Book Editor">
  <title>edittingBooks4Publishers</title>
  <style>
    .main-content {
      display: flex;
      justify-content: center;
      padding: 2rem;
    }

    .main-section {
      max-width: 800px;
      width: 100%;
      padding: 2rem;
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .breadcrumbs {
      display: flex;
      gap: 0.5rem;
      color: #A18249;
      margin-bottom: 1rem;
    }

    .breadcrumbs a {
      color: #A18249;
      text-decoration: none;
    }

    .book-title {
      font-size: 2rem;
      margin-bottom: 2rem;
      color: #1C160C;
    }

    .input-field {
      margin-bottom: 1.5rem;
    }

    .input-field label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #1C160C;
    }

    .input-field input {
      width: 100%;
      padding: 1rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
      background-color: #FCFAF5;
    }

    .input-field input:focus {
      outline: none;
      border-color: #019863;
      box-shadow: 0 0 0 3px rgba(1, 152, 99, 0.2);
    }

    .checkbox-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin: 1.5rem 0;
    }

    .checkbox-container input {
      width: 1.2rem;
      height: 1.2rem;
      cursor: pointer;
    }

    .review-section {
      margin: 2rem 0;
      padding: 1rem;
      background-color: #FCFAF5;
      border-radius: 8px;
    }

    .review {
      display: flex;
      gap: 1rem;
      padding: 1rem 0;
      border-bottom: 1px solid #FFD700;
    }

    .review img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .review-info h3 {
      margin-bottom: 0.25rem;
    }

    .star-rating {
      display: flex;
      gap: 0.25rem;
      margin-bottom: 0.5rem;
    }

    .user-actions {
      display: flex;
      align-items: center;
    }

    .icon-button {
      background: none;
      border: none;
      cursor: pointer;
      margin: 0 10px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    .star {
      color: #019863;
    }

    .save-button {
      display: inline-block;
      padding: 1rem 2rem;
      background-color: #FFD052;
      color: #FFFFFF;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .save-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .last-saved {
      color: #A18249;
      font-size: 0.875rem;
      margin: 1rem 0;
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 1rem;
      }

      .main-section {
        padding: 1rem;
      }

      .save-button {
        width: 100%;
        text-align: center;
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

  <div class="main-content">
    <section class="main-section">
      <div class="breadcrumbs">
        <a href="#">Books</a> /
        <span>Designing Data-Intensive Applications</span>
      </div>
      <h1 class="book-title">Designing Data-Intensive Applications</h1>

      <div class="input-field">
        <label>Title</label>
        <input type="text" placeholder="Enter title" />
      </div>
      <div class="input-field">
        <label>Author(s)</label>
        <input type="text" placeholder="Enter author(s)" />
      </div>
      <div class="input-field">
        <label>Genre</label>
        <input type="text" placeholder="Enter genre" />
      </div>
      <div class="input-field">
        <label>Publication year</label>
        <input type="text" placeholder="Enter publication year" />
      </div>

      <div class="checkbox-container">
        <input type="checkbox" id="availability" />
        <label for="availability">This book is not available for checkout</label>
      </div>

      <p class="last-saved">Changes saved 10 minutes ago</p>

      <div class="review-section">
        <div class="review">
          <img src="./image/blank.webp" alt="Jane Smith" />
          <div class="review-info">
            <h3>Jane Smith</h3>
            <div class="star-rating">
              <div class="star">★</div>
              <div class="star">★</div>
              <div class="star">★</div>
              <div class="star">★</div>
              <div class="star">★</div>
            </div>
            <p>Changed title from 'Data-Intensive Applications' to 'Designing Data-Intensive Applications'</p>
          </div>
        </div>
      </div>

      <button class="save-button">Save</button>
    </section>
  </div>
</body>

</html>