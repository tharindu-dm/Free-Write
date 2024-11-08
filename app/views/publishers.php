<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers - Free Write</title>
    <link rel="stylesheet" href="/public/css/writer.css">
</head>
<body>

    <!-- Publishers Section -->
    <main class="publishers-section">
        <h1>Publishers</h1>
        
        <!-- Books Grid -->
        <div class="books-grid">
            <?php
            // Sample book data array
            $books = [
                ["title" => "Swallow", "genre" => "voodoo", "image" => "https://via.placeholder.com/150x200"],
                ["title" => "3,003", "genre" => "fiction", "image" => "https://via.placeholder.com/150x200"],
                ["title" => "The 239", "genre" => "comedy", "image" => "https://via.placeholder.com/150x200"],
                ["title" => "The Last She", "genre" => "dystopia", "image" => "https://via.placeholder.com/150x200"],
                ["title" => "Day After", "genre" => "mythology", "image" => "https://via.placeholder.com/150x200"]
            ];

            // Loop through each book and display it
            foreach ($books as $book) : ?>
                <div class="book-item">
                    <img src="<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['title']) ?>">
                    <h3><?= htmlspecialchars($book['title']) ?></h3>
                    <p><?= htmlspecialchars($book['genre']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>
</html>
