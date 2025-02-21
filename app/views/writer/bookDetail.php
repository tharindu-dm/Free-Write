<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/bookDetail.css">
</head>

<body>
    <?php
    $userType = $_SESSION['user_type'] ?? 'guest';
    
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

    <?php if (!empty($book) && is_array($book)): ?>
        <div class="container">
            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book[0]['cover_image'] ?? 'sampleCover.jpg'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($book[0]['title']); ?>">
                    <div class="author-details">
                        <h3>Other Details</h3>
                        <p><?= $book[0]['price'] === null ? 'Read for Free' : 'LKR. ' . number_format($book[0]['price'], 2); ?></p>
                        <p><strong>Last Updated:</strong> <?= explode(' ', $book[0]['lastUpdateDate'])[0]; ?></p>
                        <p><strong>Status:</strong> <?= ($book[0]['isCompleted'] == 1) ? "Completed" : "Ongoing"; ?></p>
                    </div>
                </div>

                <div class="product-info">
                    <h1><?= htmlspecialchars($book[0]['title']); ?></h1>
                    <p class="description"> <?= htmlspecialchars($book[0]['Synopsis']); ?> </p>
                    
                    <div class="read-button-container">
                        <div class="rating-container">
                            <div class="rating">Views: <?= htmlspecialchars($book[0]['viewCount']); ?></div>
                              <div class="rating">
                                Rating: <?= $rating ? htmlspecialchars($rating[0]['AverageRating']) . " | " . htmlspecialchars($rating[0]['RatingCount']) . " ratings" : 'No Ratings'; ?>
                            </div>
                        </div>
                        <a href="/Free-Write/public/Writer/Edit/<?= htmlspecialchars($book[0]['bookID']) ?>" class="read-button">Edit</a>
                        <button id="delete-details" class="read-button delete-btn">Delete</button>
                 </div>

                    <div class="table-of-contents">
                        <h2>Table of Contents</h2>
                        <?php if (!empty($chapters) && is_array($chapters)): ?>
                        <table>
                           <tr>
                            <th>Chapter</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                          </tr>
                         <?php foreach ($chapters as $chap): ?>
                            <tr>
                                <td><a href="/Free-Write/public/book/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>">
                                    <?= htmlspecialchars($chap['title']); ?></a>
                                </td>
                                <td><?= htmlspecialchars($chap['lastUpdated']); ?></td>
                                <td>
                                    <a href="/Free-Write/public/Writer/editChapter/<?= htmlspecialchars($chap['chapterID']); ?>" class="read-button">Edit</a>
                                    <a href="/Free-Write/public/Writer/deleteChapter/<?= htmlspecialchars($chap['chapterID']); ?>" class="read-button delete-btn">Delete</a>
                                </td>
                            </tr>
                           <?php endforeach; ?>
                        </table>
                     <?php else: ?>
                       <p>No chapters found.</p>
                     <?php endif; ?>

                        <button class="read-button" onclick="window.location.href='/Free-Write/public/Writer/writeStory/<?= htmlspecialchars($book[0]['bookID']); ?>'">Add New Chapter</button>
                    </div>
        
                
                    <div class="table-of-contents">
                     <h2>Spinoffs</h2>
                     <?php if (!empty($spinoffs) && is_array($spinoffs)): ?>
                      <table>
                        <tr>
                            <th>Spinoff</th>
                            <th>Last Updated</th>
                        </tr>
                        <?php foreach ($spinoffs as $spinoff): ?>
                            <tr>
                                <td><a href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                    <?= htmlspecialchars($spinoff['title']); ?></a>
                                </td>
                                <td><?= date('Y-m-d', strtotime($spinoff['lastUpdated'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                     </table>
                        <?php else: ?>
                            <p>No spinoffs found.</p>
                         <?php endif; ?>
                
                    </div>
                </div>
            

            

            <div class="deleteOverlay-container">
                <div class="deleteOverlay">
                    <h2>Are you sure you want to delete this Book?</h2>
                    <form action="/Free-Write/public/Writer/DeleteBook/" method="POST">
                        <input type="hidden" name="bID" value="<?= htmlspecialchars($book[0]['bookID']); ?>">
                        <label for="title">Book Title</label>
                        <input id="title" type="text" disabled value="<?= htmlspecialchars($book[0]['title']); ?>">
                        <div>
                            <button class="read-button delete-btn" type="submit">Yes, Delete</button>
                            <button class="read-button" type="button" id="cancelDelete">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    <?php else: ?>
        <p>No book found.</p>
    <?php endif; ?>
    </div>

    <?php require_once "../app/views/layout/footer.php"; ?>
    <script src="/Free-Write/public/js/writer/bookDetails.js"></script>
</body>
</html>
