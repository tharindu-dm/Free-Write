<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="spinoff-view">
        <div class="spinoff-details">
            <h1><?php echo htmlspecialchars($spinoff['title']); ?></h1>
            <div class="spinoff-content">
                <div class="cover-image">
                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($spinoff['cover_image'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($spinoff['title']); ?>">
                </div>

                <div class="spinoff-info">
                    <div class="space_between">
                        <h4><?= htmlspecialchars($spinoff['fromBook']); ?></h4>
                        <button class="book-btn"
                            onclick="window.location.href='/Free-Write/public/writer/Overview/<?= htmlspecialchars($spinoff['bookID']); ?>'">
                            View Book
                        </button>
                    </div>
                    <h3>From Chapter: <?= htmlspecialchars($spinoff['ChapterTitle']); ?></h3>
                    <p class="synopsis"><?= htmlspecialchars($spinoff['synopsis']); ?></p>
                </div>
            </div>
            
            <div class="requested-by">
                <h4>Requested By: <?= htmlspecialchars($spinoff['creator']); ?></h4>
                <button class="book-btn"
                    onclick="window.location.href='/Free-Write/public/User/Profile?user=<?= htmlspecialchars($spinoff['creatorID']); ?>'">
                    View Profile
                </button>
            </div>

            <div class="button-container">
                <!-- Left side: Cancel button -->
                <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>

                <!-- Right side: Edit and Delete buttons -->
                <?php if ($spinoff['isAcknowledge'] == 0): ?>
                    <div class="right-buttons">
                        <button class="edit-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/acceptSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">Accept</button>
                        <button class="delete-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/rejectSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">Reject</button>
                    </div>
                <?php endif; ?>
            </div>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>