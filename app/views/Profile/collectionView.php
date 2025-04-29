<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Collection</title>
    <link rel="stylesheet" href="/Free-Write/public/css/collectionView.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";

    ?>

    <main>
        <div class="collection-header">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Collection Cover" class="collection-image">
            <div class="collection-info">
                <div class="collection-title-row">
                    <h1 class="collection-title"><?= ucfirst($collection['title']) ?> Collection</h1>
                    <span
                        class="collection-status public"><?= ($collection['isPublic'] == 1 ? 'public' : 'private') ?></span>
                    <?php if (isset($_SESSION['user_id']) && ($collection['user'] == $_SESSION['user_id'])): ?>
                        <div class="collection-actions">
                            <button class="btn btn-edit"
                                onclick="document.getElementById('editModal').style.display='flex'">Edit</button>
                            <button class="btn btn-delete"
                                onclick="document.getElementById('deleteModal').style.display='flex'">Delete</button>
                        </div>
                    <?php endif; ?>
                </div>
                <p class="collection-description"><?= $collection['description'] ?></p>
                <p class="books-count"><?= sizeof($books) ?> books in collection</p>
            </div>
        </div>
        <hr style="margin-bottom: 1rem; border: 0.5rem solid #ffd700;" />

        <div class="books-grid">
            <?php foreach ($books as $book): ?>
                <a href="/Free-Write/public/book/Overview/<?= htmlspecialchars($book['bookID']) ?>">
                    <div class="book-card">
                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.png') ?>"
                            alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <h3 class="book-title"><?= htmlspecialchars($book['title'] ?? 'Untitled') ?></h3>
                            <p class="book-author">By <?= htmlspecialchars($book['author'] ?? 'sampleCover.png') ?></p>

                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>



    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <div id="editModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Edit Collection</h2>
            </div>
            <form action="/Free-Write/public/Collection/editCollection" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                <div class="form-group">
                    <label for="collectionTitle"> Title</label>
                    <input type="text" id="collectionTitle" name="collectionTitle"
                        value="<?= htmlspecialchars($collection['title']) ?>" maxlength="45" required>
                </div>
                <div class="form-group">
                    <label for="collectionDescription">Description</label>
                    <textarea id="collectionDescription" name="collectionDescription"
                        maxlength="255"><?= htmlspecialchars($collection['description']) ?> </textarea>
                </div>
                <div class="form-group">
                    <label for="collectionStatus">Status</label>
                    <select id="collectionStatus" name="collectionStatus">
                        <option value="1" selected>Public</option>
                        <option value="0">Private</option>
                    </select>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel"
                        onclick="document.getElementById('editModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Delete Collection</h2>
            </div>
            <p class="delete-message">Are you sure you want to delete this collection? This will remove all books from
                the collection and cannot be undone.</p>
            <form action="/Free-Write/public/Collection/deleteCollection/" method="POST">
                <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">
                <div class="modal-actions">
                    <button class="btn btn-cancel"
                        onclick="document.getElementById('deleteModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Collection</button>
                </div>
            </form>
        </div>
    </div>

    <script src="/Free-Write/public/js/user/collectionView.js"></script>
</body>

</html>