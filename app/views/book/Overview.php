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
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <?php if (!empty($book) && is_array($book)): ?>
        <div class="container">
            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/public/images/<?= htmlspecialchars($book[0]['cover_image'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($book[0]['title']); ?>">
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
                        <button id="btn-addToList" class="read-button">Add to List
                        </button>
                        <div class="buy-button">
                            <?= $book[0]['price'] === null ? 'Read for Free' : 'Purchase for LKR. ' . number_format($book[0]['price'], 2); ?>
                            &nbsp;
                            <svg style="height: 1.5rem; width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>

                    </div>
                    <div class="add-to-list">
                        <div class="list-add-container">
                            <h3>Add To Your List</h3>
                            <h4>Title: <?= htmlspecialchars($book[0]['title']); ?> </h4>

                            <form id="add-to-list-form" action="http://localhost/Free-Write/public/Book/List" method="POST">
                                <div class="list-add-radios">
                                    <div>
                                        <label>
                                            <input type="radio" name="list" value="reading">
                                            Reading
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="radio" name="list" value="completed">
                                            Completed
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="radio" name="list" value="hold">
                                            On Hold
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="radio" name="list" value="dropped">
                                            Dropped
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input require type="radio" name="list" value="planned">
                                            Plan to read
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="hidden" name="List_uid"
                                                value="<?= htmlspecialchars($_SESSION['user_id']); ?>">
                                        </label>
                                        <label>
                                            <input type="hidden" name="List_bid"
                                                value="<?= htmlspecialchars($book[0]['bookID']); ?>">
                                        </label>
                                    </div> 
                                </div>

                                <!-- Get the current chapter count and and show, edit JS to check all MAL conditions when selecting completed when not finished publishing
                                <div>                                    
                                    <label>
                                        <input type="number"  name="List_bid"
                                            value="">
                                    </label>
                                </div>-->

                                <div class="list-add-actionBtns">
                                    <button id="cancel-button" type="button" class="add-list-cancel-button">
                                        Cancel
                                    </button>
                                    <button id="subBtn" type="submit" class="add-list-submit-button">Add</button>
                                </div>
                            </form>
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

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="/Free-Write/public/js/Book/bookOverview.js"></script>
</body>

</html>