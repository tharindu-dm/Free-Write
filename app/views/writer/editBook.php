<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>

    <?php
    $userType = $_SESSION['user_type'] ?? 'guest';

    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'wricov':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <main>
        <div class="book-section">
            <form action="/Free-Write/public/Writer/Update" method="POST" enctype="multipart/form-data">
                <h1>Update Book Details</h1>
                <input type="hidden" name="bID" value="<?= $book['bookID']; ?>">

                <div class="book-form">
                    <!-- Left: Book Info -->
                    <div class="book-info">
                        <div class="input-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" maxlength="45"
                                placeholder="Enter a title for your story"
                                value="<?= htmlspecialchars($book['title']); ?>" required>
                        </div>

                        <div class="input-group">
                            <label for="Synopsis">Synopsis</label>
                            <textarea id="Synopsis" name="Synopsis" maxlength="255" placeholder="Enter a synopsis"
                                required><?= htmlspecialchars($book['Synopsis']); ?></textarea>
                        </div>

                        <div class="input-group">
                            <label for="genre">Genre</label>
                            <select id="genre" name="genre" class="book-select-input" required>
                                <option value="<?php echo htmlspecialchars($genreDetails[0]['genreID']); ?>">
                                    <?php echo htmlspecialchars($genreDetails[0]['genreName']); ?></option>
                                <?php foreach ($genres as $genre) {
                                    if ($genre['genreID'] == $genreDetails[0]['genreID'])
                                        continue;
                                    echo "<option value=\"{$genre['genreID']}\">{$genre['name']}</option>";
                                } ?>
                            </select>

                        </div>
                        <div class="input-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Free"
                                value="<?= htmlspecialchars($book['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </div>

                        <div class="input-group">
                            <label>Release Type</label>
                            <div class="privacy-toggle">
                                <label><input type="radio" name="publishType" value="book" required
                                        <?= $book['publishType'] === 'book' ? 'checked' : ''; ?>> Book Wise</label>
                                <label><input type="radio" name="publishType" value="chapter" required
                                        <?= $book['publishType'] === 'chapter' ? 'checked' : ''; ?>> Chapter Wise</label>
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Privacy</label>
                            <div class="privacy-toggle">
                                <label><input type="radio" name="accessType" value="public" required
                                        <?= $book['accessType'] === 'public' ? 'checked' : ''; ?>> Public</label>
                                <label><input type="radio" name="accessType" value="private" required
                                        <?= $book['accessType'] === 'private' ? 'checked' : ''; ?>> Private</label>
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Book Status</label>
                            <div class="privacy-toggle">
                                <label><input type="radio" name="isCompleted" value="0" required
                                        <?= $book['isCompleted'] == '0' ? 'checked' : ''; ?>> Not Completed</label>
                                <label><input type="radio" name="isCompleted" value="1" required
                                        <?= $book['isCompleted'] == '1' ? 'checked' : ''; ?>> Completed</label>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Cover Image -->
                    <div class="book-cover">
                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($coverDetails['name'] ?? 'sampleCover.jpg'); ?>"
                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                        <button class="book-btn" type="button"
                            onclick="window.location.href='/Free-Write/public/writer/covers'">Find Cover Images</button>
                            <input type="file" name="cover_image" accept="image/*" required> 
                    </div>
                </div>

                <!-- Buttons -->
                <div class="right-buttons">
                    <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
                    <button type="submit" class="create-btn">Update</button>
                </div>
            </form>

        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
    <script src="/Free-Write/public/js/writer/editBook.js"></script>
    <script src="/Free-Write/public/js/imageAdd.js"></script>

</body>

</html>