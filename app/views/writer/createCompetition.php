<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Competition - Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>
<body>

    <?php
    // Initialize variables for form fields and error messages
    $description = $bookTitle = $price = '';
    $errors = [];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Description validation
        $description = trim($_POST['description'] ?? '');
        if (empty($description)) {
            $errors['description'] = 'Description is required.';
        } elseif (strlen($description) > 280) {
            $errors['description'] = 'Description must not exceed 280 characters.';
        }

        // Book title validation
        $bookTitle = trim($_POST['bookTitle'] ?? '');
        if (empty($bookTitle)) {
            $errors['bookTitle'] = 'Book title is required.';
        }

        // Price validation
        $price = trim($_POST['price'] ?? '');
        if (empty($price)) {
            $errors['price'] = 'Price is required.';
        } elseif (!is_numeric($price)) {
            $errors['price'] = 'Please enter a valid number for the price.';
        }

        // If no errors, save the competition (simulated here)
        if (empty($errors)) {
            // Save competition logic here, e.g., insert into database
            echo '<p>Competition created successfully!</p>';
        }
    }
    ?>

    <!-- Main Content -->
    <main class="quote-section">
        <h1>Create a Competition</h1>
        <p>Invite designers to submit their best book cover designs at competitive prices</p>

        <!-- Form for Creating a Competition -->
        <form action="" method="POST" class="quote-form">
            <div class="input-group">
                <textarea name="description" class="book-title-input" placeholder="Description" maxlength="280"><?php echo htmlspecialchars($description); ?></textarea>
                <?php if (!empty($errors['description'])): ?>
                    <p class="error"><?php echo $errors['description']; ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <input type="text" name="bookTitle" class="book-title-input" placeholder="Enter your book's title" value="<?php echo htmlspecialchars($bookTitle); ?>">
                <?php if (!empty($errors['bookTitle'])): ?>
                    <p class="error"><?php echo $errors['bookTitle']; ?></p>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <input type="text" name="price" class="book-title-input" placeholder="Price" value="<?php echo htmlspecialchars($price); ?>">
                <?php if (!empty($errors['price'])): ?>
                    <p class="error"><?php echo $errors['price']; ?></p>
                <?php endif; ?>
            </div>

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
