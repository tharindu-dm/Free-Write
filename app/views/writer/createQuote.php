<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let bookSelect = document.getElementById('book_select');
            let chapterDropdown = document.getElementById('chapter');
            let quoteTextarea = document.getElementById('quote');
            let form = document.querySelector('.quote-form');
            let charWarning = document.createElement('div');
            charWarning.style.color = 'red';
            charWarning.style.display = 'none';
            form.appendChild(charWarning);

            if (!bookSelect || !chapterDropdown || !quoteTextarea) {
                console.error("Dropdown elements not found.");
                return;
            }

            bookSelect.addEventListener('change', function () {
                let bookID = this.value;
                chapterDropdown.innerHTML = '<option value="">Select Chapter</option>';

                if (bookID) {
                    fetch('/Free-Write/public/Writer/NewQuote', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ book_id: bookID })
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Failed to load chapters');
                            return response.json();
                        })
                        .then(data => {
                            if (data.length === 0) {
                                alert('No chapters found for this book.');
                            }
                            data.forEach(chapter => {
                                let option = document.createElement('option');
                                option.value = chapter.chapter;
                                option.textContent = chapter.title;
                                chapterDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching chapters:', error));
                }
            });

            // Check quote length on input and show a warning if over 255 characters
            quoteTextarea.addEventListener('input', function () {
                let quoteLength = quoteTextarea.value.length;
                if (quoteLength > 255) {
                    charWarning.textContent = "Warning: Quote exceeds 255 characters.";
                    charWarning.style.display = 'block';
                    // Disable the submit button if over limit
                    form.querySelector('.post-btn').disabled = true;
                } else {
                    charWarning.style.display = 'none';
                    // Enable the submit button if under limit
                    form.querySelector('.post-btn').disabled = false;
                }
            });
        });
    </script>
</head>

<body>
    <?php
    require_once "../app/views/layout/header-user.php";
    ?>

    <!-- Main Content -->
    <main class="quote-section">
        <h1>Create a Quote</h1>
        <h4>Share your favorite passages from your books. Quotes can be up to 255 characters.</h4>

        <!-- Form for Creating a Quote -->
        <form action="/Free-Write/public/Writer/saveQuote" method="post" class="quote-form">
            <select id="book_select" name="book_id" class="select-quote-input" required>
                <option value="">Select Book</option>
                <?php foreach ($books as $book) {
                    echo "<option value=\"{$book['bookID']}\">{$book['title']}</option>";
                } ?>
            </select>
            <select id="chapter" name="chapter" class="select-quote-input" required>
                <option value="">Select Chapter</option>
                <?php foreach ($chapters as $chapter): ?>
                    <option value="<?= htmlspecialchars($chapter['chapterID']); ?>">
                        <?= htmlspecialchars($chapter['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="quote-container">
                <textarea id="quote" name="quote" class="quote-input" placeholder="Enter your quote here..."
                     required></textarea>
            </div>
            <div class="action-buttons">
                <button type="button" class="edit-btn" onclick="window.history.back();">Cancel</button>
                <button type="submit" class="edit-btn">Post</button>

            </div>
        </form>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>