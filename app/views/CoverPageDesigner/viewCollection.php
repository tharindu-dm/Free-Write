<!-- filepath: c:\xampp\htdocs\Free-Write\app\views\CoverPageDesigner\viewCollection.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Collection</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
    <style>
    /* General Styles */
    body {
        background-color: #F5F0E5;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .main-content {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        text-decoration: none;
        color: #2c3e50;
        font-weight: bold;
        font-size: 1rem;
    }

    .back-btn:hover {
        text-decoration: underline;
    }

    /* Collection Details */
    .collection-details {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .collection-details h2 {
        margin: 0 0 10px 0;
        font-size: 1.8rem;
        color: #2c3e50;
    }

    .collection-details p {
        margin: 5px 0;
        font-size: 1rem;
        color: gray;
    }

    /* Add Design Section */
    .add-design-section {
        background: #fafafa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #eee;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .add-design-section h3 {
        margin-top: 0;
        font-size: 1.5rem;
        color: #2c3e50;
    }

    .add-design-section form {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .add-design-section select,
    .add-design-section button {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        background: #fff;
        transition: all 0.3s ease;
    }

    .add-design-section button {
        background-color: #FFD052;
        color: #1C160C;
        font-weight: bold;
        cursor: pointer;
    }

    .add-design-section button:hover {
        background-color: #E0B94A;
    }

    /* Designs Section */
    .designs-section {
        margin-top: 20px;
    }

    .designs-section h3 {
        margin-bottom: 15px;
        font-size: 1.5rem;
        color: #2c3e50;
    }

    .design-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .design-item {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #ddd;
        padding: 15px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .design-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .design-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #f5f5f5;
    }

    .design-item p {
        margin: 0 0 10px 0;
        font-size: 1rem;
        color: #2c3e50;
    }

    .design-item form {
        display: inline;
    }

    .design-item button {
        border: 1px solid #bbb;
        border-radius: 8px;
        padding: 8px 16px;
        cursor: pointer;
        background: #FFD052;
        font-size: 1rem;
        font-weight: bold;
        color: #1C160C;
        transition: background-color 0.3s ease;
    }

    .design-item button:hover {
        background-color: #E0B94A;
    }
</style>
</head>
<body>
    <main class="dashboard-container">
        <section class="main-content">
        <a href="/Free-Write/public/Designer/Dashboard" class="back-btn">&larr; Back</a>
            <div class="collection-details">
                <h2><?= htmlspecialchars($collection['title']) ?></h2>
                <p><?= htmlspecialchars($collection['description']) ?></p>
                <p>Visibility: <?= $collection['isPublic'] ? 'Public' : 'Private' ?></p>
            </div>

            <!-- Add Design to Collection -->
            <div class="add-design-section">
                <h3>Add Design to Collection</h3>
                <form action="/Free-Write/public/DesignerCollection/addDesignToCollection" method="POST">
                <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                <label for="designID">Select Design:</label>
                <select name="designID" id="designID" required>
                    <?php
                    $designIDsInCollection = array_column($designsInCollection, 'designID');
                    foreach ($allDesigns as $d) {
                        if (!in_array($d['covID'], $designIDsInCollection)) {
                            echo '<option value="' . htmlspecialchars($d['covID']) . '">' . htmlspecialchars($d['name']) . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit">Add Design</button>
            </form>
            </div>

            <!-- Designs in this Collection -->
            <div class="designs-section">
                <h3>Designs in this Collection</h3>
                <?php if (!empty($designs)) : ?>
                    <div class="design-grid">
                        <?php foreach ($designs as $design) : ?>
                            <div class="design-item">
                                <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
                                </a>
                                <p><?= htmlspecialchars($design['name']) ?></p>
                                <form action="/Free-Write/public/DesignerCollection/removeDesignFromCollection" method="POST" style="display:inline;">
                                    <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                                    <input type="hidden" name="designID" value="<?= htmlspecialchars($design['covID']) ?>">
                                    <button type="submit" onclick="return confirm('Remove this design?')">Remove</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>No designs found in this collection.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>