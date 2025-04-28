<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/editQuote.css">

    <title>Create a Quote - Free Write</title>
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
                <button type="submit" class="edit-btn">Post Quote</button>
            </div>
        </form>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            let bookSelect = document.getElementById('book_select');
            let chapterDropdown = document.getElementById('chapter');
            let quoteTextarea = document.getElementById('quote');
            let form = document.querySelector('.quote-form');

            // Create character counter element
            let charCounter = document.createElement('div');
            charCounter.className = 'char-counter';
            charCounter.textContent = '0/255';
            document.querySelector('.quote-container').appendChild(charCounter);

            // Create warning element
            let charWarning = document.createElement('div');
            charWarning.className = 'char-warning';
            charWarning.textContent = "Warning: Quote exceeds 255 characters.";
            charWarning.style.display = 'none';
            document.querySelector('.quote-container').after(charWarning);

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
                                option.value = chapter.chapterID;
                                option.textContent = chapter.title;
                                chapterDropdown.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching chapters:', error));
                }
            });

            // Update character counter and check length on input
            quoteTextarea.addEventListener('input', function () {
                let quoteLength = quoteTextarea.value.length;
                charCounter.textContent = quoteLength + '/255';

                if (quoteLength > 255) {
                    charWarning.style.display = 'block';
                    charCounter.style.color = '#d9534f';
                    // Disable the submit button if over limit
                    form.querySelector('[type="submit"]').disabled = true;
                } else {
                    charWarning.style.display = 'none';
                    charCounter.style.color = quoteLength > 200 ? '#ffa500' : '#888';
                    // Enable the submit button if under limit
                    form.querySelector('[type="submit"]').disabled = false;
                }
            });
        });
    </script>
</body>

</html>