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
    ?>
    <!-- Main Content -->
    <main class="book-section">
        <div class="book-form-container">
            <h2>Create a New Book</h2>


            <form action="/Free-Write/public/Writer/createBook" method="POST" enctype="multipart/form-data">

                <!-- Book Cover Section -->
                <div class="book-cover">
                    <img src="/Free-Write/public/images/sampleCover.jpg" alt="Cover Preview" class="cover-img">
                    <div class="cover-upload">
                        <input type="file" id="cover" name="cover" accept="image/*" class="file-input">
                        <button type="button" class="upload-btn">Upload Cover Photo</button>
                        <?php if (!empty($errors['cover'])): ?>
                            <p class="error"><?php echo $errors['cover']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

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
                        <label for="price">Price</label>
                        <input type="number" min="0" id="price" name="price" placeholder="Free (Enter a Price)">
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

                    <button type="submit" class="create-btn">Create</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

<script src="/Free-Write/public/js/writer/createBook.js"></script>


</body>

</html>