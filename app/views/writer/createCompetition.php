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
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <!-- Main Content -->
    <main class="book-section">
        
    <div class="competition-info">    
            <form action="/Free-Write/public/Writer/createCompetition" method="POST" enctype="multipart/form-data">
     
            <h1>Create a Competition</h1>
            <p>Invite designers to submit their best book cover designs at competitive prices.<p>

                <!-- competition Details Section -->
                <div class="book-info">
                    <div class="input-group">
                        <label for="title">Title</label>

                        <input type="text" maxlength="45" rows="7" id="title" name="title"
                            placeholder="Book Title" required>
                    </div>

                    <div class="input-group">
                        <label for="synopsis">Synopsis</label>

                        <textarea id="Synopsis" maxlength="255" name="Synopsis" placeholder="Synopsis"
                            required></textarea>

                    </div>

                    <div class="input-group">
                    <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="book-select-input" required>
                        <option value="">Select Genre</option>
                        <?php foreach ($genres as $genre) {
                    echo "<option value=\"{$genre['genreID']}\">{$genre['name']}</option>";
                        } ?>
            </select>
                    </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" id="price" name="price" placeholder="Price" required>
                    </div>

                    <p>*The competition expires two months after its creation date.<p>

                    <button type="submit" class="create-btn">Create</button>
                </div>
              </form>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>