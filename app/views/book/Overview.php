<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <?php if (!empty($book) && is_array($book)): ?>
        <main class="container">
            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book[0]['cover_image'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($book[0]['title']); ?>">
                    <div class="author-details">
                        <h3><?= htmlspecialchars($book[0]['authorName']); ?></h3>
                        <div class="author-detail-btns">
                            <a
                                href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($book[0]['author']); ?>"><button>Profile</button></a>
                            <a
                                href="/Free-Write/public/Writer/Donate?user=<?= htmlspecialchars($book[0]['author']); ?>"><button>Donate</button></a>
                        </div>
                    </div>
                    <div class="other-details">
                        <h3>Other Details</h3>
                        <p><strong>Last Updated:</strong> <?= explode(' ', $book[0]['lastUpdateDate'])[0]; ?></p>
                        <p><strong>Status:</strong>
                            <?= ($book[0]['isCompleted'] == 1) ? "Completed" : "Ongoing";
                            ?>
                        </p>
                    </div>
                </div>

                <div class="product-info">
                    <h1><?= htmlspecialchars($book[0]['title']); ?></h1>
                    <div class="rating-container">
                        <div class="rating">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            &nbsp; <?= htmlspecialchars($book[0]['viewCount']); ?> Views
                        </div>
                        <div class="rating">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd"
                                    d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                                    clip-rule="evenodd" />
                            </svg>
                            &nbsp;<?php if (!$rating): ?>
                                <?= 'Be the first to rate!'; ?>
                            <?php else: ?>
                                <?= htmlspecialchars($rating[0]['AverageRating']); ?>
                                | <?= htmlspecialchars($rating[0]['RatingCount']); ?> ratings
                            <?php endif; ?>
                        </div>
                        <div class="rating-select">
                            <form action="/Free-Write/public/Book/AddRating" method="POST">
                                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book[0]['bookID']); ?>">
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <button type="submit" class="rate-btn">Rate</button>
                            </form>
                        </div>
                        <div class="rating-select">
                            <form action="/Free-Write/public/Book/AddToCollection" method="POST">
                                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book[0]['bookID']); ?>">

                                <div class="dropdown">
                                    <button type="button" class="dropbtn">Select Collection</button>
                                    <div class="dropdown-content">
                                        <?php foreach ($collections as $collection): ?>
                                            <label>
                                                <input type="checkbox" name="collections[]"
                                                    value="<?= htmlspecialchars($collection['collectionID']); ?>">
                                                <?= htmlspecialchars($collection['collectionName']); ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <button type="submit" class="rate-btn">Add Book</button>
                            </form>
                        </div>
                    </div>
                    <p class="description">
                        <?= htmlspecialchars($book[0]['Synopsis']); ?>
                    </p>
                    <div class="read-button-container">

                        <button id="btn-addToList" class="read-button">
                            <?php if ($inList === null): ?>
                                <p><?= 'Add To List'; ?></p>
                            <?php else: ?>
                                In <?= htmlspecialchars(ucfirst($inList)) ?> List
                            <?php endif; ?>
                        </button>
                        <div class="buy-button">
                            <?php if ($book[0]['price'] === null): ?>
                                <p><?= 'Read for Free'; ?></p>
                            <?php elseif ($bought): ?>
                                <p> <?= 'Already Purchased'; ?></p>

                            <?php else: ?>
                                <a href='/Free-Write/public/Payment/Book/<?= htmlspecialchars($book[0]['bookID']); ?>'>
                                    <?= 'Buy LKR. ' . number_format($book[0]['price'], 2); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <button id="btn-create-spinoff" class="read-button">Create A Spinoff
                        </button>
                    </div>

                    <div class="add-to-list">
                        <div class="list-add-container">
                            <h3>Add To Your List</h3>
                            <h4>Title: <?= htmlspecialchars($book[0]['title']); ?> </h4>
                            <?php
                            $action = $inList === null ? '/Free-Write/public/BookList/addToList' : '/Free-Write/public/BookList/updateList';
                            ?>

                            <form id="add-to-list-form" action="<?= $action ?>" method="POST">

                                <div class="list-add-radios">
                                    <div>
                                        <label class="add-list-radio-labels">
                                            <input type="radio" name="status" value="reading">
                                            <h5>Reading</h5>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="add-list-radio-labels">
                                            <input type="radio" name="status" value="completed">
                                            <h5>Completed</h5>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="add-list-radio-labels">
                                            <input type="radio" name="status" value="hold">
                                            <h5>On Hold</h5>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="add-list-radio-labels">
                                            <input type="radio" name="status" value="dropped">
                                            <h5>Dropped</h5>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="add-list-radio-labels">
                                            <input require type="radio" name="status" value="planned">
                                            <h5>Plan to read</h5>
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input type="hidden" name="List_bid"
                                                value="<?= htmlspecialchars($book[0]['bookID']); ?>">
                                        </label>
                                    </div>
                                </div>

                                <div class="list-add-actionBtns">
                                    <button id="cancel-button" type="button" class="add-list-cancel-button">
                                        Cancel
                                    </button>
                                    <button id="subBtn" type="submit" class="add-list-submit-button">
                                        <?= htmlspecialchars(($inList === null) ? 'Add' : 'Update'); ?>
                                    </button>
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

                    <div class="table-of-contents">
                        <h2>Try A Spinoff Made By Other Readers</h2>
                        <?php if (!empty($spinoffs) && is_array($spinoffs)): ?>
                            <table border="1">
                                <tr>
                                    <th>Spinoff</th>
                                    <th>Last Updated</th>
                                </tr>
                                <?php foreach ($spinoffs as $spinoff): ?>
                                    <tr>
                                        <td><a
                                                href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>"><?= htmlspecialchars($spinoff['title']); ?></a>

                                        </td>
                                        <td><?= date('Y-m-d', strtotime($spinoff['lastUpdated']));
                                        ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>No spinoffs found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    <?php else: ?>
        <p>No book found.</p>
    <?php endif; ?>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="/Free-Write/public/js/Book/bookOverview.js"></script>
</body>

</html>