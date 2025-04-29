<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Submission | Free Write</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .competition-section {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 1rem;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .spinoff-details h1 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
        }

        .spinoff-content {
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            margin: 2rem 0;
        }

        .book-cover {
            flex: 0 0 300px;
            display: flex;
            justify-content: center;
        }

        .book-cover img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border: #ffd700 solid 1px;
            object-fit: cover;
        }

        .spinoff-info {
            flex: 1;
            min-width: 300px;
        }

        .spinoff-info h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #666;
        }

        .synopsis {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            color: #444;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 0.5rem;
            border-left: 4px solid #ffd700;
        }

        .requested-by {
            background: rgba(255, 215, 0, 0.1);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin: 2rem 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            border-left: 4px solid #ffd700;
        }

        .requested-by h4 {
            font-size: 1.1rem;
            margin: 0;
            color: #444;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .right-buttons {
            display: flex;
            gap: 1rem;
        }

        .competition-section button {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: rgba(255, 215, 0, 0.1);
            border: #ffd700 solid 1px;
            color: #333;
        }

        .edit-btn:hover {
            background: rgba(255, 215, 0, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
        }

        .cancel-btn {
            background: rgba(108, 117, 125, 0.1);
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .cancel-btn:hover {
            background: rgba(108, 117, 125, 0.2);
            transform: translateY(-2px);
        }

        .book-btn {
            background: rgba(52, 152, 219, 0.1);
            border: 1px solid #3498db;
            color: #3498db;
        }

        .book-btn:hover {
            background: rgba(52, 152, 219, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .sub-btn {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid #2ecc71;
            color: #2ecc71;
            font-weight: 600;
        }

        .sub-btn.selected {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid #2ecc71;
            color: #2ecc71;
        }

        .sub-btn.rejected {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }

        .date-info {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 0.3rem;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .spinoff-content {
                flex-direction: column;
            }

            .book-cover {
                margin: 0 auto;
            }

            .button-container {
                flex-direction: column;
                gap: 1rem;
            }

            .right-buttons {
                width: 100%;
                justify-content: center;
            }

            .requested-by {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="competition-section">
        <div class="spinoff-details">
            <h1><?php echo htmlspecialchars($submission['title']); ?></h1>
            <hr style="margin-bottom: 1.5rem; border:0.1rem solid #ffd700;" />

            <div class="spinoff-content">
                <div class="book-cover">
                    <img src="/Free-Write/app/images/DesignSubmissions/<?= htmlspecialchars($submission['name'] ?? 'sampleCover.png'); ?>"
                        alt="Submission cover for <?= htmlspecialchars($submission['title']); ?>">
                </div>

                <div class="spinoff-info">
                    <h3>
                        Last Updated:
                        <span class="date-info">
                            <?= date('F j, Y', strtotime($submission['updated_at'])); ?>
                        </span>
                    </h3>

                    <hr style="margin: 1rem 0; border:0.1rem solid #ffd700; opacity: 0.5;" />

                    <h3>Description:</h3>
                    <p class="synopsis"><?= htmlspecialchars($submission['description']); ?></p>
                </div>
            </div>

            <div class="requested-by">
                <h4>Submitted By: <strong><?= htmlspecialchars($userName); ?></strong></h4>
                <button class="book-btn"
                    onclick="window.location.href='/Free-Write/public/User/Profile?user=<?= htmlspecialchars($submission['userID']); ?>'">
                    View Designer Profile
                </button>
            </div>

            <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700;" />

            <div class="button-container">
                <button type="button" class="cancel-btn"
                    onclick="window.location.href='/Free-Write/public/Writer/Submissions/<?= htmlspecialchars($submission['competitionID']); ?>'">
                    Back to Submissions
                </button>

                <?php if ($submission['status'] === 'selected' && $competition['status'] === 'ended'): ?>
                    <button class="sub-btn selected">
                        <span>✓</span> Selected Winner
                    </button>
                <?php elseif ($submission['status'] === 'rejected'): ?>
                    <button class="sub-btn rejected">Rejected</button>
                <?php elseif ($competition['status'] === 'ended'): ?>
                    <!-- Competition has ended but no winner selected yet -->
                    <button class="sub-btn ended">Competition Ended</button>
                <?php else: ?>
                    <div class="right-buttons">
                        <button class="edit-btn"
                            onclick="window.location.href='/Free-Write/public/Writer/Win/<?= htmlspecialchars($submission['submissionID']); ?>'">
                            Choose As Winner
                        </button>
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