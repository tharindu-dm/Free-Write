<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="quote-section">

        <h2>A Quote by
            <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?></h2>
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