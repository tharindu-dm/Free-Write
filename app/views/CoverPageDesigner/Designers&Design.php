<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cover Page Designers</title>
  <link rel="stylesheet" href="Designers&Design.css">
</head>
<body>
  <header>
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
  </header>
  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>Explore and Share Incredible Stories</h1>
        <p>Join a community of passionate writers and readers. Discover new fictions, participate in contests, and connect with fellow creatives.</p>
        <div class="hero-actions">
          <button class="btn btn-primary">Browse Stories</button>
          <button class="btn btn-secondary">Start Writing</button>
        </div>
      </div>
      <div class="hero-image">
        <img src="../public/images/CoverPageDesigner/heroImage.jpg!w700wp" alt="Explore and Share Incredible Stories">
      </div>
    </section>
      <section class="cover-page-designers">
        <h2>Popular Cover Page Designers</h2>
        <div class="designer-profiles">
          <div class="designer-profile">
            <a href="#">
              <img src="Designer1.webp" alt="Designer Name 1">
              <h3>Designer Name 1</h3>
            </a>
          </div>
          <div class="designer-profile">
            <a href="#">
              <img src="Designer4.webp" alt="Designer Name 2">
              <h3>Designer Name 2</h3>
            </a>
          </div>
          <div class="designer-profile">
            <a href="#">
              <img src="Designer3.jpg" alt="Designer Name 3">
              <h3>Designer Name 3</h3>
            </a>
          </div>
          <div class="designer-profile">
            <a href="#">
              <img src="Designer2.jpg" alt="Designer Name 4">
              <h3>Designer Name 4</h3>
            </a>
          </div>
          <div class="designer-profile">
            <a href="#">
              <img src="Designer5.avif" alt="Designer Name 5">
              <h3>Designer Name 5</h3>
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
              <img src="CoverPageDesign1.webp" alt="Cover Page Design 1">
              <h3>Cover Page Design 1</h3>
            </a>
          </div>
          <div class="cover-page-design">
            <a href="#">
              <img src="CoverPageDesign2.webp" alt="Cover Page Design 2">
              <h3>Cover Page Design 2</h3>
            </a>
          </div>
          <div class="cover-page-design">
            <a href="#">
              <img src="CoverPageDesign3.jpg" alt="Cover Page Design 3">
              <h3>Cover Page Design 3</h3>
            </a>
          </div>
          <div class="cover-page-design">
            <a href="#">
              <img src="CoverPageDesign4.jpg" alt="Cover Page Design 4">
              <h3>Cover Page Design 4</h3>
            </a>
          </div>
          <div class="cover-page-design">
            <a href="#">
              <img src="CoverPageDesign6.webp" alt="Cover Page Design 5">
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
