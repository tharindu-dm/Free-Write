<?php
//profile of user. reader, writer and covdes. check userType and display the profile accordingly 
//for example, if only reader, display only the reader profile and add a button to upgrade to writer or covdes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/myBookList.css">
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
    ?>

    <main>
        <section class="secondary-nav">
            <div class="table-selector">
                <button id="reading-btn" class="table-btn">Reading</button>
                <button id="completed-btn" class="table-btn">Completed</button>
                <button id="onhold-btn" class="table-btn">On Hold</button>
                <button id="dropped-btn" class="table-btn">Dropped</button>
                <button id="planned-btn" class="table-btn">Planned</button>
            </div>
        </section>

        <section class="table-section">
            <div class="table-set-container">
                <div id="reading-table" class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 100px">Cover</th>
                                <th style="width: 500px">Book</th>
                                <th style="width: 90px">Chapter</th>
                                <th style="width: 90px">Status</th>
                                <th colspan="2" style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($readingList) && is_array($readingList)): ?>
                                <?php foreach ($readingList as $book): ?>
                                    <tr data-book-id="<?= htmlspecialchars($book['bookID']); ?>"
                                        data-book-title="<?= htmlspecialchars($book['title']); ?>"
                                        data-chapter-Progress="<?= htmlspecialchars($book['chapterProgress'] === null ? '0' : $book['chapterProgress']); ?>"
                                        data-status="<?= htmlspecialchars($book['status']); ?>">

                                        <td><img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>"></td>
                                        <td>
                                            <a
                                                href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                                <?php echo $book['title']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $book['chapterProgress'] === null ? '0' : $book['chapterProgress']; ?>
                                        </td>
                                        <td><?php echo $book['status']; ?></td>
                                        <td><button class="listEdit-btn">Edit</button></td>
                                        <td><button class="listDelete-btn">Delete</button></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>No books in list.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="completed-table" class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 100px">Cover</th>
                                <th style="width: 500px">Book</th>
                                <th style="width: 90px">Chapter</th>
                                <th style="width: 90px">Status</th>
                                <th colspan="2" style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($completedList) && is_array($completedList)): ?>
                                <?php foreach ($completedList as $book): ?>
                                    <tr data-book-id="<?= htmlspecialchars($book['bookID']); ?>"
                                        data-book-title="<?= htmlspecialchars($book['title']); ?>"
                                        data-chapter-Progress="<?= htmlspecialchars($book['chapterProgress'] === null ? '0' : $book['chapterProgress']); ?>"
                                        data-status="<?= htmlspecialchars($book['status']); ?>">
                                        <td><img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>"></td>
                                        <td>
                                            <a
                                                href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                                <?php echo $book['title']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $book['chapterProgress'] === null ? '0' : $book['chapterProgress']; ?>
                                        </td>
                                        <td><?php echo $book['status']; ?></td>
                                        <td><button class="listEdit-btn">Edit</button></td>
                                        <td><button class="listDelete-btn">Delete</button></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>No books in list.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="onhold-table" class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 100px">Cover</th>
                                <th style="width: 500px">Book</th>
                                <th style="width: 90px">Chapter</th>
                                <th style="width: 90px">Status</th>
                                <th colspan="2" style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($onholdList) && is_array($onholdList)): ?>
                                <?php foreach ($onholdList as $book): ?>
                                    <tr data-book-id="<?= htmlspecialchars($book['bookID']); ?>"
                                        data-book-title="<?= htmlspecialchars($book['title']); ?>"
                                        data-chapter-Progress="<?= htmlspecialchars($book['chapterProgress'] === null ? '0' : $book['chapterProgress']); ?>"
                                        data-status="<?= htmlspecialchars($book['status']); ?>">
                                        <td><img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>"></td>
                                        <td>
                                            <a
                                                href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                                <?php echo $book['title']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $book['chapterProgress'] === null ? '0' : $book['chapterProgress']; ?>
                                        </td>
                                        <td><?php echo $book['status']; ?></td>
                                        <td><button class="listEdit-btn">Edit</button></td>
                                        <td><button class="listDelete-btn">Delete</button></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>No books in list.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="dropped-table" class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 100px">Cover</th>
                                <th style="width: 500px">Book</th>
                                <th style="width: 90px">Chapter</th>
                                <th style="width: 90px">Status</th>
                                <th colspan="2" style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($droppedList) && is_array($droppedList)): ?>
                                <?php foreach ($droppedList as $book): ?>
                                    <tr data-book-id="<?= htmlspecialchars($book['bookID']); ?>"
                                        data-book-title="<?= htmlspecialchars($book['title']); ?>"
                                        data-chapter-Progress="<?= htmlspecialchars($book['chapterProgress'] === null ? '0' : $book['chapterProgress']); ?>"
                                        data-status="<?= htmlspecialchars($book['status']); ?>">
                                        <td><img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>"></td>
                                        <td>
                                            <a
                                                href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                                <?php echo $book['title']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $book['chapterProgress'] === null ? '0' : $book['chapterProgress']; ?>
                                        </td>
                                        <td><?php echo $book['status']; ?></td>
                                        <td><button class="listEdit-btn">Edit</button></td>
                                        <td><button class="listDelete-btn">Delete</button></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>No books in list.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div id="planned-table" class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 100px">Cover</th>
                                <th style="width: 500px">Book</th>
                                <th style="width: 90px">Chapter</th>
                                <th style="width: 90px">Status</th>
                                <th colspan="2" style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($plannedList) && is_array($plannedList)): ?>
                                <?php foreach ($plannedList as $book): ?>
                                    <tr data-book-id="<?= htmlspecialchars($book['bookID']); ?>"
                                        data-book-title="<?= htmlspecialchars($book['title']); ?>"
                                        data-chapter-Progress="<?= htmlspecialchars($book['chapterProgress'] === null ? '0' : $book['chapterProgress']); ?>"
                                        data-status="<?= htmlspecialchars($book['status']); ?>">
                                        <td><img src="/Free-Write/public/images/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>"></td>
                                        <td>
                                            <a
                                                href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']); ?>">
                                                <?php echo $book['title']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $book['chapterProgress'] === null ? '0' : $book['chapterProgress']; ?>
                                        </td>
                                        <td><?php echo $book['status']; ?></td>
                                        <td><button class="listEdit-btn">Edit</button></td>
                                        <td><button class="listDelete-btn">Delete</button></td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>No books in list.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="add-to-list">
                <div class="list-add-container">
                    <h3>Edit Record</h3>
                    <h4 id="bookTitle-header">Title:</h4>

                    <form id="add-to-list-form" action="/Free-Write/public/Book/List/update"
                        method="POST">
                        <div class="form-content">
                            <div class="chapter-counter">
                                <label for="chapterCount">Edit Chapter Count</label>
                                <input type="number" name="chapterCount" id="chapterCount" min="0">
                            </div>
                            <div class="status-content">
                                <label for="status-select">Update Status</label>
                                <select name="status" id="status-select">
                                    <option value="reading">Reading</option>
                                    <option value="completed">Completed</option>
                                    <option value="hold">On Hold</option>
                                    <option value="dropped">Dropped</option>
                                    <option value="planned">Planned</option>
                                </select>
                            </div>
                            <input type="hidden" name="List_bid" id="List_bid">
                        </div>
                        <div class="list-add-actionBtns">
                            <button id="cancel-button" type="button" class="add-list-cancel-button">
                                Cancel
                            </button>
                            <button id="subBtn" type="submit" class="add-list-submit-button">Update Record</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="delete-from-list">
                <div class="list-add-container">
                    <h3 style="color:crimson;">You are about to delete</h3>
                    <h4 id="bookTitle-header-delete">Title:</h4>

                    <form id="add-to-list-form" action="/Free-Write/public/Book/List/delete"
                        method="POST">

                        <input type="hidden" name="List_bid" id="List_bid_delete">

                        <div class="list-add-actionBtns">
                            <button id="cancel-delete-button" type="button" class="add-list-cancel-button">
                                Cancel
                            </button>
                            <button id="subBtn" type="submit" class="delete-list-submit-button">Delete Record</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if ($userType == 'guest') {
                echo "<h1>you better if you login</h1>";
            }
            ?>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\myBookList.js"></script>
</body>

</html>