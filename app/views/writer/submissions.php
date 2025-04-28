<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Submissions | Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writerCompSubmission.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/headerSelector.php";
    ?>

    <!-- Main Content -->
    <main>
        <section class="submission-section">
            <h2 class="section-header">Competition Submissions</h2>
            <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />

            <?php if (!empty($submissions) && is_array($submissions)): ?>
                <div class="books-grid">
                    <?php foreach ($submissions as $submission): ?>
                        <a
                            href="/Free-Write/public/Writer/viewSubmission/<?= htmlspecialchars($submission['submissionID']); ?>">
                            <div class="book-card">
                                <img src="/Free-Write/app/images/DesignSubmissions/<?= htmlspecialchars($submission['name'] ?? 'sampleCover.png'); ?>"
                                    alt="Cover Image of <?= htmlspecialchars($submission['title']); ?>">
                                <div class="card-content">
                                    <h3 class="book-title">
                                        <?= strlen($submission['title']) > 20 ? htmlspecialchars(substr($submission['title'], 0, 17)) . '...' : htmlspecialchars($submission['title']); ?>
                                    </h3>
                                    <p class="book-date">
                                        <?= date('M d, Y', strtotime($submission['created_at'])); ?>
                                    </p>
                                    <p class="book-author">
                                        By: <?= htmlspecialchars($submission['author'] ?? 'Anonymous'); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p>No submissions available for this competition yet.</p>
                    <p>Be the first to submit your work!</p>
                </div>
            <?php endif; ?>

            <!-- Centered Buttons -->
            <div class="button-container">
                <button type="button"
                    onclick="window.location.href='/Free-Write/public/Writer/ViewCompetition/<?= htmlspecialchars($cID); ?>'">
                    Back to Competition
                </button>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>