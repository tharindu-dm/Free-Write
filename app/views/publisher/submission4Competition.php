<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .competition-header {
            margin-bottom: 20px;
        }

        .competition-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
        }

        .competition-header p {
            margin: 5px 0 0;
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        label span {
            color: red;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            display: none;
        }

        .view-books-btn {
            background-color: #ccc;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .rules-section {
            background-color: #fff8e1;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .rules-section h3 {
            margin: 0 0 10px;
            font-size: 16px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .primary-button {
            background-color: #FFD700;
            color: #333;
        }

        .secondary-button {
            background-color: #ddd;
            color: #333;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            /* Ensure modal is above header */
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            /* Limit modal height */
            overflow-y: auto;
            /* Enable scrolling */
        }

        .close-modal {
            float: right;
            font-size: 1.2em;
            cursor: pointer;
        }

        .book-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            /* Increase gap for better spacing */
            max-height: 60vh;
            overflow-y: auto;
            padding: 10px;
            /* Add padding for breathing room */
        }

        .book-preview-item {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Ensure content is spaced evenly */
            height: 220px;
            /* Fixed height for consistency */
        }

        .book-preview-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
        }

        .book-preview-item div {
            font-size: 14px;
            margin: 8px 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            /* Prevent text wrapping for titles */
        }

        .select-book-btn {
            background-color: #FFD700;
            color: #333;
            border: none;
            padding: 8px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main class="container">
        <div class="competition-header">
            <h1>Competition</h1>
            <p>Deadline: May 4, 2025</p>
        </div>

        <form id="submission-form" method="POST" action="/Free-Write/public/Competition/SubmitEntry">
            <input type="hidden" name="competition_id"
                value="<?= htmlspecialchars($data['competition']['competitionID'] ?? '') ?>">
            <input type="hidden" name="type" value="<?= htmlspecialchars($data['competition']['type'] ?? '') ?>">
            <input type="hidden" name="selected_item_id" id="selected-item-id" value="">

            <div class="form-group">
                <label for="submission-title">Entry Title <span>*</span></label>
                <input type="text" id="submission-title" name="title" required placeholder="Please fill in the field">
                <div class="error-message" id="title-error"></div>
            </div>

            <div class="form-group">
                <label for="submission-description">Description <span>*</span></label>
                <textarea id="submission-description" name="description" required
                    placeholder="Please fill in the field"></textarea>
                <div class="error-message" id="description-error"></div>
            </div>

            <?php if ($data['competition']['type'] == 'writer' && ($_SESSION['user_type'] == 'writer' || $_SESSION['user_type'] == 'wricov')): ?>
                <div class="form-group">
                    <label for="book-select">Select Book <span>*</span></label>
                    <select id="book-select" name="selected_book">
                        <option value="">select a book</option>
                        <?php if (!empty($data['books'])): ?>
                            <?php foreach ($data['books'] as $book): ?>
                                <option value="<?= htmlspecialchars($book['bookID']) ?>"><?= htmlspecialchars($book['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <button type="button" id="view-books-btn" class="view-books-btn">View Books</button>
                    <div class="error-message" id="selection-error"></div>
                </div>

                <div id="book-preview-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-modal">x</span>
                        <h3>Your Books</h3>
                        <div class="book-preview-grid">
                            <?php if (!empty($data['books'])): ?>
                                <?php foreach ($data['books'] as $book): ?>
                                    <div class="book-preview-item">

                                        <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['cover_image'] ?? 'sampleCover.jpg'); ?>"
                                            alt="Cover Image of <?= htmlspecialchars($book['title']); ?>">

                                        <div><?= htmlspecialchars($book['title']) ?></div>
                                        <button type="button" class="select-book-btn"
                                            data-id="<?= htmlspecialchars($book['bookID']) ?>"
                                            data-title="<?= htmlspecialchars($book['title']) ?>">Select</button>
                                    </div>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No books available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="rules-section">
                <h3>Rules</h3>
                <p><?= nl2br(htmlspecialchars($data['competition']['rules'] ?? 'dff fd df g')) ?></p>
            </div>

            <div class="form-actions">
                <button type="button" id="cancel-submission" class="secondary-button">Cancel</button>
                <button type="submit" id="submit-entry" class="primary-button">Submit</button>
            </div>
        </form>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        // Form validation and submission
        const form = document.getElementById('submission-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            let isValid = true;

            const titleInput = document.getElementById('submission-title');
            const titleError = document.getElementById('title-error');
            if (!titleInput.value.trim()) {
                titleError.textContent = 'Title is required';
                titleError.style.display = 'block';
                isValid = false;
            } else {
                titleError.style.display = 'none';
            }

            const descriptionInput = document.getElementById('submission-description');
            const descriptionError = document.getElementById('description-error');
            if (!descriptionInput.value.trim()) {
                descriptionError.textContent = 'Description is required';
                descriptionError.style.display = 'block';
                isValid = false;
            } else {
                descriptionError.style.display = 'none';
            }

            const bookSelect = document.getElementById('book-select');
            const selectionError = document.getElementById('selection-error');
            if (bookSelect && !bookSelect.value) {
                selectionError.textContent = 'Please select a book';
                selectionError.style.display = 'block';
                isValid = false;
            } else if (selectionError) {
                selectionError.style.display = 'none';
            }

            if (isValid) {
                const confirmSubmit = confirm("Only you can submit once.If you submitted,you cant review or delete your submission.Are you sure you want to submit your entry?");
                if (confirmSubmit) {
                    form.submit();
                }
            }

        });

        // Cancel button
        document.getElementById('cancel-submission').addEventListener('click', function () {
            window.location.href = '/Free-Write/public/Competition/';
        });

        // Book preview modal
        const viewBooksBtn = document.getElementById('view-books-btn');
        const bookPreviewModal = document.getElementById('book-preview-modal');
        const closeModal = document.querySelector('.close-modal');
        const bookSelect = document.getElementById('book-select');
        const selectedItemIdInput = document.getElementById('selected-item-id');

        if (viewBooksBtn) {
            viewBooksBtn.addEventListener('click', () => bookPreviewModal.style.display = 'flex');
        }

        if (closeModal) {
            closeModal.addEventListener('click', () => bookPreviewModal.style.display = 'none');
        }

        window.addEventListener('click', (e) => {
            if (e.target === bookPreviewModal) {
                bookPreviewModal.style.display = 'none';
            }
        });

        document.querySelectorAll('.select-book-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const bookId = this.getAttribute('data-id');
                bookSelect.value = bookId;
                selectedItemIdInput.value = bookId;
                bookPreviewModal.style.display = 'none';
            });
        });

        if (bookSelect) {
            bookSelect.addEventListener('change', function () {
                selectedItemIdInput.value = this.value;
            });
        }
    </script>
</body>

</html>