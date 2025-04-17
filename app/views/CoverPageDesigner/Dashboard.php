<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Cover Designer</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
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
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <main class="dashboard-container">

        <aside class="side-nav">
            <ul>
                <li><a href="/Free-Write/public/Designer/Dashboard" class="active">Dashboard</a></li>
                <li><a href="/Free-Write/public/Designer/Competition">Competitions</a></li>
                <li><a href="/Free-Write/public/Designer/New">Create New Design</a></li>
                <li><a href="/Free-Write/public/User/profile">Profile</a></li>
            </ul>
        </aside>
        <section class="main-content">
            <section class="user-profile">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Profile Picture" class="profile-picture">
                <h1><?= htmlspecialchars($userDetails['firstName'] ?? 'Designer Name') ?></h1>
                <p><?= htmlspecialchars($userDetails['followers'] ?? '0') ?> followers</p>
            </section>

            <nav class="profile-nav">
                <a href="#" class="active">Your Designs</a>
                <a href="/Free-Write/public/Designer/Competition">Competitions</a>
            </nav>

            <section class="designs">
                <div class="designs-header">
                    <h2>Your Designs</h2>
                    <a href="/Free-Write/public/Designer/New"><button class="new-design-btn">+New</button></a>
                </div>
                <div class="design-grid">
                    <?php if (!empty($designs)) : ?>
                        <?php foreach ($designs as $design) : ?>
                            <div class="design-item">
                                <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
                                </a>
                                <p><?= htmlspecialchars($design['name']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No designs found. Start creating your first design!</p>
                    <?php endif; ?>
                </div>
            </section>

            <div class="create-collection-section">
                <h2>Manage Your Collections</h2>
                <button class="btn btn-primary" id="openCollectionPopup">Create Collection</button>
            </div>

            <!-- Display Collections -->
            <h2>Your Image Collections</h2>
            <div class="collections-section">
                <?php if (!empty($collections)) : ?>
                    <?php foreach ($collections as $collection) : ?>
                        <a href="/Free-Write/public/DesignerCollection/viewCollection/<?= $collection['collectionID'] ?>" class="collection-link" style="text-decoration:none;color:inherit;">
                        <div class="collection-item">
                            <?php if (!empty($collection['frontImage'])): ?>
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($collection['frontImage']) ?>" alt="Collection Cover" style="width:120px;height:auto;">
                            <?php else: ?>
                                <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="No Image" style="width:120px;height:auto;">
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($collection['title']) ?></h3>
                            <p><?= htmlspecialchars($collection['description']) ?></p>
                            <span>Visibility: <?= $collection['isPublic'] ? 'Public' : 'Private' ?></span>
                            <a href="/Free-Write/public/DesignerCollection/editCollection/<?= $collection['collectionID'] ?>" class="edit-link">Edit</a>
                            <form action="/Free-Write/public/DesignerCollection/deleteCollection" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this collection?');">
                                <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                                <button type="submit" class="delete-link" style="color:red;background:none;border:none;cursor:pointer;">Delete</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No collections found. Create your first collection!</p>
                <?php endif; ?>
            </div>

            
            <!-- Create Collection Popup -->
            <div class="design-collection-overlay" id="designCollectionOverlay">
                <div class="design-collection-container">
                    <div class="design-collection-header">
                        <h2>Create New Design Collection</h2>
                        <button class="close-btn" id="closeDesignCollection">&times;</button>
                    </div>

                    <form id="designCollectionForm" action="/Free-Write/public/Designer/createCollection" method="POST">
                        <div class="form-group">
                            <label for="collectionTitle">Collection Title</label>
                            <input type="text" id="collectionTitle" name="collectionTitle" maxlength="100" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label for="collectionDescription">Description</label>
                            <textarea id="CollectionDescription" name="CollectionDescription" maxlength="255" placeholder="Describe your collection..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="collectionVisibility">Visibility</label>
                            <select id="collectionVisibility" name="collectionVisibility">
                                <option value="1">Public</option>
                                <option value="0">Private</option>
                            </select>
                        </div>

                        <button type="submit" class="create-btn">Create</button>
                        <button type="button" class="cancel-btn" id="cancelDesignCollection">Cancel</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php
        require_once "../app/views/layout/footer.php";
        ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openBtn = document.getElementById('openCollectionPopup'); // Attach this ID to your "Create Collection" button
            const overlay = document.getElementById('designCollectionOverlay');
            const closeBtn = document.getElementById('closeDesignCollection');
            const cancelBtn = document.getElementById('cancelDesignCollection');

            if (openBtn) {
                openBtn.addEventListener('click', () => {
                    overlay.classList.add('active');
                });
            }

            [closeBtn, cancelBtn].forEach(btn => {
                if (btn) {
                    btn.addEventListener('click', () => {
                        overlay.classList.remove('active');
                    });
                }
            });
        });
    </script>

</body>

</html>