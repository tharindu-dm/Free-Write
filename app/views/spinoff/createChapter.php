<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinoff chapter</title>
    <link rel="stylesheet" href="/Free-Write/public/css/spinoffWriteChapter.css">
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
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>
    <!-- Chapter Content -->
    <div class="container">
        <h2 class="chapter-title">Write Your Chapter</h2>
        <p class="synopsis">please assume reader completed the starting chapter</p>
        <h3 class="synopsis"><?= htmlspecialchars($spinoff['title']) ?></h3>
        <p class="synopsis"><?= htmlspecialchars($spinoff['synopsis']) ?></p>

        <form id="chapter-form" action="saveChapter" method="POST">
            <input type="hidden" name="spinoffID" value="<?= $spinoff['spinoffID'] ?>">
            <label for="chapter-title">Chapter Title</label>
            <input type="text" id="chapter-title" name="chapter_title" placeholder="Enter chapter title here" required maxlength="45">

            <label for="chapter-content">Chapter Content</label>
            <textarea id="chapter-content" name="chapter_content" placeholder="Write your chapter here..."
                required
                <?php if(true):?>
                    value="<?= htmlspecialchars($spinoff['content']) ?>"
                    <?php endif;?>
                ></textarea>

            <p id="word-count-display" class="word-count">0/3000 words</p>

            <p class="error" id="word-count-error">Too many words! The limit is 3000 words.</p>

            <div class="buttons">
                <button type="button" class="delete-btn">Delete Chapter</button>
                <button type="submit" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="/Free-Write/public/js/Spinoff/createChapter.js"></script>
</body>

</html>