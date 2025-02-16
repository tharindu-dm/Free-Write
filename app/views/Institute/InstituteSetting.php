<!-- views/settings.view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteSetting.css">
</head>

<body>
    <!-- Sidebar Navigation -->
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

    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- <header>
                <div class="search-bar">
                    <input type="search" placeholder="Search">
                </div>
                <div class="header-actions">
                    <button class="btn-publish">Publish</button>
                    <button class="btn-signin">Sign In</button>
                    <div class="user-profile">
                        <img src="<?php echo htmlspecialchars($userProfileImage); ?>" alt="Profile">
                    </div>
                </div>
            </header> -->

            <section class="settings-section">
                <h1>Settings</h1>
                <p>Manage your Freewrite account settings.</p>

                <div class="tabs">
                    <button class="tab active" data-tab="account">Account</button>
                    <button class="tab" data-tab="preferences">Preferences</button>
                    <button class="tab" data-tab="notifications">Notifications</button>
                </div>

                <form id="settingsForm" class="settings-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($userEmail); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" value="********" readonly>
                    </div>

                    <div class="form-group">
                        <label>Connected Accounts</label>
                        <div class="connected-accounts">
                            <span>Facebook, Google</span>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn-change-email">Change Email</button>
                        <button type="button" class="btn-change-password">Change Password</button>
                    </div>

                    <div class="profile-visibility">
                        <button type="button" class="btn-profile active" data-profile="public">Public Profile</button>
                        <button type="button" class="btn-profile" data-profile="private">Private Profile</button>
                    </div>

                    <div class="profile-content">
                        <!-- Profile content area -->
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-edit">Edit Profile</button>
                        <div class="save-cancel">
                            <button type="submit" class="btn-save">Save Changes</button>
                            <button type="button" class="btn-cancel">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <footer>
        <nav>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            <a href="/privacy">Privacy Policy</a>
            <a href="/terms">Terms of Service</a>
        </nav>
    </footer>

    <script src="assets/js/settings.js"></script>
</body>

</html>