<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/bookOverview.css">
    <link rel="stylesheet" href="/Free-Write/public/css/bookOverview_quotation.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <?php if (!empty($book) && is_array($book)): ?>
        <main class="container">
            <div class="product-layout">
                <div class="product-image">
                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book[0]['cover_image'] ?? 'sampleCover.png'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($book[0]['title']); ?>">
                    <div class="author-details">
                        <h3><?= htmlspecialchars($book[0]['authorName']); ?></h3>
                        <div class="author-detail-btns">
                            <a
                                href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($book[0]['author']); ?>"><button>Profile</button></a>
                            <a href="/Free-Write/public/Writer/Donate?user=<?= htmlspecialchars($book[0]['author']); ?>"><button>Donate
                                    Author</button></a>
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

                    <div style="margin-top: 1rem;">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/Free-Write/public/book/ReportOnBook/<?= htmlspecialchars(splitURL()[2]) ?>">
                                <button id="reportBtn" class="report-book-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                    </svg>
                                    Report Book
                                </button>
                            </a>
                        <?php endif; ?>
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
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <?= 'Be the first to rate!'; ?>
                                <?php else: ?>
                                    <?= 'Log in to add a rating'; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?= htmlspecialchars($rating[0]['AverageRating']); ?>
                                | <?= htmlspecialchars($rating[0]['RatingCount']); ?> ratings
                            <?php endif; ?>
                        </div>
                        <?php if (isset($_SESSION['user_id'])): ?>
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
                                            <?php if ($collections != null): ?>
                                                <?php foreach ($collections as $collection): ?>
                                                    <label>
                                                        <input type="checkbox" name="collections[]"
                                                            value="<?= htmlspecialchars($collection['collectionID']); ?>"
                                                            <?= ($collection['BookExist'] == 1) ? 'checked' : ''; ?>>
                                                        <?= htmlspecialchars($collection['title']); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>You have not created any collections</p>
                                            <?php endif; ?>
                                            <button type="submit" class="addCollection-btn">Edit Collections</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="description">
                        <?= htmlspecialchars($book[0]['Synopsis']); ?>
                    </p>
                    <div class="read-button-container">
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
                        <?php if (($book[0]['price'] === null || $bought) && isset($_SESSION['user_id'])): ?>
                            <button id="btn-addToList" class="read-button">
                                <?php if ($inList === null): ?>
                                    <p><?= 'Add To List'; ?></p>
                                <?php else: ?>
                                    In <?= htmlspecialchars(ucfirst($inList)) ?> List
                                <?php endif; ?>
                            </button>


                            <?php if (sizeof($chapters) >= 2): ?>
                                <button id="btn-create-spinoff" class="read-button">Create A Spinoff
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'pub'): ?>
                            <?php if (!$hasExistingQuotation): ?>
                                <button id="write-quotation" class="read-button">Write Quotation</button>
                            <?php else: ?>
                                <a href="/Free-Write/public/Publisher/viewQuotationHistory?writer_id=<?= htmlspecialchars($book[0]['author']); ?>&book_id=<?= htmlspecialchars($book[0]['bookID']); ?>"
                                    class="read-button">View Quotation Chat</a>
                            <?php endif; ?>
                        <?php endif; ?>
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
                                    <?php if (!empty($chapters)): ?>
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
                                    <?php endif; ?>
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

                                <div>
                                    <label for="chapCount">Chapter Count</label>
                                    <input type="number" id="chapterCount" name="chapterCount"
                                        value="<?= htmlspecialchars($chapterProgress ?? 0); ?>">
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
                                    <?php if ($book[0]['price'] === null): ?>
                                        <th>Price</th>
                                    <?php endif; ?>
                                </tr>
                                <?php foreach ($chapters as $chap): ?>
                                    <tr>
                                        <td>
                                            <?php if ($chap['isPurchased'] || $bought || $chap['price'] === NULL): ?>
                                                <a
                                                    href="/Free-Write/public/Book/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>"><?= htmlspecialchars($chap['title']); ?></a>
                                            <?php else: ?>
                                                <p>Purchase to read chapters</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($chap['lastUpdated']); ?></td>
                                        <?php if ($book[0]['price'] === null): ?>
                                            <td>
                                                <div class="buy-button">
                                                    <?php if ($chap['price'] === null): ?>
                                                        <p><?= 'Read for Free'; ?></p>
                                                    <?php elseif ($chap['isPurchased']): ?>
                                                        <p> <?= 'Already Purchased'; ?></p>
                                                    <?php else: ?>
                                                        <a
                                                            href='/Free-Write/public/Payment/Chapter/<?= htmlspecialchars($chap['chapterID']); ?>'>
                                                            <?= 'Buy LKR. ' . number_format($chap['price'], 2); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
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
                                                href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                                <?= htmlspecialchars($spinoff['title']); ?>
                                                <?php if ($spinoff['isAcknowledge'] == 1): ?>
                                                    <span style="margin-left: 8px;">✔️</span>
                                                <?php endif; ?>
                                            </a>
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

                    <div class="table-of-contents">
                        <h2>Reviews</h2>
                        <div class="review-form">

                            <?php if (isset($_SESSION['user_id']) && ($book[0]['price'] === null || $bought)): ?>
                                <form action="/Free-Write/public/Book/addReview" method="POST">
                                    <input type="hidden" name="bookID" value="<?= htmlspecialchars($book[0]['bookID']); ?>">

                                    <textarea name="reviewText" id="reviewText" placeholder="Add your review"></textarea>
                                    <p id="charFeedback" style="color: red; font-size: 0.9em;"></p>

                                    <input type="hidden" name="bookID" value="<?= htmlspecialchars($book[0]['bookID']); ?>">

                                    <button class="btn" type="submit">Post Review</button>
                                </form>
                            <?php else: ?>
                                <p>Log in to add a review</p>
                            <?php endif; ?>

                        </div>
                        <?php if (!empty($reviews) && is_array($reviews)): ?>
                            <table class="reviews-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Review</th>
                                        <th colspan="2">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reviews as $review): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($review['fullName']); ?></td>
                                            <td><?= htmlspecialchars($review['content']); ?></td>
                                            <td><?= (new DateTime($review['postDate']))->format('F j, Y'); ?>
                                            </td>
                                            <td>
                                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['user']): ?>
                                                    <form action="/Free-Write/public/Book/deleteReview" method="POST">
                                                        <input type="hidden" name="reviewID" value="<?= $review['reviewID']; ?>">
                                                        <input type="hidden" name="bookID" value="<?= $book[0]['bookID']; ?>">
                                                        <button type="submit" class="delete-btn">Delete</button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Be the first to write a review</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    <?php else: ?>
        <p>No book found.</p>
    <?php endif; ?>

    <div id="quotation-popup">
        <div>
            <h3>Write a Quotation</h3>
            <form action="/Free-Write/public/Publisher/sendQuotation2Wri" method="post">
                <input type="hidden" name="book_id" value="<?= htmlspecialchars($book[0]['bookID'] ?? ''); ?>">
                <input type="hidden" name="book_title" value="<?= htmlspecialchars($book[0]['title'] ?? ''); ?>">
                <input type="hidden" name="writer_id" value="<?= htmlspecialchars($book[0]['author'] ?? ''); ?>">
                <input type="hidden" name="publisher_id" value="<?= htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                <textarea name="message" placeholder="Enter your quotation here..."></textarea>
                <div class="button-container">
                    <button type="button" class="cancel-btn"
                        onclick="document.getElementById('quotation-popup').style.display='none';">Cancel</button>
                    <button type="submit" class="send-btn">Send</button>
                </div>
            </form>
        </div>
    </div>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="/Free-Write/public/js/Book/bookOverview.js"></script>
    <script>
        const writeQuotationBtn = document.getElementById('write-quotation');
        const quotationPopup = document.getElementById('quotation-popup');

        if (writeQuotationBtn) {
            writeQuotationBtn.addEventListener('click', function () {
                quotationPopup.style.display = 'block';
            });
        }
    </script>
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success-message" style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin-bottom: 20px; border: 1px solid #d6e9c6; border-radius: 4px;">';
        echo $_SESSION['success_message'];
        echo '</div>';

        unset($_SESSION['success_message']);
    }
    ?>

</body>

</html>