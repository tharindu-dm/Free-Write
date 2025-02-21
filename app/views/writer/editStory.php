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
    <form action="/Free-Write/public/Writer/saveChapter" method="POST" enctype="multipart/form-data">
        <main class="writing-section">
            <!-- Title -->
            <div class="story-info">
                <h1 class="story-title">
                    <?php echo htmlspecialchars($chapter['BookTitle']); ?>
                </h1>
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

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="submit" class="save-btn">Save</button>
                <button type="button" class="cancel-btn" onclick="window.history.back();">Cancel</button>
            </div>

            <input type="hidden" name="bID" value="<?php echo $bookId; ?>">
        </main>
    </form>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>
