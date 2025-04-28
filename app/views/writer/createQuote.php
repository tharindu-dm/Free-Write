<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Quote - Free Write</title>
    <style>
        
        .quote-section {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .quote-section h1 {
            margin-bottom: 0.5rem;
            color: #333;
            font-size: 2rem;
        }

        .quote-section h4 {
            margin-top: 0;
            margin-bottom: 2rem;
            color: #666;
            font-weight: normal;
        }

        /* Form Styles */
        .quote-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .select-quote-input {
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            font-size: 1rem;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .select-quote-input:focus {
            outline: none;
            border-color: #e6c200;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }

        .quote-container {
            border-radius: 1rem;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            padding: 1rem;
            position: relative;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .quote-container:focus-within {
            border-color: #e6c200;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }

        .quote-input {
            width: 100%;
            min-height: 150px;
            padding: 0.5rem;
            border: none;
            background: transparent;
            font-size: 1rem;
            line-height: 1.6;
            resize: vertical;
            font-family: inherit;
        }

        .quote-input:focus {
            outline: none;
        }

        .char-counter {
            position: absolute;
            bottom: 0.5rem;
            right: 1rem;
            font-size: 0.8rem;
            color: #888;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }

        .edit-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
        }

        .edit-btn:first-child {
            background-color: #f0f0f0;
            color: #333;
        }

        .edit-btn:last-child {
            background-color: #ffd700;
            color: #333;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-btn:first-child:hover {
            background-color: #e5e5e5;
        }

        .edit-btn:last-child:hover {
            background-color: #e6c200;
        }

        /* Warning Message Style */
        .char-warning {
            color: #d9534f;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .quote-section {
                padding: 1.5rem;
                margin: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .edit-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>

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
                <!-- Character counter will be added here by JavaScript -->
            </div>

            <div class="action-buttons">
                <button type="button" class="edit-btn" onclick="window.history.back();">Cancel</button>
                <button type="submit" class="edit-btn">Post Quote</button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>