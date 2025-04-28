<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
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
                            <input type="text" id="title" name="title"
                                placeholder="Enter a title for your story"
                                value="<?= htmlspecialchars($book['title']); ?>" required>
                                <small id="title-warning" style="color: red; display: none;">Maximum 45 characters allowed.</small>
                        </div>

                        <div class="input-group">
                            <label for="Synopsis">Synopsis</label>
                            <textarea id="Synopsis" name="Synopsis" placeholder="Enter a synopsis"
                                required><?= htmlspecialchars($book['Synopsis']); ?></textarea>
                                <small id="synopsis-warning" style="color: red; display: none;">Maximum 255 characters allowed.</small>
                        </div>

                        <div class="input-group">
                            <label for="genre">Genre</label>
                            <div class="book-checkbox-group">
                                <?php
                                $selectedGenreIDs = array_column($genreDetails, 'genreID');

                                foreach ($genres as $genre) {
                                    $genreID = htmlspecialchars($genre['genreID']);
                                    $genreName = htmlspecialchars($genre['name']);
                                    $isChecked = in_array($genreID, $selectedGenreIDs) ? 'checked' : '';

                                    echo "<div class=\"book-checkbox-item\">";
                                    echo "<input type=\"checkbox\" name=\"genre[]\" id=\"genre_{$genreID}\" value=\"{$genreID}\" {$isChecked}>";
                                    echo "<label for=\"genre_{$genreID}\">{$genreName}</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="price">Price(LKR)</label>
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
                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($coverDetails['name'] ?? 'sampleCover.png'); ?>"
                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">
                        <button class="book-btn" type="button"
                            onclick="window.location.href='/Free-Write/public/writer/covers'">Find Cover Images</button>
                        <input type="file" name="cover_image" accept="image/*">
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