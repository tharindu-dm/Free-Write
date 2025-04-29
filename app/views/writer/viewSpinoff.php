<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Spinoff - Free Write</title>
    <style>
        
        .spinoff-view {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .spinoff-details {
            border-radius: 1rem;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .spinoff-details h1 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            color: #333;
            font-size: 2rem;
            border-bottom: 2px solid #ffd700;
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .spinoff-content {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .cover-image {
            flex: 0 0 250px;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ffd700;
        }

        .cover-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .spinoff-info {
            flex: 1;
        }

        .space_between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .space_between h4 {
            margin: 0;
            font-size: 1.2rem;
            color: #555;
        }

        .spinoff-info h3 {
            margin-top: 0;
            margin-bottom: 1rem;
            color: #333;
            font-size: 1.3rem;
        }

        .synopsis {
            background: rgba(255, 255, 255, 0.7);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            line-height: 1.6;
            border-left: 3px solid #ffd700;
        }

        .requested-by {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .requested-by h4 {
            margin: 0;
            font-size: 1.1rem;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .right-buttons {
            display: flex;
            gap: 1rem;
        }

        /* Button Styles */
        .book-btn,
        .edit-btn,
        .delete-btn {
            padding: 0.7rem 1.5rem;
            border-radius: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .book-btn {
            background-color: #ffd700;
            color: #333;
        }

        .book-btn:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-btn {
            background-color: #4a90e2;
            color: white;
        }

        .edit-btn:hover {
            background-color: #3a80d2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #d44333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cancel-btn {
            background-color: #95a5a6;
        }

        .cancel-btn:hover {
            background-color: #7f8c8d;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .spinoff-content {
                flex-direction: column;
            }

            .cover-image {
                width: 70%;
                margin: 0 auto;
            }

            .requested-by {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .button-container {
                flex-direction: column;
                gap: 1rem;
            }

            .right-buttons {
                width: 100%;
            }

            .edit-btn,
            .delete-btn,
            .cancel-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="spinoff-view">
        <div class="spinoff-details">
            <h1><?php echo htmlspecialchars($spinoff['title']); ?></h1>
            <div class="spinoff-content">
                <div class="cover-image">
                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($spinoff['cover_image'] ?? 'sampleCover.png'); ?>"
                        alt="Cover Image of <?= htmlspecialchars($spinoff['title']); ?>">
                </div>

                <div class="spinoff-info">
                    <div class="space_between">
                        <h4>From Original: <?= htmlspecialchars($spinoff['fromBook']); ?></h4>
                        <button class="book-btn"
                            onclick="window.location.href='/Free-Write/public/Book/Overview/<?= htmlspecialchars($spinoff['bookID']); ?>'">
                            View Original Book
                        </button>
                    </div>

                    <h3>Based on Chapter: <?= htmlspecialchars($spinoff['ChapterTitle']); ?></h3>

                    <h4>Synopsis:</h4>
                    <p class="synopsis"><?= htmlspecialchars($spinoff['synopsis']); ?></p>
                </div>
            </div>

            <div class="requested-by">
                <h4>Spinoff Created By: <?= htmlspecialchars($spinoff['creator']); ?></h4>
                <button class="book-btn"
                    onclick="window.location.href='/Free-Write/public/User/Profile?user=<?= htmlspecialchars($spinoff['creatorID']); ?>'">
                    View Creator's Profile
                </button>
            </div>

            <div class="button-container">
                <!-- Left side: Back button -->
                <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">
                    Back to Spinoffs
                </button>

                <!-- Right side: Accept and Reject buttons -->
                <?php if ($spinoff['isAcknowledge'] == 0): ?>
                    <div class="right-buttons">
                        <button class="edit-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/acceptSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">
                            Accept Spinoff
                        </button>
                        <button class="delete-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/rejectSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">
                            Reject Spinoff
                        </button>
                    </div>
                <?php else: ?>
                    <div class="right-buttons">
                        <div class="status-badge"
                            style="background: #333; color: white; padding: 0.7rem 1.5rem; border-radius: 2rem; font-weight: bold;">
                            <?= $spinoff['isAcknowledge'] == 1 ? 'Accepted' : 'Rejected' ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>