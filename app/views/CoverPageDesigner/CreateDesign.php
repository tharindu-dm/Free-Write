<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Create Design</title>
    <link rel="stylesheet" href="/Free-Write/public/css/CreateDesign.css">
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
    <main>
        <form id="create-design-form">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter a title for your design">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" min="0" step="0.01">
            </div>
            <div class="upload-area">
                <button type="button" id="upload-btn">Upload</button>
            </div>
            <button type="submit" id="create-btn">Create</button>
        </form>
    </main>
    <script src="script.js"></script>
</body>

</html>