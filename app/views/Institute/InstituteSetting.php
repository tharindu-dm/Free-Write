<!-- views/settings.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteSetting.css">

    <div class="logo">
        <img src="freewrite-logo.png" alt="Freewrite">
        Freewrite
    </div>
    <nav>
        <a href="#">Browse</a>
        <a href="#">Contests</a>
        <a href="#">For Publishers</a>
        <a href="#">For Advertisers</a>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search">
    </div>
    <button class="btn btn-primary">Publish</button>
    <button class="btn btn-secondary">Sign In</button>
    <div class="user-avatar">
        <img src="user-avatar.png" alt="User">
    </div>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="institution-info">
                <div class="institution-icon">
                    <img src="assets/images/institution-icon.png" alt="Institution">
                </div>
                <div class="institution-details">
                    <h3><?php echo htmlspecialchars($institutionName); ?></h3>
                    <p>Institution/Manage</p>
                </div>
            </div>
            
            <ul class="nav-links">
                <li><a href="/library"><i class="icon-library"></i>Library</a></li>
                <li><a href="/packages"><i class="icon-packages"></i>Purchase Packages</a></li>
                <li><a href="/users"><i class="icon-users"></i>Manage Users</a></li>
                <li class="active"><a href="/settings"><i class="icon-settings"></i>Settings</a></li>
            </ul>
        </nav>

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
