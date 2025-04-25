<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Collection</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
</head>
<body>
    <main class="dashboard-container">
        <section class="main-content">
            <h2>Edit Collection</h2>
            <form action="/Free-Write/public/DesignerCollection/updateCollection" method="POST">
                <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                <div class="form-group">
                    <label for="collectionTitle">Title</label>
                    <input type="text" id="collectionTitle" name="collectionTitle" maxlength="100"
                        value="<?= htmlspecialchars($collection['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="collectionDescription">Description</label>
                    <textarea id="collectionDescription" name="collectionDescription" maxlength="255"><?= htmlspecialchars($collection['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="collectionVisibility">Visibility</label>
                    <select id="collectionVisibility" name="collectionVisibility">
                        <option value="1" <?= $collection['isPublic'] ? 'selected' : '' ?>>Public</option>
                        <option value="0" <?= !$collection['isPublic'] ? 'selected' : '' ?>>Private</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="/Free-Write/public/DesignerCollection/dashboard" class="btn btn-cancel">Cancel</a>
            </form>
        </section>
    </main>
</body>
</html>