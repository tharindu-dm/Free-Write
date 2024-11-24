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

    //show($data);
    ?>
    <main>
        <div class="dashboard">
            <!-- Profile Section -->
        <div class="profile-section">
        <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>

        <?php if (!empty($userDetails) && is_array($userDetails)): ?>
        <div class="profile-info">
            <h2><?= htmlspecialchars($userDetails[0]['fullName'] ?? 'Unknown User'); ?></h2>
            
        </div>
        <?php else: ?>
            <h2>Michael Thompson</h2>
            <p>250 followers</p>
        <?php endif; ?>
        </div>
            <!-- Navigation for Writer Options -->
            <?php require_once "../app/views/writer/writerNav.php"; ?>

            <!-- Competitions Section -->
            <div>
                <h3>Competitions</h3>
                <a href="/Free-Write/public/Writer/ViewCompetitions">>>>>>>Competitions<<<<<< </a>
                        <br /><!-- template button -->

                        <!-- Button to Add New Competition -->
                        <a href="/Free-Write/public/Writer/NewCompetition" class="button-new">+ New</a>

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