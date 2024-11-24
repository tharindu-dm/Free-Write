<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>
<body>

    <!-- Publishers Section -->
    <main class="publishers-section">
        <h1>Submitted Covers</h1>
        <!-- Covers Grid -->
        <div class="covers-grid">
            <?php foreach ($covers as $cover) : ?>
                <div class="cover-item" onclick="window.location.href='coverDetails.php?id=<?= $cover['id'] ?>'">
                    <img 
                        src="<?= htmlspecialchars($cover['cover_image']) ?>" 
                        alt="Cover by <?= htmlspecialchars($cover['username']) ?>"
                        onerror="this.src='/public/images/default-cover.png'"
                    >
                    <h3>$<?= htmlspecialchars(number_format($cover['price'], 2)) ?></h3>
                    <p>by <?= htmlspecialchars($cover['username']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>
</html>
