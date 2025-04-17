<!-- filepath: c:\xampp\htdocs\Free-Write\app\views\CoverPageDesigner\viewCollection.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Collection</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
    <style>
        .collection-details {
            background: #fff;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .collection-details h2 {
            margin: 0 0 8px 0;
            font-size: 1.7rem;
        }
        .collection-details p {
            margin: 4px 0;
            font-size: 1rem;
        }
        .add-design-section {
            background: #fafafa;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .add-design-section h3 {
            margin-top: 0;
            font-size: 1.2rem;
        }
        .add-design-section form {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .add-design-section select,
        .add-design-section button {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
            background: #fff;
        }
        .add-design-section button {
            font-weight: bold;
            cursor: pointer;
        }
        .designs-section {
            margin-top: 20px;
        }
        .designs-section h3 {
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }
        .design-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }
        .design-item {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .design-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 6px;
            background: #f5f5f5;
        }
        .design-item p {
            margin: 0 0 6px 0;
            font-size: 1rem;
        }
        .design-item form {
            display: inline;
        }
        .design-item button {
            border: 1px solid #bbb;
            border-radius: 4px;
            padding: 0.3rem 0.7rem;
            cursor: pointer;
            background: #fff;
            font-size: 0.95rem;
            font-weight: bold;
        }
        .design-item button:hover {
            background: #f0f0f0;
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