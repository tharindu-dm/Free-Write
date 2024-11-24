<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookOverview.css">
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
    show($data);
    ?>

    <?php if (!empty($content) && is_array($content)): ?>
        <div class="container">
            <div class="title-container">
                <div class="title">
                    <h1>THE BOOK TITLE OF THE PARENT BOOK</h1>
                    <h2>A Reader-Made Spinoff</h2>
                </div>
            </div>

            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/public/images/<?= htmlspecialchars($content[0]['cover_image'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($content[0]['title']); ?>">
                    <div class="author-details">
                        <h3>Other Details</h3>
                        <p><strong>Author:</strong><?= htmlspecialchars($content[0]['author']); ?></p>
                        <p><strong>Last Updated:</strong> <?= explode(' ', $content[0]['lastUpdateDate'])[0]; ?></p>
                        <p><strong>Status:</strong>
                            <?= ($content[0]['isCompleted'] == 1) ? "Completed" : "Ongoing";
                            ?>
                        </p>
                    </div>
                </div>

                <div class="product-info">
                    <h1><?= htmlspecialchars($content[0]['title']); ?></h1>
                    <p class="description">
                        <?= htmlspecialchars($content[0]['synopsis']); ?>
                    </p>

                    <div class="table-of-contents">
                        <h2>Table of Contents</h2>
                        <?php if (!empty($chapters) && is_array($chapters)): ?>
                            <table border="1">
                                <tr>
                                    <th>Chapter</th>
                                    <th>Last Updated</th>
                                </tr>
                                <?php foreach ($chapters as $chap): ?>
                                    <tr>
                                        <td><a
                                                href="/Free-Write/public/book/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>"><?= htmlspecialchars($chap['title']); ?></a>
                                        </td>
                                        <td><?= htmlspecialchars($chap['lastUpdated']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>No chapters found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>No book found.</p>
    <?php endif; ?>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="/Free-Write/public/js/Book/bookOverview.js"></script>
</body>

</html>