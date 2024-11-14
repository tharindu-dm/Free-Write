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
            <h2>Wattpad Creator ✨</h2>
            <p>My Watty Award-winning novel, Creatures of the Night, is now published! Pick it up at your local bookstore or at the links below.</p>
            <h4>BOOKS:</h4>
            <p>→ <b>Creatures of the Night</b> ✅ (published, paid, Watty Award Winner)</p>
            <p>→ <b>Shadows of the Night</b> ✅ (book 2 draft, free)</p>
        </div>

        <div class="action-buttons">
            <button class="edit-btn">Edit</button>
            <button class="view-stats-btn">View Stats</button>
        </div>
    </div>
</main>

<!-- Book Chapters -->
<section class="book-chapters">
    <?php
    // You could loop through chapter data here if it’s provided dynamically
    ?>
    <div class="chapter" onclick="window.location.href='editStory.php?id=<?php echo htmlspecialchars($chapterId); ?>'">
    <h3>Chapter <?php echo htmlspecialchars($chapter['chapter_number']); ?></h3>
    <p><?php echo htmlspecialchars($chapter['synopsis']); ?></p>
    <p>Published <?php echo htmlspecialchars($publishedDate); ?></p>
</div>
</section>

<!-- Footer -->
<?php
require_once "../app/views/layout/footer.php";
?>

</body>
</html>

