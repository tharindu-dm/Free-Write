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
    show($data);
    ?>

    <?php if (!empty($content) && is_array($content)): ?>
        <div class="container">
            <div class="title-container">
                <div class="title">
                    <h1><?= htmlspecialchars($content['fromBook']); ?></h1>
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
                    <h1><?= htmlspecialchars($content['title']); ?></h1>
                    <p class="description">
                        <?= htmlspecialchars($content['synopsis']); ?>
                    </p>
                    <?php if ($_SESSION['user_id'] == $content['creatorID']): ?>
                        <button class="edit-btn-spinoff">Edit Spinoff Details</button>
                        <button class="del-btn-spinoff">Delete Spinoff</button>
                    <?php endif; ?>

                    <div class="table-of-contents">
                        <div class="toc-title">
                            <h2>Table of Contents</h2>
                            <a href="/Free-Write/public/Spinoff/write_chapter?spinoff=<?= htmlspecialchars($content['spinoffID'])?>"><button>+ Create New Chapter</button></a>
                        </div>
                        <?php if (!empty($chapters) && is_array($chapters)): ?>
                            <table border="1">
                                <tr>
                                    <th>Chapter</th>
                                    <th>Last Updated</th>                                    
                                    <th>View Count</th>
                                    <?php if ($_SESSION['user_id'] == $content['creatorID']): ?>
                                        <th>Edit</th>
                                        <th>Delete</th>
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
                                        if ($_SESSION['user_id'] == $content['creatorID']) {
                                            echo '<td><a href="/Free-Write/public/Spinoff/ChapEdit/' . $chap['chapterID'] . '"><button class="edit-btn-chap">Edit</button></a></td>';
                                            echo '<td><a href="/Free-Write/public/Spinoff/ChapDelete/' . $chap['chapterID'] . '"><button class="del-btn-chap">Delete</button></a></td>';
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

    <script src="/Free-Write/public/js/Spinoff/bookOverview.js"></script>
</body>

</html>