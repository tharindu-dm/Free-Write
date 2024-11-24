<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Write - Applications</title>
  <style>
    .content {
      width: 100%;
      max-width: 600px;
      padding: 2rem;
      background-color: white;
      border-radius: 8px;
      margin-top: 2rem;
    }

    h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1C1A4E;
      margin-bottom: 1rem;
    }

    .search-bar {
      display: flex;
      align-items: center;
      background-color: #F5EDD9;
      border-radius: 8px;
      padding: 0.5rem 1rem;
      margin-bottom: 1rem;
    }

    .search-bar input {
      border: none;
      background-color: transparent;
      outline: none;
      font-size: 1rem;
      color: #888;
      margin-left: 0.5rem;
      width: 100%;
    }

    .applications-list {
      background-color: #FAF7F0;
      border-radius: 8px;
      padding: 1rem;
    }

    .application-item {
      display: flex;
      align-items: center;
      padding: 0.75rem 0;
      border-bottom: 1px solid #e0e0e0;
    }

    .application-item:last-child {
      border-bottom: none;
    }

    .application-item img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 1rem;
    }

    .application-details h3 {
      font-size: 1rem;
      font-weight: 600;
      margin: 0;
      color: #333;
    }

    .application-details p {
      font-size: 0.875rem;
      color: #888;
      margin: 0;
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

  <div class="content">
    <h1>Couriers</h1>

    <div class="search-bar">
      <input type="text" placeholder="Search by name">
    </div>

    <div class="applications-list">
      <div class="application-item">
        <img src="./image/blank.webp" alt="Jonas">
        <div class="application-details">
          <h3>Jonas</h3>
          <p>Colombo</p>
        </div>
      </div>
      <div class="application-item">
        <img src="./image/blank.webp" alt="Molly">
        <div class="application-details">
          <h3>Molly</h3>
          <p>Galle</p>
        </div>
      </div>
      <div class="application-item">
        <img src="./image/blank.webp" alt="Robert">
        <div class="application-details">
          <h3>Robert</h3>
          <p>Jaffna</p>
        </div>
      </div>
      <div class="application-item">
        <img src="./image/blank.webp" alt="Emma">
        <div class="application-details">
          <h3>Emma</h3>
          <p>Matara</p>
        </div>
      </div>
      <div class="application-item">
        <img src="./image/blank.webp" alt="David">
        <div class="application-details">
          <h3>David</h3>
          <p>Colombo</p>
        </div>
      </div>
    </div>
  </div>
  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>