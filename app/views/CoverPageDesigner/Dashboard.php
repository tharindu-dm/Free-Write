<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Cover Designer</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
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
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <main class="dashboard-container">

        <aside class="side-nav">
            <ul>
                <li><a href="/Free-Write/public/Designer/Dashboard" class="active">Dashboard</a></li>
                <li><a href="/Free-Write/public/Designer/Competition">Competitions</a></li>
                <li><a href="/Free-Write/public/Designer/New">Create New Design</a></li>
                <!-- <li><a href="/Free-Write/public/Designer/MyOrders">My Orders</a></li> -->
                <li><a href="/Free-Write/public/User/profile">Profile</a></li>
            </ul>
        </aside>
        <section class="main-content">
            <section class="user-profile">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Profile Picture" class="profile-picture">
                <h1><?= htmlspecialchars($userDetails['firstName'] ?? 'Designer Name') ?></h1>
                <p><?= htmlspecialchars($userDetails['followers'] ?? '0') ?> followers</p>
            </section>

            <nav class="profile-nav">
                <a href="#" class="active">Your Designs</a>
                <a href="/Free-Write/public/Designer/Competition">Competitions</a>
            </nav>

            <section class="designs">
                <div class="designs-header">
                    <h2>Your Designs</h2>
                    <a href="/Free-Write/public/Designer/New"><button class="new-design-btn">+New</button></a>
                </div>
                <div class="design-grid">
                    <?php if (!empty($designs)) : ?>
                        <?php foreach ($designs as $design) : ?>
                            <div class="design-item">
                                <a href="/Free-Write/public/Designer/viewDesign/<?= $design['covID'] ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
                                </a>
                                <p><?= htmlspecialchars($design['name']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No designs found. Start creating your first design!</p>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>

    <script src="script.js"></script>
</body>

</html>