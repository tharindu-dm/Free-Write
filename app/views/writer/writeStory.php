<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing Section - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <!-- Writing Section -->
    <form action="/Free-Write/public/Writer/saveChapter" method="POST" enctype="multipart/form-data">
        <main class="writing-section">
            <!-- Title -->
            <div class="space_between">
                <h1 class="story-title">
                    <?php echo htmlspecialchars($book['title']); ?>
                </h1>
                <?php if ($book['price'] === NULL): ?>
                    <div class="input-group">
                        <label for="price">Price(LKR):</label>
                        <input type="number" min="0" step="0.01" id="price" name="price" placeholder="Free">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Chapter Name -->
            <div class="text-editor">
                <textarea id="story-editor-chapter" name="story-editor-chapter" maxlength="45"
                    placeholder="Chapter Name"><?= htmlspecialchars('Chapter ' . $chapterCount) ?></textarea>

            </div>

            <!-- Story Editor -->
            <div class="text-editor">
                <textarea id="story-editor" name="story-editor" placeholder="Type your text..."></textarea>
            </div>



            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="save-btn" onclick="window.history.back();">Cancel</button>
                <button type="submit" class="save-btn">Save</button>

            </div>

            <input id="bookID_hidden" type="hidden" name="bookID" value="<?= $book['bookID'] ?>">

            <?php if (isset($chapter['chapterID'])): ?>
                <input type="hidden" name="chapterID" value="<?= $chapter['chapterID'] ?>">
            <?php endif; ?>

        </main>
    </form>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
    <script src="/Free-Write/public/js/writer/createChapter.js"></script>
</body>

</html>