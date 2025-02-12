<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookOverview.css">
    <link rel="stylesheet" href="/Free-Write/public/css/spinoffOverview.css">
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

    <?php if (!empty($content) && is_array($content)): ?>
        <div class="container">
            <div class="title-container">
                <div class="title">
                    <h1 id="parentBookTitle"><?= htmlspecialchars($content['fromBook']); ?></h1>
                    <h2>A Reader-Made Spinoff</h2>
                </div>
            </div>

            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/public/images/spinoff.jpg"
                        alt="Cover Image of <?= htmlspecialchars($content['title']); ?>">
                    <div class="author-details">
                        <h3><?= htmlspecialchars($content['creator']); ?></h3>
                        <div class="author-detail-btns">
                            <a
                                href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($content['creatorID']); ?>"><button>Profile</button></a>
                            <a
                                href="/Free-Write/public/Writer/Donate?user=<?= htmlspecialchars($content['creatorID']); ?>"><button>Donate</button></a>
                        </div>
                    </div>
                    <div class="other-details">
                        <h3>Other Details</h3>
                        <p><strong>Last Updated:</strong> <?= explode(' ', $content['lastUpdated'])[0]; ?></p>
                        <p><strong>AccessType:&nbsp;</strong>
                            <?= htmlspecialchars($content['accessType']); ?>
                        </p>
                    </div>
                </div>

                <div class="product-info">
                    <h1 id="spinoffTitle_h1"><?= htmlspecialchars($content['title']); ?></h1>
                    <p class="description">
                        <?= htmlspecialchars($content['synopsis']); ?>
                    </p>
                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $content['creatorID'])): ?>
                        <button id="saveSpinoffDetailsButton" class="edit-btn-spinoff">Edit Spinoff Details</button>
                        <button id="deleteSpinoffButton" class="del-btn-spinoff">Delete Spinoff</button>
                    <?php endif; ?>

                    <div class="table-of-contents">
                        <div class="toc-title">
                            <h2>Table of Contents</h2>
                            <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $content['creatorID'])): ?>
                                <a
                                    href="/Free-Write/public/Spinoff/write_chapter?spinoff=<?= htmlspecialchars($content['spinoffID']) ?>"><button>+
                                        Create New Chapter</button></a>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($chapters) && is_array($chapters)): ?>
                            <table border="1">
                                <tr>
                                    <th>Chapter</th>
                                    <th>Last Updated</th>
                                    <th>View Count</th>
                                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $content['creatorID'])): ?>
                                        <th>Edit</th>
                                    <?php endif; ?>
                                </tr>
                                <?php foreach ($chapters as $chap): ?>
                                    <tr>
                                        <td><a
                                                href="/Free-Write/public/Spinoff/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>"><?= htmlspecialchars($chap['title']); ?></a>

                                        </td>
                                        <td><?= htmlspecialchars($chap['lastUpdated']); ?></td>

                                        <td><?= htmlspecialchars($chap['viewCount']); ?></td>
                                        <?php
                                        if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $content['creatorID'])) {
                                            echo '<td><a href="/Free-Write/public/Spinoff/ChapEdit/' . $chap['chapterID'] . '"><button class="edit-btn-spinoff">Edit</button></a></td>';
                                        }
                                        ?>
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

    <!-- Delete Chapter Overlay-->
    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $content['creatorID'])): ?>
        <div class="delete_spinoff_chapter_overlay">
            <div class="overlay-container">
                <div class="overlay-content">
                    <h2 style="color:#ff4444;">You Are About To Delete A Spinoff</h2>
                    <p>Are you sure you want to delete this Spinoff?</p>
                    <p>Please know the <strong>Spinoff will be permanently deleted including its chapters comments</strong>
                        and cannot be recovered.
                    </p>
                    <div class="overlay-buttons">
                        <button id="cancelDeleteBtn" class="cancel-btn">Cancel</button>
                        <form method="POST" id="deleteOverlayForm" action="/Free-Write/public/Spinoff/deleteSpinoff">
                            <input type="hidden" name="spinoffID" value="<?= $content['spinoffID'] ?>">
                            <button id="deleteChapterBtn" class="delete-btn">Delete Spinoff</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit changes Chapter Overlay-->
        <div class="edit_spinoff_chapter_overlay">
            <div class="overlay-container">
                <div class="overlay-content">
                    <h2>Edit Spinoff</h2>

                    <div class="overlay-buttons">
                        <form action="/Free-Write/public/Spinoff/editSpinoff" method="POST" id="editSpinoffForm">
                            <input type="hidden" name="spinoffID" id="spinoffID_hidden"
                                value="<?= $content['spinoffID'] ?>">

                            <label for="editTitle">Title</label>
                            <input type="text" name="title" id="editTitle" value="<?= $content['title'] ?>" require
                                maxlength="45">

                            <label for="editDescription">Synopsis</label>
                            <textarea require maxlength="255" name="synopsis"
                                id="editDescription"><?= $content['synopsis'] ?></textarea>

                            <label for="editAccessType">Access Type</label>
                            <select required name="access" id="editAccessType">
                                <option value="public" <?php if ($content['accessType'] == 'public')
                                    echo 'selected'; ?>>
                                    Public
                                </option>
                                <option value="private" <?php if ($content['accessType'] == 'private')
                                    echo 'selected'; ?>>
                                    Private</option>
                            </select>

                            <label for="editChapter">Starting Chapter</label>
                            <select require name="chapter" id="editChapter">
                                <?php foreach ($bookChapters as $chap): ?>
                                    <option value="<?= $chap['chapter'] ?>" <?php if ($content['startingChapter'] == $chap['chapter'])
                                          echo 'selected'; ?>>
                                        <?= $chap['title'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <p>Are you sure you want to save these changes?</p>

                            <button id="saveChangesBtn" class="edit-btn-spinoff">Save Changes</button>
                            <button id="cancelSaveEditBtn" class="cancel-btn">Cancel</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="/Free-Write/public/js/Spinoff/spinoffEditDelete.js"></script>
    <script src="/Free-Write/public/js/Spinoff/bookOverview.js"></script>
</body>

</html>