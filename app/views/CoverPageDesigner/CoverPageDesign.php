<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= htmlspecialchars($design['name']) ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/CoverPageDesign.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>
    
    <main>
        <!-- <aside class="side-nav">
            <ul>
                <li><a href="/Free-Write/public/Designer/Dashboard" class="active">Dashboard</a></li>
                <li><a href="/Free-Write/public/Designer/Competition">Competitions</a></li>
                <li><a href="/Free-Write/public/Designer/New">Create New Design</a></li>
                <li><a href="/Free-Write/public/Designer/MyOrders">My Orders</a></li> -->
        <!--<li><a href="/Free-Write/public/User/profile">Profile</a></li>
            </ul>
        </aside> -->

        <div class="product-container">
            <div class="product-image">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                    alt="<?= htmlspecialchars($design['name']) ?>">
            </div>
            <div class="product-details">
                <h1><?= htmlspecialchars($design['name']) ?></h1>
                <p class="product-description"><?= htmlspecialchars($design['description']) ?></p>
                <div class="action-buttons">
                    <?php if ($_SESSION['user_id'] == $design['artist']): ?>
                        <a href="/Free-Write/public/Designer/edit/<?= $design['covID'] ?>"><button
                                class="edit-button">Edit</button></a>
                    <?php endif; ?>
                    <form action="/Free-Write/public/Designer/delete/<?= $design['covID'] ?>" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this design?');">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>

</html>