<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Book - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>
<body>

   
   

    <!-- Main Content -->
    <main class="book-section">
        <div class="book-form-container">
            <h2>Create a New Book</h2>
            <form action="/Free-Write/public/Writer/createBook" method="POST" enctype="multipart/form-data">
                
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
                        <input type="text" id="title" name="title" placeholder="Enter a title for your story"  required>
                        
                    </div>

                    <div class="input-group">
                        <label for="synopsis">Synopsis</label>
                        <textarea id="synopsis" name="synopsis" placeholder="Enter a synopsis" required></textarea>
                        
                    </div>

                    <div class="input-group">
                        <label for="genre">Genre (Dummy)</label>
                        <select id="genre" name="genre" required>
                            <option value="" disabled selected>Select genre</option>
                            <option value="Fiction" >Fiction</option>
                            <option value="Fantasy" >Fantasy</option>
                            <option value="Romance" >Romance</option>
                        </select>
                        
                    </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" placeholder="Free (Type to add a Price)"  >
                    </div>

                    <div class="input-group">
                        <label for="type">Release Type</label>
                        <div class="privacy-toggle">
                            <label><input type="radio" name="type" value="book" > Book Wise</label>
                            <label><input type="radio" name="type" value="chapter" > Chapter Wise</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="privacy">Privacy</label>
                        <div class="privacy-toggle">
                            <label><input type="radio" name="privacy" value="public" > Public</label>
                            <label><input type="radio" name="privacy" value="private" > Private</label>
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
