<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing Section - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>
<body>

    <!-- Writing Section -->
    <main class="writing-section">
        <div class="story-info">
            <h1 class="story-title">
                <?= htmlspecialchars($storyTitle ?? 'Untitled Story') ?>
            </h1>
        </div>

        <div class="action-buttons">
            <button class="save-btn" onclick="window.location.href='/editStory/save/<?= htmlspecialchars($storyId ?? '') ?>'">Save</button>
            <button class="save-btn" onclick="window.location.href='/editStory/save/<?= htmlspecialchars($storyId ?? '') ?>'">Next Chapter</button>
        </div>
        <div class="text-editor">
            <textarea id="story-editor-chapter" placeholder="Chapter Name"><?= htmlspecialchars($chapterTitle ?? 'Chapter 1') ?></textarea>
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

