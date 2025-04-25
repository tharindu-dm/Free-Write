<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cover Page Designers</title>
  <link rel="stylesheet" href="/Free-Write/public/css/Designers&Design.css">
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php";
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
        </div>
      </div>
    </section>

    <section class="cover-page-designers">
      <h2>Popular Cover Page Designers</h2>
      <div class="designer-profiles">
        <?php if (!empty($designers)): ?>
          <?php foreach ($designers as $designer): ?>
            <div class="designer-profile">
              <a href="/Free-Write/public/Designer/publicProfile/<?= htmlspecialchars($designer['userID']) ?>">
                <img
                  src="/Free-Write/app/images/profile/<?= htmlspecialchars($designer['profileImage'] ?? 'profile-image.jpg') ?>"
                  alt="<?= htmlspecialchars($designer['firstName'] . ' ' . $designer['lastName']) ?>">
                <h3><?= htmlspecialchars($designer['firstName'] . ' ' . $designer['lastName']) ?></h3>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No designers found</p>
        <?php endif; ?>
      </div>

      <div class="pagination">
        <?php
        $designerPrevPage = max(1, $designerCurrentPage - 1);
        $designerNextPage = min($designerTotalPages, $designerCurrentPage + 1);
        ?>
        <form method="get" style="display:inline;">
          <input type="hidden" name="designer_page" value="<?= $designerPrevPage ?>">
          <input type="hidden" name="page" value="<?= $currentPage ?>">
          <button type="submit" <?= $designerCurrentPage <= 1 ? 'disabled' : '' ?>>Previous</button>
        </form>
        <span style="margin: 0 1rem; font-weight: bold;"><?= $designerCurrentPage ?></span>
        <form method="get" style="display:inline;">
          <input type="hidden" name="designer_page" value="<?= $designerNextPage ?>">
          <input type="hidden" name="page" value="<?= $currentPage ?>">
          <button type="submit" <?= $designerCurrentPage >= $designerTotalPages ? 'disabled' : '' ?>>Next</button>
        </form>
      </div>
    </section>

    <section class="cover-pages">
      <h2>Popular Cover Pages</h2>
      <div class="cover-page-designs">
        <?php if (!empty($designs) && is_array($designs)): ?>
          <?php foreach ($designs as $design): ?>
            <div class="cover-page-design">
              <a href="/Free-Write/public/Designer/viewDesignForNonOwner/<?= htmlspecialchars($design['covID']) ?>">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                  alt="<?= htmlspecialchars($design['name']) ?>">
                <h3><?= htmlspecialchars($design['name']) ?></h3>
                <!-- <p>Rating: <?//= isset($design['rating']) ? number_format($design['rating'], 2) : '0.00' ?></p> -->
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No cover designs found.</p>
        <?php endif; ?>
      </div>

      <div class="pagination">
        <?php
        $prevPage = max(1, $currentPage - 1);
        $nextPage = min($totalPages, $currentPage + 1);
        ?>
        <form method="get" style="display:inline;">
          <input type="hidden" name="page" value="<?= $prevPage ?>">
          <button type="submit" <?= $currentPage <= 1 ? 'disabled' : '' ?>>Previous</button>
        </form>
        <span style="margin: 0 1rem; font-weight: bold;"><?= $currentPage ?></span>
        <form method="get" style="display:inline;">
          <input type="hidden" name="page" value="<?= $nextPage ?>">
          <button type="submit" <?= $currentPage >= $totalPages ? 'disabled' : '' ?>>Next</button>
        </form>
      </div>

    </section>
  </main>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>

  <script src="Designers&Design.js"></script>
</body>

</html>