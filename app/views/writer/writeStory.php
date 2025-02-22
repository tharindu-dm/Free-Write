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
    //show($data);
    ?>

    <!-- Writing Section -->
    <form action="/Free-Write/public/Writer/saveChapter" method="POST" enctype="multipart/form-data">
    <main class="writing-section">
        <div class="story-info">
            <h1 class="story-title">
                <?php echo htmlspecialchars($book['title']); ?>
            </h1>
        </div>

        
        <div class="text-editor">
            <textarea id="story-editor-chapter" name="story-editor-chapter"
                placeholder="Chapter Name"><?= htmlspecialchars($chapter ?? 'Untitled') ?></textarea>
        </div>

        <div class="text-editor">
            <textarea id="story-editor" name="story-editor"
                placeholder="Type your text"><?= htmlspecialchars($content ?? '') ?></textarea>
        </div>
        <div class="action-buttons">
            <button type="submit" class="save-btn"
                onclick="window.location.href='/editStory/saveChapter/<?= htmlspecialchars($chapterId ?? '') ?>'">Save</button>
            
            <input type="hidden" name="bID" value="<?php echo $bookId; ?>">
        </div>

    </main>
    </form>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>