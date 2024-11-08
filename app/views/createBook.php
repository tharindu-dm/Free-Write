<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Book - Free Write</title>
    <link rel="stylesheet" href="/public/css/writer.css">
</head>
<body>

    <?php
    // Initialize variables for form fields and error messages
    $title = $synopsis = $genre = $privacy = '';
    $errors = [];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Title validation
        $title = $_POST['title'] ?? '';
        if (empty($title)) {
            $errors['title'] = 'Title is required.';
        }

        // Synopsis validation
        $synopsis = $_POST['synopsis'] ?? '';
        if (empty($synopsis)) {
            $errors['synopsis'] = 'Synopsis is required.';
        }

        // Genre validation
        $genre = $_POST['genre'] ?? '';
        if (empty($genre)) {
            $errors['genre'] = 'Please select a genre.';
        }

        // Privacy setting
        $privacy = $_POST['privacy'] ?? 'public';

        // Handle file upload for cover image
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $coverTmpName = $_FILES['cover']['tmp_name'];
            $coverName = basename($_FILES['cover']['name']);
            $targetDir = '/public/uploads/';
            $targetFilePath = $targetDir . $coverName;

            // Check file type and move uploaded file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['cover']['type'], $allowedTypes)) {
                move_uploaded_file($coverTmpName, $_SERVER['DOCUMENT_ROOT'] . $targetFilePath);
            } else {
                $errors['cover'] = 'Please upload a valid image file (JPEG, PNG, GIF).';
            }
        } else {
            $errors['cover'] = 'Cover photo upload failed. Please try again.';
        }

        // If no errors, save the book (simulated here)
        if (empty($errors)) {
            // Save book logic here, e.g., insert into database
            echo '<p>Book created successfully!</p>';
        }
    }
    ?>

    <!-- Main Content -->
    <main class="book-section">
        <div class="book-form-container">
            <h2>Create a New Book</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                
                <!-- Book Cover Section -->
                <div class="book-cover">
                    <img src="/public/images/cover-placeholder.jpg" alt="Cover Preview" class="cover-img">
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
                        <input type="text" id="title" name="title" placeholder="Enter a title for your story" value="<?php echo htmlspecialchars($title); ?>" required>
                        <?php if (!empty($errors['title'])): ?>
                            <p class="error"><?php echo $errors['title']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="synopsis">Synopsis</label>
                        <textarea id="synopsis" name="synopsis" placeholder="Enter a synopsis" required><?php echo htmlspecialchars($synopsis); ?></textarea>
                        <?php if (!empty($errors['synopsis'])): ?>
                            <p class="error"><?php echo $errors['synopsis']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" required>
                            <option value="" disabled selected>Select genre</option>
                            <option value="Fiction" <?php echo $genre == 'Fiction' ? 'selected' : ''; ?>>Fiction</option>
                            <option value="Fantasy" <?php echo $genre == 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="Romance" <?php echo $genre == 'Romance' ? 'selected' : ''; ?>>Romance</option>
                        </select>
                        <?php if (!empty($errors['genre'])): ?>
                            <p class="error"><?php echo $errors['genre']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="privacy">Privacy</label>
                        <div class="privacy-toggle">
                            <label><input type="radio" name="privacy" value="public" <?php echo $privacy == 'public' ? 'checked' : ''; ?>> Public</label>
                            <label><input type="radio" name="privacy" value="private" <?php echo $privacy == 'private' ? 'checked' : ''; ?>> Private</label>
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


</body>
</html>
