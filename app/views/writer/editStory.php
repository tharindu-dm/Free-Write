<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>
<body>

    <!-- Writing Section -->
    <main class="writing-section">
        <div class="story-info">
            <h1 class="story-title">
                <?= htmlspecialchars($storyTitle ?? 'Untitled Story') ?>
            </h1>
            <p class="chapter-info">
                <?= htmlspecialchars($chapterTitle ?? 'Chapter 1') ?> 
            </p>
        </div>

        <div class="action-buttons">
            <button class="save-btn" onclick="window.location.href='/editStory/save/<?= htmlspecialchars($storyId ?? '') ?>'">Save</button>
            <button class="save-btn" onclick="window.location.href='/editStory/delete/<?= htmlspecialchars($storyId ?? '') ?>'">Delete</button>
        </div>

        <div class="text-editor">
            <textarea id="story-editor" placeholder="Type your text"><?= htmlspecialchars($storyText ?? '') ?></textarea>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>
</html>
