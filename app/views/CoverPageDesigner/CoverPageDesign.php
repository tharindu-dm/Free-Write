<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= htmlspecialchars($design['name']) ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/CoverPageDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                    alt="<?= htmlspecialchars($design['name']) ?>">
            </div>

            <div class="product-details">
                <h1><?= htmlspecialchars($design['name']) ?></h1>

                <div class="designer-info">
                    <div class="avatar"><?= substr($designerName ?? 'D', 0, 1) ?></div>
                    <div class="details">
                        <div class="name"><?= htmlspecialchars($designerName ?? 'Designer') ?></div>
                        <div class="created-date">Created on
                            <?= date('M d, Y', strtotime($design['date_created'] ?? 'now')) ?></div>
                    </div>
                </div>

                <p class="product-description"><?= htmlspecialchars($design['description']) ?></p>

                <div class="action-buttons">
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $design['artist']): ?>
                        <a href="/Free-Write/public/Designer/edit/<?= $design['covID'] ?>">
                            <button class="edit-button">Edit Design</button>
                        </a>
                        <form action="/Free-Write/public/Designer/delete/<?= $design['covID'] ?>" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this design? This action cannot be undone.');">
                            <button type="submit" class="delete-button">Delete Design</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="horizontal-divider">

            <div class="rating-container">
                <div class="rating-summary">
                    <h3>Cover Design Rating</h3>
                    <div class="rating-value">
                        <?= number_format($ratingData['averageRating'] ?? 0, 1) ?>
                        <div class="rating-stars">
                            <?php
                            $rating = round($ratingData['averageRating'] ?? 0);
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<span class="star">★</span>';
                                } else {
                                    echo '<span class="star" style="color: #e0e0e0;">★</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <p class="rating-count">Based on <?= $ratingData['totalUsers'] ?? 0 ?> ratings</p>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>

</body>

</html>