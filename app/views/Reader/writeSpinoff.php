<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/spinoff.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <!-- Writing Section -->
    <main>
        <section class="writing-section">
            <div class="title">
                <h1>Write a Spinoff</h1>
                <p>Write a spinoff of the book you just read. Let your imagination run wild!</p>
            </div>
            <div class="form-container">
                <form action="/Free-Write/public/Spinoff/Create" method="post">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter a title for your story">

                    <label for="synopsis">Synopsis</label>
                    <textarea id="synopsis" name="synopsis" placeholder="Enter synopsis"></textarea>

                    <label for="parent-book">Parent Book</label>
                    <input type="text" id="parent-book" name="parent-book" placeholder="Enter parent book" disabled
                        value="<?= htmlspecialchars($book['title']); ?>">
                    <input type="hidden" name="bookID" value="<?= $book['bookID']; ?>">

                    <label for="chapter">Select Chapter</label>
                    <select id="chapter" name="chapter">
                        <?php foreach ($chapters as $chapter): ?>
                            <option value="<?= $chapter['chapter']; ?>"><?= $chapter['title']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Access Type</label>
                    <div class="access-type">
                        <input type="radio" id="public" name="access" value="public" checked>
                        <label for="public">Public</label>
                        <input type="radio" id="private" name="access" value="private">
                        <label for="private">Private</label>
                    </div>


                    <button class="create-btn" type="submit">Create</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>