<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
    
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // JavaScript for Dynamic Chapter Retrieval
    const bookSelect = document.getElementById('book_select');
    const chapterSelect = document.getElementById('chapter_select');

    bookSelect.addEventListener('change', function () {
        const bookID = this.value;

        // Clear previous chapters
        chapterSelect.innerHTML = '<option value="">Loading chapters...</option>';

        // Fetch chapters for the selected book
        if (bookID) {
            fetch(`/Free-Write/public/Writer/GetChapters/${bookID}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch chapters');
        }
        return response.json();
    })
    .then(data => {
        chapterSelect.innerHTML = '<option value="">Select Chapter</option>';
        if (Array.isArray(data) && data.length > 0) {
            data.forEach(chapter => {
                const option = document.createElement('option');
                option.value = chapter.chapterID;
                option.textContent = chapter.title;
                chapterSelect.appendChild(option);
            });
        } else {
            chapterSelect.innerHTML = '<option value="">No chapters found</option>';
        }
    })
    .catch(error => {
        console.error('Error fetching chapters:', error);
        chapterSelect.innerHTML = '<option value="">Error loading chapters</option>';
    });

        } else {
            chapterSelect.innerHTML = '<option value="">Select a book first</option>';
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
        <p>Share your favorite passages from your books. Quotes can be up to 280 characters.</p>

        <!-- Form for Creating a Quote -->
      <form action="/Free-Write/public/Writer/NewQuote" method="post" class="quote-form">
    <label for="book_select">Select Book:</label>
    <select id="book_select" name="book_id" class="book-select-input" required>
        <option value="">Select Book</option>
        <?php
        $books = (new Book())->getBookByAuthor($_SESSION['user_id']);
        foreach ($books as $book) {
            echo "<option value=\"{$book['bookID']}\">{$book['title']}</option>";
        }
        ?>
    </select>

    <label for="chapter_select">Select Chapter:</label>
    <select id="chapter_select" name="chapter_id" class="chapter-select-input" required>
        <option value="">Select a book first</option>
    </select>

    <!-- Hidden input to hold the chapter name -->
    <input type="hidden" id="chapter_name" name="chapter_name" value="">

    <textarea id="quote" name="quote" class="quote-input" placeholder="Enter your quote here..." maxlength="280" required></textarea>

    <button type="submit" class="post-btn">Post</button>
</form>

    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>
