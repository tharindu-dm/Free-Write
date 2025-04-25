<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #F5F0E5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .book-container {
            display: flex;
            gap: 40px;
            margin: 20px auto;
            width: 80%;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .book-image {
            flex: 0 0 300px;
        }

        .book-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .book-info {
            flex: 1;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background-color: #FFD052;
            color: white;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .save-btn {
            background-color: #28a745;
            color: white;
            display: none;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
            display: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .Names h1 {
            margin: 0;
            color: #2c3e50;
        }

        .Names p {
            color: gray;
            margin: 5px 0;
        }

        .price-rating {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            color: #FFD052;
        }

        .availability-badge {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin: 10px 0;
        }

        .details {
            margin: 20px 0;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .column {
            flex: 1;
            padding: 10px;
        }

        .column p {
            margin: 5px 0;
        }

        .editable {
            padding: 5px;
            border: 1px solid transparent;
        }

        .editing .editable {
            border: 1px solid #FFD052;
            border-radius: 4px;
        }

        /* Style for form inputs when editing */
        .book-info.editing .editable-input {
            width: 100%;
            padding: 5px;
            border: 1px solid #FFD052;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Hide text elements when editing, show inputs */
        .book-info.editing .editable-text {
            display: none;
        }

        .book-info:not(.editing) .editable-input {
            display: none;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>
    
    <div class="book-container">
        <div class="book-image">
            <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($bookDetails['coverImage'] ?? 'sampleCover.jpg'); ?>"
                alt="Book Cover">

        </div>

        <div class="book-info">
            <form id="book-details-form" action="/Free-Write/public/Publisher/updateBookDetails" method="POST">
                <input type="hidden" name="isbnID"
                    value="<?= htmlspecialchars($bookDetails['isbnID'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                <div class="header-actions">
                    <div class="Names">
                        <h1>
                            <span
                                class="editable editable-text"><?= htmlspecialchars($bookDetails['title'] ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?></span>
                            <input type="text" name="title" class="editable editable-input"
                                value="<?= htmlspecialchars($bookDetails['title'] ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </h1>
                        <p>
                            By <span
                                class="editable editable-text"><?= htmlspecialchars($bookDetails['author_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                            <input type="text" name="author_name" class="editable editable-input"
                                value="<?= htmlspecialchars($bookDetails['author_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </p>
                    </div>

                    <div class="action-buttons">
                        <button type="button" class="btn edit-btn" onclick="toggleEditMode()">Edit</button>
                        <button type="submit" class="btn save-btn">Save</button>
                        <button type="button" class="btn cancel-btn" onclick="cancelEdit()">Cancel</button>
                        <button type="button" class="btn delete-btn" onclick="deleteBook()">Delete</button>
                    </div>
                </div>

                <div class="price-rating">
                    <span class="price">
                        <span
                            class="editable editable-text"><?= htmlspecialchars($bookDetails['prize'] ?? '0.00', ENT_QUOTES, 'UTF-8') ?></span>
                        <input type="text" name="prize" class="editable editable-input"
                            value="<?= htmlspecialchars($bookDetails['prize'] ?? '0.00', ENT_QUOTES, 'UTF-8') ?>"
                            required pattern="\d+(\.\d{1,2})?" title="Enter a valid price (e.g., 19.99)">
                    </span>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="rating-count">(4.5/5 - 2,345 reviews)</span>
                    </div>
                </div>

                <div class="availability-badge">In Stock</div>

                <div class="synopsis">
                    <h3>Synopsis</h3>
                    <p>
                        <span
                            class="editable editable-text"><?= htmlspecialchars($bookDetails['synopsis'] ?? 'No synopsis available', ENT_QUOTES, 'UTF-8') ?></span>
                        <textarea name="synopsis" class="editable editable-input" rows="4"
                            style="width: 100%;"><?= htmlspecialchars($bookDetails['synopsis'] ?? 'No synopsis available', ENT_QUOTES, 'UTF-8') ?></textarea>
                    </p>
                </div>

                <div class="details">
                    <h3>Details</h3>
                    <div class="row">
                        <div class="column">
                            <p><strong>Author</strong></p>
                            <p>
                                By <span
                                    class="editable editable-text"><?= htmlspecialchars($bookDetails['author_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                                <!-- Author is already in the header, so no need for a separate input here -->
                            </p>
                        </div>
                        <div class="column">
                            <p><strong>Genre</strong></p>
                            <p>
                                <span
                                    class="editable editable-text"><?= htmlspecialchars($bookDetails['genre'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                                <input type="text" name="genre" class="editable editable-input"
                                    value="<?= htmlspecialchars($bookDetails['genre'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?>">
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <p><strong>Publisher</strong></p>
                            <p>
                                <span
                                    class="editable editable-text"><?= htmlspecialchars($bookDetails['publisher'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                                <input type="text" name="publisher" class="editable editable-input"
                                    value="<?= htmlspecialchars($bookDetails['publisher'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?>">
                            </p>
                        </div>
                        <div class="column">
                            <p><strong>Published Date</strong></p>
                            <p>
                                <span
                                    class="editable editable-text"><?= htmlspecialchars($bookDetails['published_date'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></span>
                                <input type="date" name="published_date" class="editable editable-input"
                                    value="<?= htmlspecialchars($bookDetails['published_date'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Store original values to revert on cancel
        let originalValues = {};

        function toggleEditMode() {
            // Store original values before editing
            const form = document.getElementById('book-details-form');
            originalValues = Object.fromEntries(new FormData(form));

            // Enable editing mode
            document.querySelector('.book-info').classList.add('editing');
            document.querySelector('.edit-btn').style.display = 'none';
            document.querySelector('.save-btn').style.display = 'inline-block';
            document.querySelector('.cancel-btn').style.display = 'inline-block';
        }

        function cancelEdit() {
            // Revert to original values
            const form = document.getElementById('book-details-form');
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.value = originalValues.get(input.name) || '';
            });

            // Disable editing mode
            document.querySelector('.book-info').classList.remove('editing');
            document.querySelector('.edit-btn').style.display = 'inline-block';
            document.querySelector('.save-btn').style.display = 'none';
            document.querySelector('.cancel-btn').style.display = 'none';
        }

        function deleteBook() {
            if (confirm('Are you sure you want to delete this book?')) {
                const isbnID = document.querySelector('input[name="isbnID"]').value;
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/Free-Write/public/Publisher/deletebookProfile';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'isbnID';
                input.value = isbnID;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Handle form submission
        document.getElementById('book-details-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Book details updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed to update book details: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating book details.');
                });
        });
    </script>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>