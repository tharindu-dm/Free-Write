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
    <h2>A Quote by <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?></h2>
    
    <form action="/Free-Write/public/Writer/updateQuote" method="post" class="quote-form">
    <div class="quote-container">
    <textarea id="quote" name="quote" class="quote-input" placeholder="Enter your quote here..." maxlength="280" required><?php echo htmlspecialchars($quote['quote']); ?></textarea>

    </div>
    <div class="space_between">
        <h3><?php echo htmlspecialchars($quote['book_name']); ?></h3>
        <select id="chapter" name="chapter" class="select-quote-input" required>
                <option value="<?php echo htmlspecialchars($quote['chapterID']); ?>"><?php echo htmlspecialchars ($quote['chapter_name']); ?></option>
                <?php foreach ($chapters as $chapter) {
                    if ($chapter['chapterID'] == $quote['chapterID']) continue;
                    echo "<option value=\"{$chapter['chapterID']}\">{$chapter['title']}</option>";
                } ?>
            </select>
        </div>
        
<input type="hidden" name="quoteID" value="<?php echo $quote['quoteID']; ?>">
    
    <div class="right-right-buttons">
            <button type="button" class="edit-btn" onclick="window.history.back();">Cancel</button>
            <button type="submit" class="edit-btn">Update</button>
            
    </div>
    </form>
</main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

