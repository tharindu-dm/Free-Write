<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Create Design</title>
    <link rel="stylesheet" href="/Free-Write/public/css/CreateDesign.css">
</head>

<body>
    <header>
        <?php
        if (isset($_SESSION['user_type'])) {
            $userType = $_SESSION['user_type'];
        } else {
            $userType = 'guest';
        }
        switch ($userType) {
            case 'admin':
            case 'mod':
            case 'writer':
            case 'covdes':
            case 'wricov':
            case 'reader':
                require_once "../app/views/layout/header-user.php";
                break;
            case 'pub':
                require_once "../app/views/layout/header-pub.php";
                break;
            case 'inst':
                require_once "../app/views/layout/header-inst.php";
                break;
            default:
                require_once "../app/views/layout/header.php";
        }
        //show($data);
        ?>
    </header>
    
    <main>
        <!--method="POST" and enctype required for file upload -->
        <form id="create-design-form" method="POST" enctype="multipart/form-data"
            action="/Free-Write/public/Designer/createCover">
            <!-- Title -->
            <div class="form-group">
                <label for="title">Title <span style="color:red">*</span></label>
                <input type="text" id="title" name="title" placeholder="Enter a title for your design" required>
            </div>

            <!-- Optional: Description -->
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <!-- Optional: Price -->
            <div class="form-group">
                <label for="price">Price (optional)</label>
                <input type="number" id="price" name="price" min="0" step="0.01">
            </div>

            <!--  Cover Image File Input -->
            <div class="form-group">
                <label for="coverImage">Cover Image <span style="color:red">*</span></label>
                <input type="file" id="coverImage" name="coverImage" accept="image/*" required>
            </div>

            <!-- Hidden input to send logged-in designer's ID -->
            <input type="hidden" name="designer_id" value="<?= $_SESSION['user_id'] ?? '' ?>">

            <!-- Submit -->
            <div class="form-group">
                <button type="submit" id="create-btn">Create</button>
                <a href="/Free-Write/public/Designer/Dashboard" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </main>

    <script src="/Free-Write/public/js/CreateDesign.js"></script>
</body>

</html>