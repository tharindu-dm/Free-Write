<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cover Page Designers</title>
  <link rel="stylesheet" href="/Free-Write/public/css/Designers&Design.css">
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
    case 'inst':
      require_once "../app/views/layout/header-inst.php";
      break;
    default:
      require_once "../app/views/layout/header.php";
  }
  //show($data);
  ?>

  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>Explore and Share Free-Write Designer Masterpieces</h1>
        <p>Join a community of passionate writers and readers. Discover new fictions, participate in contests, and
          connect with fellow creatives.</p>
        <div class="hero-actions">
          <a href="/Free-Write/public/Browse"><button class="btn btn-primary">Browse For Design</button></a>
          <a href="#"><button class="btn btn-secondary">Share Your Design</button></a>
        </div>
      </div>
    </section>

    <section class="cover-page-designers">
      <h2>Popular Cover Page Designers</h2>
      <div class="designer-profiles">
        <div class="designer-profile">
          <a href="#">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Designer Name 1">
            <h3>San Hua</h3>
          </a>
        </div>
        <div class="designer-profile">
          <a href="#">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Designer Name 2">
            <h3>Zhe Zhi</h3>
          </a>
        </div>
        <div class="designer-profile">
          <a href="#">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Designer Name 3">
            <h3>Barbara Rose</h3>
          </a>
        </div>
        <div class="designer-profile">
          <a href="#">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Designer Name 4">
            <h3>Jean Gunhilder</h3>
          </a>
        </div>
        <div class="designer-profile">
          <a href="#">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Designer Name 5">
            <h3>Cappuccino Legaro</h3>
          </a>
        </div>
      </div>
      <div class="pagination">
        <button>&lt;</button>
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
        <button>&gt;</button>
      </div>
    </section>

    <section class="cover-pages">
      <h2>Popular Cover Pages</h2>
      <div class="cover-page-designs">
        <div class="cover-page-design">
          <a href="#">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Page Design 1">
            <h3>Cover Page Design 1</h3>
          </a>
        </div>

        <div class="cover-page-design">
          <a href="#">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Page Design 2">
            <h3>Cover Page Design 2</h3>
          </a>
        </div>

        <div class="cover-page-design">
          <a href="#">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Page Design 3">
            <h3>Cover Page Design 3</h3>
          </a>
        </div>

        <div class="cover-page-design">
          <a href="#">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Page Design 4">
            <h3>Cover Page Design 4</h3>
          </a>
        </div>

        <div class="cover-page-design">
          <a href="#">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Page Design 5">
            <h3>Cover Page Design 5</h3>
          </a>
        </div>
      </div>

      <div class="pagination">
        <button>&lt;</button>
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
        <button>&gt;</button>
      </div>

    </section>
  </main>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>

  <script src="Designers&Design.js"></script>
</body>

</html>