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
        case 'mod':
        case 'writer':
        case 'wricov':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>

    <!-- Main Content -->
    <main class="book-section">
        <div class="book-form-container">
            <h2>Update Book Details</h2>
            <form action="/Free-Write/public/Writer/Update" method="POST" enctype="multipart/form-data">

                <!-- Book Cover Section -->
                <div class="book-cover">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Cover Preview" class="cover-img">
                    <div class="cover-upload">
                        <input type="file" id="cover" name="cover" accept="image/*" class="file-input">
                        <button type="button" class="upload-btn">Upload Cover Photo</button>
                    </div>
                </div>

                <!-- Book Details Section -->
                <input type="hidden" name="bID" value="<?php echo $book['bookID']; ?>">
                <div class="book-info">
                    <div class="input-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter a title for your story"
                            value="<?php echo htmlspecialchars($book['title']); ?>" required>

                    </div>

                    <div class="input-group">
                        <label for="Synopsis">Synopsis</label>
                        <textarea id="Synopsis" name="Synopsis" placeholder="Enter a synopsis"
                            required><?php echo htmlspecialchars($book['Synopsis']); ?></textarea>

                    </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" placeholder="Free (Type to add a Price)"
                            value="<?php echo htmlspecialchars($book['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="input-group">
                        <label for="type">Release Type</label>
                        <div class="privacy-toggle">
                            <input type="radio" name="publishType" value="book" <?php echo ($book['publishType'] == 'book') ? 'checked' : ''; ?>> Book Wise
                            <label><input type="radio" name="publishType" value="chapter" <?php echo ($book['publishType'] == 'chapter') ? 'checked' : ''; ?>> Chapter Wise</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="privacy">Privacy</label>
                        <div class="privacy-toggle">
                            <input type="radio" name="accessType" value="public" <?php ($book['accessType'] == 'public') ? 'checked' : ''; ?>> Public
                            <input type="radio" name="accessType" value="private" <?php echo ($book['accessType'] == 'private') ? 'checked' : ''; ?>> Private</label>
                        </div>
                    </div>

                    <button type="submit" class="create-btn">Update</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>


</body>

</html>