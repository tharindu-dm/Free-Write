<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Book - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>

<?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <!-- Main Content -->
    <main>
        <div class="book-section">
        
            
            <form action="/Free-Write/public/Writer/createBook" method="POST" enctype="multipart/form-data">

            <h1>Create a New Story</h1>
            <p>Bring your imagination to life ✨create a book that leaves a mark on readers everywhere.</p>
            <div class="book-form">

                <!-- Book Details Section -->
                <div class="book-info">
                    <div class="input-group">
                        <label for="title">Title</label>

                        <input type="text" maxlength="45" rows="7" id="title" name="title"
                            placeholder="Enter a title for your story" required>
                    </div>

                    <div class="input-group">
                        <label for="synopsis">Synopsis</label>

                        <textarea id="Synopsis" maxlength="255" name="Synopsis" placeholder="Enter a Synopsis"
                            required></textarea>

                    </div>

                    <div class="input-group">
                    <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="book-select-input" required>
                        <option value="">Select Genre</option>
                        <?php foreach ($genres as $genre) {
                        echo "<option value=\"{$genre['genreID']}\">{$genre['name']}</option>";
                        } ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" id="price" name="price" placeholder="Free">
                    </div>

                    <div class="input-group">
                        <label for="type">Release Type</label>
                        <div class="privacy-toggle">
                            <label><input required type="radio" name="type" value="book"> Book Wise</label>
                            <label><input required type="radio" name="type" value="chapter"> Chapter Wise</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="privacy">Privacy</label>
                        <div class="privacy-toggle">


                            <label><input required type="radio" name="privacy" value="public"> Public</label>
                            <label><input required type="radio" name="privacy" value="private"> Private</label>
                        </div>
                    </div>

                   
                </div>
                <!-- Right: Cover Image -->
        <div class="book-cover">
            <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
            
        </div>
    </div>

               <!-- Buttons -->
    <div class="right-buttons">
        <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
        <button type="submit" class="create-btn">Create</button>
    </div>
        </form>
            
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/writer/editBook.js"></script>

</body>

</html>