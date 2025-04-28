<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Book - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <!-- Main Content -->
    <main>
        <div class="book-section">


            <form action="/Free-Write/public/Writer/createBook" method="POST" enctype="multipart/form-data">

                <h1>Create a New Story</h1>
                <p>Bring your imagination to life ✨create a book that leaves a mark on readers everywhere.</p>
                <div class="book-form">

                    <div class="book-info">
                        <div class="input-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" placeholder="Enter a title for your story" required maxlength="50">
                            <small id="title-warning" style="color: red; display: none;">Maximum 45 characters allowed.</small>
                        </div>

                        <div class="input-group">
                            <label for="synopsis">Synopsis</label>
                            <textarea id="Synopsis" name="Synopsis" placeholder="Enter a Synopsis" required maxlength="300"></textarea>
                            <small id="synopsis-warning" style="color: red; display: none;">Maximum 255 characters allowed.</small>
                        </div>


                        <div class="input-group">
                            <label for="genre">Genre</label>
                            <div class="book-checkbox-group">
                                <?php
                                foreach ($genres as $genre) {
                                    $genreID = htmlspecialchars($genre['genreID']);
                                    $genreName = htmlspecialchars($genre['name']);

                                    echo "<div class=\"book-checkbox-item\">";
                                    echo "<input type=\"checkbox\" name=\"genre[]\" id=\"genre_{$genreID}\" value=\"{$genreID}\">";
                                    echo "<label for=\"genre_{$genreID}\">{$genreName}</label>";
                                    echo "</div>";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="price">Price(LKR)</label>
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
                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.png'); ?>"
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