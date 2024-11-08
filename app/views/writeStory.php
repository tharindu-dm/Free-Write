<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing Section - Free Write</title>
    <link rel="stylesheet" href="/public/css/writer.css">
</head>
<body>

    <!-- Writing Section -->
    <main class="writing-section">
        <div class="story-info">
            <!-- Dynamically load story title and chapter info -->
            <h1 class="story-title">
                <?php echo isset($story['title']) ? htmlspecialchars($story['title']) : 'Untitled Story'; ?>
            </h1>
            <p class="chapter-info">
                <?php echo isset($story['chapter']) ? 'Chapter ' . htmlspecialchars($story['chapter']) : 'Chapter 1'; ?>
                <span>pg <?php echo isset($story['page']) ? htmlspecialchars($story['page']) : '1'; ?></span>
            </p>
        </div>

        <div class="action-buttons">
            <button class="save-btn" onclick="saveStory()">Save</button>
            <button class="publish-btn" onclick="publishStory()">Publish</button>
        </div>

        <div class="text-editor">
            <textarea id="story-editor" placeholder="Type your text"><?php echo isset($story['content']) ? htmlspecialchars($story['content']) : ''; ?></textarea>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        function saveStory() {
            // JavaScript function to save story content
            // You can implement AJAX here to save without reloading
            console.log("Story saved.");
        }

        function publishStory() {
            // JavaScript function to publish story
            console.log("Story published.");
        }
    </script>
</body>
</html>
