<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Create Design</title>
    <link rel="stylesheet" href="/Free-Write/public/css/CreateDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    require_once "../app/views/CoverPageDesigner/sidebar.php";
    ?>

    <main>
        <!--method="POST" and enctype required for file upload -->
        <form id="create-design-form" method="POST" enctype="multipart/form-data"
            action="/Free-Write/public/Designer/createCover">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title <span style="color:red">*</span></label>
                <input type="text" id="title" name="title" placeholder="Enter a title for your design" required>
            </div>

            <!-- Optional: Description -->
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <!-- Cover Image File Input -->
            <div class="form-group">
                <label for="coverImage">Cover Image <span style="color:red">*</span></label>
                <div class="file-input-container">
                    <div class="file-input-button">Choose File</div>
                    <input type="file" id="coverImage" name="coverImage" accept="image/*" required>
                    <div class="file-name-display">No file selected</div>
                </div>
                <div class="file-preview-container" id="filePreviewContainer">
                    <div class="file-preview-text">Preview will appear here</div>
                    <div class="image-preview">
                        <img id="imagePreview" src="#" alt="Image Preview">
                    </div>
                </div>
            </div>

            <!-- Hidden input to send logged-in designer's ID -->
            <input type="hidden" name="designer_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

            <!-- Submit -->
            <div class="form-group action-btn">
                <a href="/Free-Write/public/Designer/Dashboard" ><button class="cancel-btn">Cancel</button></a>
                <button type="submit" id="create-btn">Create</button>
            </div>
        </form>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('coverImage');
            const fileNameDisplay = document.querySelector('.file-name-display');
            const previewContainer = document.getElementById('filePreviewContainer');
            const previewText = previewContainer.querySelector('.file-preview-text');
            const imagePreview = document.getElementById('imagePreview');
            const previewDiv = document.querySelector('.image-preview');

            fileInput.addEventListener('change', function (e) {
                if (this.files && this.files[0]) {
                    // Display file name
                    const fileName = this.files[0].name;
                    fileNameDisplay.textContent = fileName;

                    // Preview image
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        previewDiv.style.display = 'block';
                        previewContainer.classList.add('has-file');
                        previewText.classList.add('has-file');
                        previewText.textContent = 'Image Preview:';
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    fileNameDisplay.textContent = 'No file selected';
                    previewDiv.style.display = 'none';
                    previewContainer.classList.remove('has-file');
                    previewText.classList.remove('has-file');
                    previewText.textContent = 'Preview will appear here';
                }
            });
        });
    </script>
</body>

</html>