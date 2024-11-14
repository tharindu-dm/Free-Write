<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Competitions</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php
    if (isset($_SESSION['userType'])) {
        $userType = $_SESSION['userType'];
    } else {
        $userType = 'guest';
    }

    // Including different headers based on the user type
    switch ($userType) {
        case 'admin':
            require_once "../app/views/layout/adminHeader.php";
            break;
        case 'reader':
            require_once "../app/views/layout/userHeader.php";
            break;
        case 'writer':
            require_once "../app/views/layout/writerHeader.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <!-- Main Content -->
    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="User Profile">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p><?php echo htmlspecialchars($user['followers']); ?> followers</p>
            </div>

            <!-- Navigation for Writer Options -->
            <nav class="writer-nav">
                <a href="#">Books</a>
                <a href="#">Quotes</a>
                <a href="#">Spin-offs</a>
                <a href="#">Competitions</a>
            </nav>

            <!-- Competitions Section -->
            <div>
                <h3>Competitions</h3>
                
                <!-- Button to Add New Competition -->
                <a href="#" class="button-new">+ New</a>

                <!-- Pending Competitions List -->
                <div class="competitions-list">
                    <h4>Pending</h4>

                    <?php foreach ($competitions as $competition): ?>
                        <div class="competition-item">
                            <p><strong><?php echo htmlspecialchars($competition['title']); ?></strong></p>
                            <p>Genre: <?php echo htmlspecialchars($competition['genre']); ?></p>
                            <button class="delete-btn">Delete</button>
                            <button class="view-btn">View</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="../public/js/home.js"></script>
</body>

</html>
