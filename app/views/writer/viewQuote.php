<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

    <style>
        /* Main Quote Section */
        .quote-section {
            margin: 80px auto;
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 40px 50px;
            border-radius: 1.5rem;
            background: rgba(255, 215, 0, 0.08);
            border: 1px solid rgba(255, 215, 0, 0.5);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .quote-section::before {
            content: '"';
            position: absolute;
            top: 40px;
            left: 40px;
            font-size: 120px;
            font-family: Georgia, serif;
            color: rgba(255, 215, 0, 0.2);
            line-height: 0.6;
        }

        .quote-section h2 {
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: #333;
            font-weight: 600;
        }

        .quote-section .text-editor {
            font-size: 24px;
            font-style: italic;
            line-height: 1.6;
            margin: 30px auto;
            max-width: 80%;
            color: #444;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .space_between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 215, 0, 0.3);
        }

        .space_between h3 {
            font-size: 1.2rem;
            color: #555;
            font-weight: 500;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
        }

        .right-buttons {
            display: flex;
            gap: 15px;
        }

        .edit-btn,
        .delete-btn {
            padding: 10px 24px;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .edit-btn {
            background-color: #ffd700;
            color: #000;
        }

        .edit-btn:hover {
            background-color: #000;
            color: #ffd700;
            transform: translateY(-2px);
        }

        .cancel-btn {
            background-color: #f0f0f0;
            color: #555;
        }

        .cancel-btn:hover {
            background-color: #ddd;
            color: #333;
        }

        .delete-btn {
            background-color: white;
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .delete-btn:hover {
            background-color: #dc3545;
            color: white;
            transform: translateY(-2px);
        }

        /* Delete Overlay Styling */
        .deleteOverlay-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .deleteOverlay {
            background-color: white;
            padding: 30px;
            border-radius: 1rem;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .deleteOverlay h2 {
            margin-bottom: 25px;
            font-size: 1.5rem;
            color: #333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .quote-section {
                padding: 30px 25px;
                margin: 40px auto;
            }

            .quote-section::before {
                font-size: 80px;
                top: 30px;
                left: 25px;
            }

            .quote-section .text-editor {
                font-size: 20px;
                max-width: 95%;
            }

            .space_between {
                flex-direction: column;
                gap: 10px;
            }

            .button-container {
                flex-direction: column;
                gap: 15px;
            }

            .right-buttons {
                width: 100%;
                justify-content: center;
            }

            .edit-btn,
            .delete-btn {
                padding: 10px 20px;
                width: 45%;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="quote-section">

        <h2>A Quote by
            <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
        </h2>
        <p class="text-editor"><?php echo htmlspecialchars($quote['quote']); ?></p>

        <div class="space_between">
            <h3><?php echo htmlspecialchars($quote['book_name']); ?></h3>
            <h3><?php echo htmlspecialchars($quote['chapter_name']); ?></h3>
        </div>



        <div class="button-container">
            <!-- Left side: Cancel button -->
            <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                <button type="button" class="edit-btn cancel-btn"
                    onclick="window.location.href='/Free-Write/public/Writer/Quotes'">Back</button>
            <?php else: ?>
                <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
                <!-- Right side: Edit and Delete buttons -->
                <div class="right-buttons">
                    <button class="edit-btn"
                        onclick="window.location.href='/Free-Write/public/Writer/editQuote/<?= htmlspecialchars($quote['quoteID']); ?>'">Edit</button>
                    <button class="delete-btn" id="delete-details">Delete</button>
                </div>
            </div>

            <div class="deleteOverlay-container">
                <div class="deleteOverlay">
                    <h2>Are you sure you want to delete this Quote?</h2>
                    <form action="/Free-Write/public/Writer/deleteQuote/<?= htmlspecialchars($quote['quoteID']); ?>"
                        method="POST">
                        <div class="right-buttons">
                            <button class="read-button delete-btn" type="submit">Yes, Delete</button>
                            <button class="edit-btn" type="button" id="cancelDelete">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </main>


    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>