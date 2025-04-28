<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= isset($design) ? 'Edit Design' : 'Create Design' ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/CreateDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>
        <!-- IMPORTANT: method="POST" and enctype required for file upload -->
        <form id="create-design-form" method="POST" enctype="multipart/form-data"
            action="<?= isset($design) ? "/Free-Write/public/Designer/edit/{$design['covID']}" : "/Free-Write/public/Designer/createCover" ?>">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title <span style="color:red">*</span></label>
                <input type="text" id="title" name="title" placeholder="Enter a title for your design"
                    value="<?= htmlspecialchars($design['name'] ?? '') ?>" required>
            </div>

            <!-- Optional: Description -->
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description"
                    rows="4"><?= htmlspecialchars($design['description'] ?? '') ?></textarea>
            </div>

            <!-- Cover Image File Input -->
            <div class="form-group">
                <label for="coverImage">Cover Image <span
                        style="color:red"><?= isset($design) ? '(Leave blank to keep current image)' : '*' ?></span></label>
                <input type="file" id="coverImage" name="coverImage" accept="image/*" <?= isset($design) ? '' : 'required' ?>>
            </div>

            <!-- Hidden input to send logged-in designer's ID -->
            <input type="hidden" name="designer_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

            <!-- Submit -->
            <div class="form-group">
                <button type="submit" id="create-btn"><?= isset($design) ? 'Save Changes' : 'Create' ?></button>
                <?php if (isset($design)): ?>
                    <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>"
                        class="cancel-button">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </main>

    <script src="/Free-Write/public/js/CreateDesign.js"></script>
</body>

</html>