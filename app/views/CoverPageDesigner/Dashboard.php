<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Cover Designer</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main class="dashboard-container">

        <?php
        require_once "../app/views/CoverPageDesigner/sidebar.php";
        ?>

        <section class="main-content">
            <section class="user-profile">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                    alt="Profile Picture" class="profile-picture">
                <h1><?= htmlspecialchars($userDetails['firstName'] ?? 'Designer Name') . ' ' . htmlspecialchars($userDetails['lastName']) ?>
                </h1>
                <p><?= htmlspecialchars($userDetails['followers'] ?? '0') ?> followers</p>
            </section>

            <nav class="profile-nav">
                <a href="#" class="active">Your Designs</a>
                <a href="/Free-Write/public/DesignerCompetition/index">Competitions</a>
            </nav>

            <section class="designs">
                <div class="designs-header">
                    <h2>Your Designs</h2>
                    <a href="/Free-Write/public/Designer/New"><button class="new-design-btn">+New</button></a>
                </div>
                <div class="design-grid">
                    <?php if (!empty($designs)): ?>
                        <?php foreach ($designs as $design): ?>
                            <div class="design-item">
                                <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                                        alt="<?= htmlspecialchars($design['name']) ?>">
                                </a>
                                <p><?= htmlspecialchars($design['name']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No designs found. Start creating your first design!</p>
                    <?php endif; ?>
                </div>
            </section>

            <div class="create-collection-section">
                <h2>Manage Your Collections</h2>
                <button class="btn btn-primary" id="openCollectionPopup">+ Create Collection</button>
            </div>

            <!-- Display Collections -->
            <h2>Your Image Collections</h2>
            <div class="collections-section">
                <?php if (!empty($collections)): ?>
                    <?php foreach ($collections as $collection): ?>
                        <a href="/Free-Write/public/DesignerCollection/viewCollection/<?= $collection['collectionID'] ?>"
                            class="collection-link">

                            <div class="collection-item">
                                <?php if (!empty($collection['frontImage'])): ?>
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($collection['frontImage']) ?>"
                                        alt="Collection Cover">
                                <?php else: ?>
                                    <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="No Image">
                                <?php endif; ?>
                                <h3><?= htmlspecialchars($collection['title']) ?></h3>
                                <p><?= htmlspecialchars($collection['description']) ?></p>
                                <span>Visibility: <?= $collection['isPublic'] ? 'Public' : 'Private' ?></span>
                                <div class="collection-actions">
                                    <a href="/Free-Write/public/DesignerCollection/editCollection/<?= $collection['collectionID'] ?>"
                                        class="edit-link">Edit</a>
                                    <form action="/Free-Write/public/DesignerCollection/deleteCollection" method="POST"
                                        style="flex: 1;"
                                        onsubmit="return confirm('Are you sure you want to delete this collection?');">
                                        <input type="hidden" name="collectionID"
                                            value="<?= htmlspecialchars($collection['collectionID']) ?>">
                                        <button type="submit" class="delete-link">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
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
                            <input type="text" id="collectionTitle" name="collectionTitle" maxlength="100"
                                placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label for="collectionDescription">Description</label>
                            <textarea id="CollectionDescription" name="CollectionDescription" maxlength="255"
                                placeholder="Describe your collection..."></textarea>
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
        document.addEventListener("DOMContentLoaded", function () {
            // Get DOM elements
            const openCollectionBtn = document.getElementById("openCollectionPopup");
            const collectionOverlay = document.getElementById("designCollectionOverlay");
            const closeBtn = document.getElementById("closeDesignCollection");
            const cancelBtn = document.getElementById("cancelDesignCollection");
            const form = document.getElementById("designCollectionForm");

            // Add CSS for overlay if not already in your CSS file
            const style = document.createElement('style');
            style.textContent = `
        .design-collection-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .design-collection-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            position: relative;
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .design-collection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .design-collection-header h2 {
            color: #333;
            margin: 0;
            font-size: 1.5rem;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            color: #666;
            transition: all 0.3s ease;
        }
    
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .form-actions button {
            flex: 1;
            padding: 0.8rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .create-btn, .cancel-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
            text-align: center;
            border: none;
        }

        create-btn {
            background-color: #ffd700;
            color: #000;
        }

        .create-btn:hover {
            background-color: #000;
            color: #ffd700;
        }

        .cancel-btn {
        background-color: #000;
        color: #fff;
        }

        .cancel-btn:hover {
        background-color:#ffd700;
        color: #000;
        }

        /* Form button container */
.form-button-group {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
  justify-content: flex-end;
}

/* Update form input styles */
#designCollectionForm input,
#designCollectionForm textarea,
#designCollectionForm select {
  width: 100%;
  padding: 0.8rem;
  border: 1px solid #ddd;
  border-radius: 0.5rem;
  font-size: 1rem;
  transition: all 0.3s ease;
}

#designCollectionForm input:focus,
#designCollectionForm textarea:focus,
#designCollectionForm select:focus {
  outline: none;
  border-color: #ffd700;
  box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
}

#designCollectionForm textarea {
  min-height: 120px;
  resize: vertical;
}
    `;
            document.head.appendChild(style);

            // Function to show popup
            function showPopup() {
                if (collectionOverlay) {
                    collectionOverlay.style.display = "flex";
                    // Reset form and remove any error states
                    form.reset();
                    clearErrors();
                }
            }

            // Function to hide popup
            function hidePopup() {
                if (collectionOverlay) {
                    collectionOverlay.style.display = "none";
                    clearErrors();
                }
            }

            // Function to clear error states
            function clearErrors() {
                const inputs = form.querySelectorAll('.error');
                inputs.forEach(input => input.classList.remove('error'));
            }

            // Event listeners
            if (openCollectionBtn) {
                openCollectionBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    showPopup();
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    hidePopup();
                });
            }

            if (cancelBtn) {
                cancelBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    hidePopup();
                });
            }

            // Close when clicking outside
            if (collectionOverlay) {
                collectionOverlay.addEventListener("click", (e) => {
                    if (e.target === collectionOverlay) {
                        hidePopup();
                    }
                });
            }

            // Form validation
            if (form) {
                form.addEventListener("submit", function (e) {
                    let isValid = true;
                    const title = document.getElementById("collectionTitle");
                    const description = document.getElementById("CollectionDescription");

                    // Validate title
                    if (!title.value.trim()) {
                        isValid = false;
                        title.classList.add("error");
                    } else {
                        title.classList.remove("error");
                    }

                    // Validate description
                    if (!description.value.trim()) {
                        isValid = false;
                        description.classList.add("error");
                    } else {
                        description.classList.remove("error");
                    }

                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            }
        });

    </script>

</body>

</html>