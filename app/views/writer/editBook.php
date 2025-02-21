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
        
            
            <form action="/Free-Write/public/Writer/Update" method="POST" enctype="multipart/form-data">

            <h1>Update Book Details</h1>

                <!-- Book Details Section -->
                <input type="hidden" name="bID" value="<?php echo $book['bookID']; ?>">
                <div class="book-info">
                    <div class="input-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" maxlength="45" rows="7" name="title"
                            placeholder="Enter a title for your story"
                            value="<?php echo htmlspecialchars($book['title']); ?>" required>

                    </div>

                    <div class="input-group">
                        <label for="Synopsis">Synopsis</label>
                        <textarea id="Synopsis" name="Synopsis" maxlength="255" placeholder="Enter a synopsis"
                            required><?php echo htmlspecialchars($book['Synopsis']); ?></textarea>

                    </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" step="0.01" id="price" name="price" placeholder="Free (Enter a Price)"
                            value="<?php echo htmlspecialchars($book['price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div class="input-group">
                        <label for="type">Release Type</label>
                        <div class="privacy-toggle">
                            <input required type="radio" name="publishType" value="book" <?php echo ($book['publishType'] == 'book') ? 'checked' : ''; ?>> Book Wise
                            <label><input required type="radio" name="publishType" value="chapter" <?php echo ($book['publishType'] == 'chapter') ? 'checked' : ''; ?>> Chapter Wise</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="privacy">Privacy</label>
                        <div class="privacy-toggle">
                            <input required type="radio" name="accessType" value="public" <?php ($book['accessType'] == 'public') ? 'checked' : ''; ?>> Public
                            <input required type="radio" name="accessType" value="private" <?php echo ($book['accessType'] == 'private') ? 'checked' : ''; ?>> Private</label>
                        </div>
                    </div>

                    <button type="submit" class="create-btn">Update</button>
                </div>
                
              </form>
             <!-- Book Cover Section -->
             <div class="book-cover">
                <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Cover Preview" class="cover-img">
                    <label for="cover" class="upload-btn">Upload Cover Photo</label>
                 <input type="file" id="cover" name="cover" accept="image/*" class="file-input">
                </div>
            </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/writer/editBook.js"></script>

</body>

</html>