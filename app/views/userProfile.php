<?php
//profile of user. reader, writer and covdes. check userType and display the profile accordingly 
//for example, if only reader, display only the reader profile and add a button to upgrade to writer or covdes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/profile.css">
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
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <main>
        <section class="profile-container">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>
                <?php if (!empty($user) && is_array($user)): ?>
                    <div class="profile-info">
                        <h1><?= htmlspecialchars($user[0]['fullName']); ?></h1>
                        <p><?= explode(' ', $user[0]['regDate'])[0]; ?></p>
                        <p>~ <?= htmlspecialchars($_SESSION['user_type']); ?> ~</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <p><?= htmlspecialchars($user[0]['bio']); ?></p>
                </div>

                <div class="profile-section">
                    <h2>Profile Statistics</h2>
                    <?php if (!empty($listCounts) && is_array($listCounts)): ?>
                        <div class="stats-container">
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Reading">
                                    <h3>Reading</h3>
                                </a>
                                <p id="reading-count"><?= htmlspecialchars($listCounts[0]['reading']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Completed">
                                    <h3>Completed</h3>
                                </a>
                                <p id="completed-count"><?= htmlspecialchars($listCounts[0]['completed']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Onhold">
                                    <h3>On-Hold</h3>
                                </a>
                                <p id="onhold-count"><?= htmlspecialchars($listCounts[0]['hold']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Dropped">
                                    <h3>Dropped</h3>
                                </a>
                                <p id="dropped-count"><?= htmlspecialchars($listCounts[0]['dropped']); ?></p>
                            </div>
                            <div class="stat-item">
                                <a href="/Free-Write/public/BookList/Planned">
                                    <h3>Plan to Read</h3>
                                </a>
                                <p id="plan-to-read-count"><?= htmlspecialchars($listCounts[0]['planned']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-actions">
                <button class="edit-profile-btn">Edit Profile</button>
                <button class="report-btn">Report</button>
            </div>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\profile.js"></script>
</body>

</html>