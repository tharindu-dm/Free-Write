<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= htmlspecialchars($design['name']) ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/CoverPageDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>
    
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                    alt="<?= htmlspecialchars($design['name']) ?>">
            </div>
            <div class="product-details">
                <h1><?= htmlspecialchars($design['name']) ?></h1>
                <p class="product-description"><?= htmlspecialchars($design['description']) ?></p>
                <div class="action-buttons">
                    <?php if ($_SESSION['user_id'] == $design['artist']): ?>
                        <a href="/Free-Write/public/Designer/edit/<?= $design['covID'] ?>"><button
                                class="edit-button">Edit</button></a>
                    <?php endif; ?>
                    <form action="/Free-Write/public/Designer/delete/<?= $design['covID'] ?>" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this design?');">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            </div>
            <div class='rating-container'>
                <h3>Rating</h3>
                <div class="rating-value"><?= number_format($ratingData['averageRating'] ?? 0, 1) ?>/5</div>
                <p class="rating-count">Total Ratings: <?= $ratingData['totalUsers'] ?? 0 ?></p>
            </div>
        </div>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="script.js"></script>
</body>

</html>