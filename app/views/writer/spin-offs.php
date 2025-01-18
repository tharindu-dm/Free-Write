<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Spin-off Requests</title>
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
                    <img src="../../app/images/profile/profile-image.jpg" alt="User Profile Image">
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

            <!-- Spin-off  Section -->
            <h3>Spin-off requests</h3>

            <div class="spinoff-list">


                <!-- Spin-off  items -->
                <div class="spinoff-item">
                    <p>The Cat Who Saved the World<br>
                        <small>Requested by: <a href="#">@user123</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>

                <div class="spinoff-item">
                    <p>The Mystery of the Missing Sock<br>
                        <small>Requested by: <a href="#">@user456</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>

                <div class="spinoff-item">
                    <p>The Dragon Who Loved Ice Cream<br>
                        <small>Requested by: <a href="#">@user789</a></small>
                    </p>
                    <button class="accept-btn">View</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>