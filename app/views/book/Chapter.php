<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookChapter.css">
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
    ?>

    <!-- Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>
    <div class="title-container">
        <div class="title">
            <h1><?= htmlspecialchars($title_author[0]['BookTitle']); ?></h1>
            <p class="author"><?= htmlspecialchars($title_author[0]['AuthorName']); ?></p>
        </div>
    </div>

    <!-- Chapter Content -->
    <div class="container">

        <h2 class="chapter-title"><?= htmlspecialchars($chapter_content[0]['title']); ?></h2>
        <div class="chapter-content" id="chapterContent">
            <?php
            // $chapter_content[0]['content'] contains the chapter story
            $content = htmlspecialchars($chapter_content[0]['content']);

            // Split the content by newlines into an array
            $paragraphs = explode("\n", $content);

            // Loop through each paragraph and wrap it in <p> tags
            foreach ($paragraphs as $paragraph) {
                // Trim to remove any extra whitespace
                $paragraph = trim($paragraph);
                if (!empty($paragraph)) { // Only output non-empty paragraphs
                    echo "<p>" . $paragraph . "</p>";
                }
            }
            ?>
        </div>
        <div class="navigation">
            <button class="btn" id="prevChapter">Previous Chapter</button>
            <button class="btn" id="nextChapter">Next Chapter</button>
        </div>

        <!-- Comments Section -->
        <div class="comments">
            <h3>Comments (cannot be edited or removed at the moment)</h3>

            <form action="/Free-Write/public/Chapter/Comment" method="post" class="comment-form">
                <textarea name="commentText" placeholder="Add your comment"></textarea>
                <input type="hidden" name="chapterID" value="<?= $chapter_content[0]['chapterID']; ?>">
                <button class="btn" type="submit">Post Comment</button>
            </form>
            <p></p>
            <?php if (!empty($chapter_comments) && is_array($chapter_comments)): ?>
                <?php foreach ($chapter_comments as $comment): ?>
                    <div class="comment">
                        <p>
                            <strong><?= htmlspecialchars($comment['UserName']); ?></strong>
                            <span>
                                <?php
                                $dateString = $comment['DateAdded'];

                                // Create a DateTime object from the string
                                $date = new DateTime($dateString);

                                // Format the date to a more readable format, e.g., 'November 15, 2024, 10:22 AM'
                                $formattedDate = $date->format('F j, Y, g:i A');

                                // Output the formatted date safely using htmlspecialchars
                                echo htmlspecialchars($formattedDate);
                                ?>
                            </span><br />
                            <?= htmlspecialchars($comment['CommentContent']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Be the first to comment</p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="../public/js/Book/bookChapter.js"></script>
</body>

</html>