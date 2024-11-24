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
        default:
            require_once "../app/views/layout/header.php";
    }

    //show($data);
    ?>

    <main>
        <section class="profile-container">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>
                <?php if (!empty($userDetails) && is_array($userDetails)): ?>
                    <div class="profile-info">
                        <h1><?= htmlspecialchars($userDetails[0]['fullName']); ?></h1>
                        <p><?= explode(' ', $userDetails[0]['regDate'])[0]; ?></p>
                        <p>~ <?= htmlspecialchars($_SESSION['user_type']); ?> ~</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <p><?= htmlspecialchars($userDetails[0]['bio']); ?></p>
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

            <!-- Edit profile form --------------------------------------- -->
            <div class="edit-profile">
                <div class="edit-profile-container">
                    <form id="edit-profile-form" action="/Free-Write/public/User/EditProfile" method="POST">
                        <div class="edit-profile-item">
                            <label for="fullName">Full Name</label>
                            <input type="text" name="fullName"
                                value="<?= htmlspecialchars($userDetails[0]['fullName']); ?>">
                        </div>
                        <div class="edit-profile-item">
                            <label for="bio">Bio</label>
                            <textarea name="bio"><?= htmlspecialchars($userDetails[0]['bio']); ?></textarea>
                        </div>
                        <div class="edit-profile-item">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($userAccount['email']); ?>">
                        </div>
                        <div class="edit-profile-item">
                            <button type="submit" name="submit">Save Changes</button>
                        </div>
                    </form>

                    <hr class="horizontal-divider">

                    <div class="danger-zone">
                        <h3>Danger Zone</h3>
                        <div class="warning-message">
                            <p>Warning: Deleting your account will permanently remove:</p>
                            <ul>
                                <li>All your posts and writings</li>
                                <li>Your profile information</li>
                                <li>Your comments and interactions</li>
                                <li>All associated data</li>
                            </ul>
                            <p>This action cannot be undone.</p>
                        </div>
                        <button class="delete-account-btn" onclick="confirmDelete()">Delete Account</button>
                    </div>
                </div>

            </div>

            <div class="profile-actions">
                <button id="reportBtn" class="report-btn">Report (this button is not funcitonal yet)</button>
                <button id="profileEditBtn" class="edit-profile-btn">Edit Profile</button>
            </div>

            <div class="extra-profile-buttons">
                <?php
                switch ($userType) {
                    case 'writer':
                        require_once "../app/views/Profile/writerComponent.php";
                        break;
                    case 'covdes':
                        require_once "../app/views/Profile/covdesComponent.php";
                        break;
                    case 'wricov':
                        require_once "../app/views/Profile/writerComponent.php";
                        require_once "../app/views/Profile/covdesComponent.php";
                        break;
                }
                ?>
            </div>
        </section>

        <?php if ($userType == 'pub'): ?>
            <section class="profile-container">
                require_once "../app/views/Profile/publisherProfile.php";
            </section>
        <?php endif; ?>

        <section class="profile-container">
            <h1>My Spinoffs</h1>
            <?php if (!empty($spinoffs) && is_array($spinoffs)): ?>
                <div class="spinoff-container">
                    <?php foreach ($spinoffs as $spinoff): ?>
                        <div class="spinoff-item">
                            <div class="spinoff-content">
                                <a href="/Free-Write/public/Spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                    <h2 class="spinoff-title"><?= htmlspecialchars($spinoff['SpinoffName']); ?></h2>
                                </a>
                                <div class="spinoff-details">
                                    <p class="book-title"><?= htmlspecialchars($spinoff['BookTitle']); ?></p>
                                    <div class="spinoff-meta">
                                        <span class="chapter-count"><?= htmlspecialchars($spinoff['SpinoffChapterCount']); ?>
                                            chapters</span>
                                        <span class="access-type"><?= htmlspecialchars($spinoff['AccessType']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\profile.js"></script>
</body>

</html>