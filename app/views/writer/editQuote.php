<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

    
</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="quote-section">
    <h1><?php echo htmlspecialchars($quote['book_name']); ?></h1>
    <h3><?php echo htmlspecialchars($quote['chapter_name']); ?></h4>
        <h4>Quotes can be up to 280 characters.</h3>
<form action="/Free-Write/public/Writer/updateQuote" method="post" class="quote-form">
<input type="hidden" name="quoteID" value="<?php echo $quote['quoteID']; ?>">
    <div class="quote-container">
    <textarea id="quote" name="quote" class="quote-input" placeholder="Enter your quote here..." maxlength="280" required><?php echo htmlspecialchars($quote['quote']); ?></textarea>

    </div>
    <div class="action-buttons">
            <button type="submit" class="edit-btn">Post</button>
            <button type="button" class="edit-btn" onclick="window.history.back();">Cancel</button>
    </div>
    </form>
</main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

