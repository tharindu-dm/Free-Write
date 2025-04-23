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
    require_once "../app/views/layout/headerSelector.php";
    ?>

    <!-- Main Content -->
    <main class="book-section">

        <div class="books-grid">
            <?php if (!empty($submissions) && is_array($submissions)): ?>
                <?php foreach ($submissions as $submission): ?>

                    <a href="/Free-Write/public/Writer/viewSubmission/<?= htmlspecialchars($submission['submissionID']); ?>">

                        <div class="book-card">
                            <img src="/Free-Write/app/images/DesignSubmissions/<?= htmlspecialchars($submission['name'] ?? 'sampleCover.jpg'); ?>"
                                alt="Cover Image of <?= htmlspecialchars($submission['title']); ?>">
                            <h4>
                                <?= strlen($submission['title']) > 20 ? htmlspecialchars(substr($submission['title'], 0, 17)) . '...' : htmlspecialchars($submission['title']); ?>
                            </h4>
                            <p>
                                <?= date('Y-m-d', strtotime($submission['created_at'])); ?>
                            </p>
                            <h4>
                                By:
                            </h4>
                        </div>
                    </a>
                <?php endforeach; ?>

            <?php else: ?>
                <p>No Submissions available.</p>
            <?php endif; ?>
        </div>
        </div>


        <!-- Centered Buttons -->
        <div class="button-container">
            <button type="button" class="edit-btn cancel-btn"
                onclick="window.location.href='/Free-Write/public/Writer/ViewCompetition/<?= htmlspecialchars($submission['competitionID']); ?>'">Back</button>
        </div>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>