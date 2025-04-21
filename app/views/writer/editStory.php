<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing Section - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'wricov':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <!-- Writing Section -->
    <form action="/Free-Write/public/Writer/UpdateChapter" method="POST" enctype="multipart/form-data">
        <main class="writing-section">
            <!-- Title -->
            <div class="space_between">
                <h1 class="story-title">
                    <?php
                    echo htmlspecialchars($chapter['BookTitle']); ?>
                </h1>
                <div class="input-group">
                    <label for="price">Price(LKR):</label>
                    <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Free"
                        value="<?= htmlspecialchars($chapter['price'] ?? ''); ?>">
                </div>
            </div>

            <!-- Chapter Name -->
            <div class="text-editor">
                <textarea id="story-editor-chapter" name="story-editor-chapter"
                    placeholder="Chapter Name"><?= htmlspecialchars($chapter['ChapterTitle'] ?? 'Untitled') ?></textarea>
            </div>

            <!-- Story Editor -->
            <div class="text-editor">
                <textarea id="story-editor" name="story-editor"
                    placeholder="Type your text..."><?= htmlspecialchars($chapter['ChapterContent'] ?? '') ?></textarea>
            </div>


            <div class="lastUpdated">
                <p>Last Updated: <?= htmlspecialchars($chapter['ChapterLastUpdated'] ?? '') ?></p>
            </div>


            <!-- Action Buttons -->


            <div class="button-container">
                <button type="button" class="edit-btn cancel-btn"
                    onclick="event.preventDefault(); window.history.back();">Back</button>


                <div class="right-buttons">
                    <button type="submit" class="edit-btn">Save</button>
                    <button id="delete-details" class="delete-btn">Delete</button>
                </div>
            </div>

            <input id="bookID_hidden" type="hidden" name="BookID" value="<?= $chapter['BookID'] ?>">

            <?php if (isset($chapter['chapterID'])): ?>
                <input type="hidden" name="chapterID" value="<?= $chapter['chapterID'] ?>">
            <?php endif; ?>
    </form>
    <!-- Delete Overlay -->
    <div class="deleteOverlay-container">
        <div class="deleteOverlay">
            <h2>Are you sure you want to delete this Chapter?</h2>
            <form action="/Free-Write/public/Writer/deleteChapter/" method="POST">
                <input type="hidden" name="BookID" value="<?= htmlspecialchars($chapter['BookID']); ?>">
                <input type="hidden" name="chapterID" value="<?= htmlspecialchars($chapter['chapterID']); ?>">
                <p><strong>Book</strong> - <?= htmlspecialchars($chapter['BookTitle']); ?> </p>
                <p><strong>Chapter</strong> - <?= htmlspecialchars($chapter['ChapterTitle']); ?></p><br>
                <div class="right-buttons">
                    <button class="delete-btn" type="submit">Delete</button>
                    <button class="edit-btn" type="button" id="cancelDelete">Cancel</button>
                </div>

                </main>
            </form>

            <!-- Footer -->
            <?php
            require_once "../app/views/layout/footer.php";
            ?>
            <script>
                window.onload = function () {
                    const deleteCompBtn = document.getElementById("delete-details");
                    const cancelDeleteBtn = document.getElementById("cancelDelete");
                    const deleteOverlay = document.querySelector(".deleteOverlay-container");

                    if (!deleteCompBtn || !cancelDeleteBtn || !deleteOverlay) {
                        console.warn("Missing elements: Check IDs in HTML.");
                        return;
                    }

                    // Show delete confirmation
                    deleteCompBtn.addEventListener("click", (e) => {
                        e.preventDefault();
                        deleteOverlay.style.display = "flex";
                    });

                    // Hide delete confirmation
                    cancelDeleteBtn.addEventListener("click", (e) => {
                        e.preventDefault();
                        deleteOverlay.style.display = "none";
                    });
                };
            </script>
</body>

</html>