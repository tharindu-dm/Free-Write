<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/Free-Write/public/css/writer.css">
</head>
<body>

<?php
// Include appropriate header based on user type
if (isset($_SESSION['userType'])) {
    $userType = $_SESSION['userType'];
} else {
    $userType = 'guest';
}
switch ($userType) {
    case 'admin':
        require_once "../app/views/layout/adminHeader.php";
        break;
    case 'reader':
        require_once "../app/views/layout/userHeader.php";
        break;
    default:
        require_once "../app/views/layout/header.php";
}
?>

<!-- Book Detail Section -->
<main class="book-detail-section">
    <div class="book-cover">
        <img src="/Free-Write/public/images/writer/cover.png" alt="Book Cover">
    </div>

    <div class="book-info">
        <div class="author-description">
        <h2><?php echo htmlspecialchars($bookDetails['title'] ?? ''); ?></h2>
            <p><?php echo htmlspecialchars($bookDetails['synopsis'] ?? ''); ?></p>
            <p>→ <b>Connected Chapter:</b> <?php echo htmlspecialchars($bookDetails['spinoff_chapter'] ?? ''); ?></p>
        </div>

        <div class="action-buttons">
            
            <button class="view-stats-btn">View Stats</button>
        </div>
    </div>
</main>

<!-- Book Chapters -->
<section class="book-chapters">
    <?php
    // You could loop through chapter data here if it’s provided dynamically
    ?>
    <div class="chapter">
        <h3>The Silent King</h3>
        <p>A king who cannot speak. A queen who cannot hear. A kingdom on the brink of war.</p>
        <p>Published Dec 14, 2023</p>
    </div>
    <div class="chapter">
        <h3>Chapter 1</h3>
        <p>A king who cannot speak. A queen who cannot hear. A kingdom on the brink of war.</p>
        <p>Published Dec 14, 2023</p>
    </div>
    <div class="chapter">
        <h3>Chapter 2</h3>
        <p>A king who cannot speak. A queen who cannot hear. A kingdom on the brink of war.</p>
        <p>Published Dec 14, 2023</p>
    </div>
</section>

<!-- Footer -->
<?php
require_once "../app/views/layout/footer.php";
?>

</body>
</html>

