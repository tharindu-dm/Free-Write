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
        <h1><?php echo htmlspecialchars($spinoff['title']); ?></h1>
        <h3>From <?php echo htmlspecialchars($spinoff['ChapterTitle']); ?></h3>
        <button class="book-btn" onclick="window.location.href='/Free-Write/public/writer/Overview/<?= htmlspecialchars($spinoff['bookID']); ?>'"><?php echo htmlspecialchars($spinoff['fromBook']); ?></button>
        <p><?php echo htmlspecialchars($spinoff['synopsis']); ?></p>
        
    
        <div class="button-container">
    <!-- Left side: Cancel button -->
    <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
    
    <!-- Right side: Edit and Delete buttons -->
    <?php if ($spinoff['isAcknowledge'] == 0): ?>
    <div class="right-buttons">
        <button class="edit-btn" onclick="window.location.href='/Free-Write/public/Writer/acceptSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">Accept</button>
        <button class="delete-btn" onclick="window.location.href='/Free-Write/public/Writer/rejectSpinoff/<?= htmlspecialchars($spinoff['spinoffID']); ?>'">Reject</button>
    </div>
<?php endif; ?>

</div>


        
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

