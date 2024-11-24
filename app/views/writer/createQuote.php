<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Quote - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
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


        <form action="/Free-Write/public/Quote/NewQuote" method="post" class="quote-form">
            <textarea id="quote" name="quote" class="quote-input" placeholder="Enter your quote here..." maxlength="280" required></textarea>
            <input type="text" id="book_title" name="book_title" class="book-title-input" placeholder="Enter your book's title" required>
            <button type="submit" class="post-btn">Post</button>
        </form>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>
</html>
