<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= isset($design) ? 'Edit Design' : 'Create Design' ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/CreateDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <h1><?= isset($design) ? 'Edit Design' : 'Create New Design' ?></h1>
        <hr class="gold-divider">

        <form id="create-design-form" method="POST" enctype="multipart/form-data"
            action="<?= isset($design) ? "/Free-Write/public/Designer/edit/{$design['covID']}" : "/Free-Write/public/Designer/createCover" ?>">

            <div class="form-group form-group-highlight">
                <label for="title">Title <span style="color:red">*</span></label>
                <input type="text" id="title" name="title" placeholder="Enter a title for your design"
                    value="<?= htmlspecialchars($design['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description" placeholder="Describe your design"
                    rows="4"><?= htmlspecialchars($design['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="coverImage">Cover Image <span
                        style="color:red"><?= isset($design) ? '(Leave blank to keep current image)' : '*' ?></span></label>

                <div class="file-input-container">
                    <div class="upload-area">
                        <span class="file-input-button">Choose File</span>
                        <input type="file" id="coverImage" name="coverImage" accept="image/*" <?= isset($design) ? '' : 'required' ?>>
                        <div class="file-name-display">No file chosen</div>
                    </div>
                </div>

                <div class="image-preview">
                    <img id="preview-img" src="#" alt="Preview">
                </div>
                <?php if (isset($design) && !empty($design['image_path'])): ?>
                    <div class="file-preview-container has-file">
                        <p class="file-preview-text has-file">Current image: <?= basename($design['image_path']) ?></p>
                        <img src="<?= $design['image_path'] ?>" alt="Current design"
                            style="max-width: 200px; margin-top: 10px;">
                    </div>
                <?php endif; ?>
            </div>

            <input type="hidden" name="designer_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

            <div class="button-group">
                <button type="submit" id="create-btn"><?= isset($design) ? 'Save Changes' : 'Create Design' ?></button>
                <?php if (isset($design)): ?>
                    <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>"
                        class="cancel-button">Cancel</a>
                <?php else: ?>
                    <a href="/Free-Write/public/Designer/dashboard" class="cancel-button">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>