<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinoff chapter</title>
    <link rel="stylesheet" href="/Free-Write/public/css/spinoffWriteChapter.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <!-- Chapter Content -->
    <div class="container">
        <h2 class="chapter-title">Write Your Chapter</h2>
        <h3 class="synopsis"><?= htmlspecialchars($spinoff['title']) ?></h3>
        <p class="synopsis"><?= htmlspecialchars($spinoff['synopsis']) ?></p>

        <form id="chapter-form"
            action="<?= (splitURL()[1] == 'ChapEdit') ? '/Free-Write/public/Spinoff/updateChapter' : 'saveChapter' ?>"
            method="POST">
            <input id="spinoffID_hidden" type="hidden" name="spinoffID" value="<?= $spinoff['spinoffID'] ?>">

            <?php if (isset($chapter['chapterID'])): ?>
                <input type="hidden" name="chapterID" value="<?= $chapter['chapterID'] ?>">
            <?php endif; ?>

            <label for="chapter-title">Chapter Title</label>
            <input type="text" id="chapter-title" name="chapter_title" placeholder="Enter chapter title here" required
                maxlength="45" <?php if (isset($chapter['title'])): ?>
                    value="<?= htmlspecialchars($chapter['title']) ?>" <?php endif; ?>>

            <label for="chapter-content">Chapter Content</label>
            <textarea id="chapter-content" name="chapter_content" placeholder="Write your chapter here..."
                required><?php if (isset($chapter['content'])): ?><?= htmlspecialchars($chapter['content']) ?><?php endif; ?></textarea>


            <p id="word-count-display" class="word-count">0/3000 words</p>

            <p class="error" id="word-count-error">Too many words! The limit is 3000 words.</p>

            <div class="buttons">
                <div>
                    <?php if (splitURL()[1] == 'ChapEdit'): ?>
                        <button id="spinoff_chapter_delete_btn" type="button" class="delete-btn">Delete Chapter</button>
                    <?php endif; ?>
                    <button id="spinoff_chapter_discard_btn" type="button" class="discard-btn">Discard All
                        Changes</button>
                </div>

                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <!-- Delete Chapter Overlay-->
    <?php if (splitURL()[1] == 'ChapEdit'): ?>
        <div class="delete_spinoff_chapter_overlay">
            <div class="overlay-container">
                <div class="overlay-content">
                    <h2 style="color:#ff4444;">Delete Chapter</h2>
                    <p>Are you sure you want to delete this chapter?</p>
                    <p>Please know the <strong>chapter will be permanently deleted</strong> and cannot be recovered.
                    </p>
                    <div class="overlay-buttons">
                        <button id="cancelDeleteBtn" class="cancel-btn">Cancel</button>
                        <form method="POST" id="deleteOverlayForm" action="/Free-Write/public/Spinoff/deleteChap">
                            <input type="hidden" name="chapterID" value="<?= $chapter['chapterID'] ?>">
                            <input type="hidden" name="spinoffID" value="<?= $spinoff['spinoffID'] ?>">
                            <button id="deleteChapterBtn" class="delete-btn">Delete Chapter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Discard changes Chapter Overlay-->
    <div class="discard_spinoff_chapter_overlay">
        <div class="overlay-container">
            <div class="overlay-content">
                <h2>Discard Changes</h2>
                <p>Are you sure you want to discard all changes?</p>
                <div class="overlay-buttons">
                    <button id="cancelDiscardBtn" class="cancel-btn">Cancel</button>
                    <button id="discardChangesBtn" class="discard-btn">Discard Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/Free-Write/public/js/Spinoff/createChapter.js"></script>
    <script src="/Free-Write/public/js/Spinoff/spinoffChapDeleteDiscard.js"></script>
</body>

</html>