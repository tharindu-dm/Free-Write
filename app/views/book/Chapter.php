<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/bookChapter.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <!-- Chapter Menu -->
        <div class="chapter-menu">
            <h2>Chapters</h2>
            <ul id="chapterMenu">
                <?php foreach ($chapterList as $chapter): ?>
                    <li>
                        <a
                            href="/Free-Write/public/<?= ($chapterDetails['type'] == 'book') ? 'Book' : 'Spinoff' ?>/Chapter/<?= $chapter['chapterID']; ?>"><?= htmlspecialchars($chapter['title']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Chapter Content -->
            <div class="container">
                <div class="title-container">
                    <div class="title">
                        <h1><?= htmlspecialchars($chapterDetails['title_author'][0]['BookTitle']); ?></h1>
                        <p class="author">By <?= htmlspecialchars($chapterDetails['title_author'][0]['AuthorName']); ?>
                        </p>
                        <hr>
                    </div>
                </div>

                <h2 class="chapter-title"><?= htmlspecialchars($chapterDetails['chapter_content'][0]['title']); ?></h2>
                <div class="chapter-content" id="chapterContent">
                    <?php
                    $content = htmlspecialchars($chapterDetails['chapter_content'][0]['content']);
                    $paragraphs = explode("\n", $content);
                    foreach ($paragraphs as $paragraph) {
                        $paragraph = trim($paragraph);
                        if (!empty($paragraph)) {
                            echo "<p>" . $paragraph . "</p>";
                        }
                    }
                    ?>
                </div>

                <div class="navigation">
                    <!--<button class="btn" id="prevChapter" <?= $prevChapterID ? "onclick=\"location.href='?chapterID=$prevChapterID'\"" : 'disabled'; ?>>
                        Previous Chapter
                    </button>
                    <button class="btn" id="nextChapter" <?= $nextChapterID ? "onclick=\"location.href='?chapterID=$nextChapterID'\"" : 'disabled'; ?>>
                        Next Chapter
                    </button>
                    <button class="btn" id="prevChapter">
                        Previous Chapter
                    </button>
                    <button class="btn" id="nextChapter">
                        Next Chapter
                    </button>-->
                </div>

                <!-- Comments Section -->
                <?php if (splitURL()[0] == 'book'): ?>
                    <div class="comments">
                        <h3>Comments</h3>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form action="/Free-Write/public/Chapter/Comment" method="post" class="comment-form">
                                <textarea name="commentText" placeholder="Add your comment"></textarea>
                                <input type="hidden" name="chapterID"
                                    value="<?= $chapterDetails['chapter_content'][0]['chapterID']; ?>">
                                <button class="btn" type="submit">Post Comment</button>
                            </form>
                        <?php else: ?>
                            <p><a href="/Free-Write/public/Login">Log in</a> to make a comment</p>
                        <?php endif; ?>
                        <hr />

                        <?php if (!empty($chapterDetails['chapter_comments']) && is_array($chapterDetails['chapter_comments'])): ?>
                            <?php foreach ($chapterDetails['chapter_comments'] as $comment): ?>
                                <div class="comment">
                                    <p>
                                        <strong><?= htmlspecialchars($comment['UserName']); ?></strong>
                                        <span><?= (new DateTime($comment['DateAdded']))->format('F j, Y, g:i A'); ?></span><br>
                                        <?= htmlspecialchars($comment['CommentContent']); ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Be the first to comment</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Advertisement Section -->
        <?php if ((isset($_SESSION['user_premium']) && $_SESSION['user_premium'] == 0) || !isset($_SESSION['user_id'])): ?>
            <div>
                <img src="/Free-Write/public/images/ad.png" alt="Ad" class="ad-image">
            </div>
        <?php endif; ?>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/Book/bookChapter.js"></script>
</body>

</html>