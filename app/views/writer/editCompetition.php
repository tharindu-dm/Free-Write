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
            <form action="/Free-Write/public/Writer/updateCompetition" method="POST" enctype="multipart/form-data">
     
            <h1>Update Competition</h1>
            <p>Invite designers to submit their best book cover designs at competitive prices.<p>

                <!-- competition Details Section -->
                <input type="hidden" name="cID" value="<?php echo $competition['competitionID']; ?>">
                <div class="book-info">
                    <div class="input-group">
                        <label for="title">Title</label>

                        <input type="text" maxlength="45" rows="7" id="title" name="title"
                            placeholder="Book Title" value="<?php echo htmlspecialchars($competition['title']); ?>" required>
                    </div>

                    <div class="input-group">
                <label for="description">Description</label>
                     <!-- Changed from textarea to input -->
                     <input type="text" maxlength="255" id="description" name="description" placeholder="Description"
                      value="<?php echo htmlspecialchars($competition['description']); ?>" required>
                </div>

                    <div class="input-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" id="price" name="price" placeholder="Price"
                        value="<?php echo htmlspecialchars($competition['first_prize'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <p>*The competition expires two months after its creation date.<p>

                    <button type="submit" class="create-btn">Update</button>
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