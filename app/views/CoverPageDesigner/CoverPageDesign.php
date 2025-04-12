<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Swallow</title>
    <link rel="stylesheet" href="/Free-Write/public/css/CoverPageDesign.css">
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
        <div class="product-container">
            <div class="product-image">
                <img src="design1.jpeg" alt="Swallow Artwork">
            </div>
            <div class="product-details">
                <h1>Swallow</h1>
                <p class="product-description">
                    "An awe-inspiring artwork capturing the majestic journey of a bird soaring through towering mountain
                    peaks. The vibrant colors of the sky blend with the rugged terrain below, illustrating a sense of
                    freedom and tranquility. The bird's graceful flight symbolizes the spirit of adventure and the
                    boundless connection between nature and the skies."
                </p>
                <p class="product-price">5.99$</p>
                <div class="action-buttons">
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>