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
            <div class="space_between">
                <h1 class="story-title">
                    <?php echo htmlspecialchars($book['title']); ?>
                </h1>
                <?php if($book['price'] === NULL): ?>
                <div class="input-group">
                    <label for="price">Price(LKR):</label>
                    <input type="number" min="0" id="price" name="price" placeholder="Free">
                </div>
              <?php endif; ?>
            </div>

            <!-- Chapter Name -->
            <div class="text-editor">
                <textarea id="story-editor-chapter" name="story-editor-chapter"
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
</body>

</html>