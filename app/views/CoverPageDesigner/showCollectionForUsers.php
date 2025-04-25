<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Designs</title>
    <style>
        .collection-header {
            text-align: center;
            padding: 2rem 0;
            background: #f8f9fa;
            margin-bottom: 2rem;
        }

        .collection-header h1 {
            color: #333;
            margin-bottom: 1rem;
        }

        .collection-header p {
            color: #666;
            max-width: 800px;
            margin: 0 auto;
        }

        .collection-designs {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .designs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .design-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .design-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .design-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .design-info {
            padding: 1rem;
        }

        .design-info h3 {
            margin: 0;
            color: #333;
            font-size: 1.1rem;
        }

        .design-info p {
            color: #666;
            font-size: 0.9rem;
            margin: 0.5rem 0 0;
        }

        @media (max-width: 768px) {
            .designs-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }

            .design-card img {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="collection-header">
            <h1><?= htmlspecialchars($collection['title']) ?></h1>
            <p><?= htmlspecialchars($collection['description']) ?></p>
        </div>

        <div class="collection-designs">
            <div class="designs-grid">
                <?php if (!empty($designs)): ?>
                    <?php foreach ($designs as $design): ?>
                        <div class="design-card">
                            <a href="/Free-Write/public/Designer/viewDesignForNonOwner/<?= htmlspecialchars($design['covID']) ?>">
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
                                     alt="<?= htmlspecialchars($design['name']) ?>">
                                <div class="design-info">
                                    <h3><?= htmlspecialchars($design['name']) ?></h3>
                                    <p>Bio: <?= htmlspecialchars($design['description'])?></p>
                                    
                                    <!-- <p>Created: <?//= date('M d, Y', strtotime($design['uploadDate'])) ?></p> -->
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-designs">No designs found in this collection.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>
</html>