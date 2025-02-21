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
        <h1><?php echo htmlspecialchars($quote['book_name']); ?></h1>
        <h3><?php echo htmlspecialchars($quote['chapter_name']); ?></h3>
        <p><?php echo htmlspecialchars($quote['quote']); ?></p>
    
        <div class="button-container">
    <!-- Left side: Cancel button -->
    <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
    
    <!-- Right side: Edit and Delete buttons -->
    <div class="right-buttons">
        <button class="edit-btn" onclick="window.location.href='/Free-Write/public/Writer/editQuote/<?= htmlspecialchars($quote['quoteID']); ?>'">Edit</button>
        <button class="delete-btn" onclick="window.location.href='/Free-Write/public/Writer/deleteQuote/<?= htmlspecialchars($quote['quoteID']); ?>'">Delete</button>
    </div>
</div>


        
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

