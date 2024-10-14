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
    require_once "../app/views/layout/header.php";
    ?>
    <?php if (!empty($book) && is_array($book)): ?>
        <div class="container">
            <div class="product-layout">
                <div class="product-image">
                    <img src="../public/images/<?= htmlspecialchars($book[0]['cover_image']); ?>" alt="Swallow">
                    <div class="author-details">
                        <h3>Other Details</h3>
                        <p><strong>Author:</strong><?= htmlspecialchars($book[0]['author']); ?></p>
                        <p><strong>Last Updated:</strong> <?= explode(' ', $book[0]['lastUpdateDate'])[0]; ?></p>
                        <p><strong>Status:</strong>
                            <?= ($book[0]['isCompleted'] == 1) ? "Completed" : "Ongoing";
                            ?>
                        </p>
                    </div>
                </div>
                <div class="product-info">
                    <h1><?= htmlspecialchars($book[0]['title']); ?></h1>
                    <p class="description">
                        <?= htmlspecialchars($book[0]['Synopsis']); ?>
                    </p>
                    <div class="read-button-container">
                        <button class="read-button">
                            Read &nbsp;
                            <svg style="height: 1.5rem; width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        <div class="buy-button">
                            Purchase for LKR <?= htmlspecialchars($book[0]['price']); ?>
                        </div>
                    </div>


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
                                                href="http://localhost/Free-Write/public/book/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>"><?= htmlspecialchars($chap['title']); ?></a>
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

    <?php
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="../public/js/Book/bookOverview.js"></script>
</body>

</html>