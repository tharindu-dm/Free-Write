<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="competition-section">
        <div class="spinoff-details">
            <h1><?php echo htmlspecialchars($submission['title']); ?></h1>
            <div class="spinoff-content">
                <div class="book-cover">
                    <img
                        src="/Free-Write/app/images/DesignSubmissions/<?= htmlspecialchars($submission['name'] ?? 'sampleCover.jpg'); ?>">
                </div>

                <div class="spinoff-info">

                    <h3>Last Updated: <?= htmlspecialchars($submission['updated_at']); ?></h3>
                    <p class="synopsis"><?= htmlspecialchars($submission['description']); ?></p>
                </div>
            </div>

            <div class="requested-by">
                <h4>Submitted By: <?= htmlspecialchars($submission['userID']); ?></h4>
                <button class="book-btn"
                    onclick="window.location.href='/Free-Write/public/User/Profile?user=<?= htmlspecialchars($submission['userID']); ?>'">
                    View Profile
                </button>
            </div>

            <div class="button-container">
                <button type="button" class="edit-btn cancel-btn"
                    onclick="window.location.href='/Free-Write/public/Writer/Submissions/<?= htmlspecialchars($submission['competitionID']); ?>'">Back</button>
                <?php if ($submission['status'] === 'selected' && $competition['status'] === 'ended'): ?>
                    <button class="delete-btn"> Selected </button>
                <?php elseif ($competition['status'] === 'ended'): ?>
                    <button class="delete-btn"> Rejected </button>
                <?php else: ?>
                    <div class="right-buttons">
                        <button class="edit-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/Win/<?= htmlspecialchars($submission['submissionID']); ?>'">Choose
                            As Winner</button>
                    </div>
                <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>