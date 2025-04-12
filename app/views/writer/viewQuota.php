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
        <h1><?php echo htmlspecialchars($quota['publisher']); ?></h1>
        <h3><?php echo htmlspecialchars($quota['message']); ?></h3>
        <p><?php echo htmlspecialchars($quota['content']); ?></p>
    
        <div class="button-container">
    <!-- Left side: Cancel button -->
    <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
    
    <!-- Right side: Edit and Delete buttons -->
    
    </div>


        
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

