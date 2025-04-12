<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/header.css">
    <title>
        <?php
        $URL = splitURL();
        $page = $URL[0] . " " . splitCamelCase($URL[1])[1];
        echo htmlspecialchars($page);
        ?>
    </title>
</head>

<body>
    <header>
        <nav>
            <div class="logo"><a href="/Free-Write/public/">Free Write</a>
                <div class="nav-button-container">
                    <div class="nav-button"><a href="/Free-Write/public/Browse">Browse</a></div>
                    <div class="nav-button"><a href="/Free-Write/public/Designer/">Designers</a></div>
                    <div class="nav-button"><a href="/Free-Write/public/Publisher/">Publishers</a></div>
                    <div class="nav-button"><a href="/Free-Write/public/Competition/">Competitions</a></div>
                </div>
            </div>

            <div class="nav-right-side-container">
                <div class="action-button-container">
                    <div class="action-button">
                        <form action="/Free-Write/public/Writer/DashboardNew" method="post">
                            <div class="sign-in-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path d="M14.25 3.75l6 6-9 9H5.25v-6L14.25 3.75z" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                <button type="submit"> Write </button>
                            </div>
                        </form>
                    </div>
                    <div class="premium-notification-container">
                        <?php if ($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'mod'): ?>
                            <?php if ($_SESSION['user_premium'] == false): ?>
                                <div class="go-premium-button">
                                    <a href="/Free-Write/public#price-plans">
                                        <button class="premium-btn">Go Premium</button>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="go-premium-button">
                                <a href="/Free-Write/public/<?= ucfirst($_SESSION['user_type']) ?>">
                                    <button class="premium-btn">Dashboard</button>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="notification-button">
                                <button class="notification-btn" id="notification-toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                    </svg>
                                    <span id="notification-badge" class="notification-badge">
                                        <?= htmlspecialchars(sizeof(getUnreadNotifications($_SESSION['user_id']))) ?>
                                    </span>
                                </button>
                                <!-- Notification Overlay -->
                                <div id="notification-overlay" class="notification-overlay">
                                    <div class="overlay-header">
                                        <h3>Notifications</h3>
                                        <div class="overlay-buttons">
                                            <button id="view-all-btn">View All</button>
                                            <button id="mark-all-read-btn">Mark All as Read</button>
                                        </div>
                                    </div>
                                    <div id="notification-list" class="notification-list"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="action-button">
                        <a href="/Free-Write/public/User/Profile">
                            <div class="profile-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <?= htmlspecialchars($_SESSION['user_name']) ?>
                            </div>
                        </a>
                    </div>
                    <div class="action-button">
                        <form action="/Free-Write/public/Login/logout" method="post">
                            <div class="sign-in-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                <button type="submit"> Log Out </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </nav>
    </header>


    <!--SCRIPTS 
    <script>
        // Function to fetch and update notification count
        function updateNotificationCount() {
            fetch('/Free-Write/public/fetch_notifications.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text(); // Get raw text first
                })
                .then(text => {
                    console.log('Raw response:', text); // Log raw response for debugging
                    const data = JSON.parse(text); // Parse it as JSON
                    const badge = document.getElementById('notification-badge');
                    if (badge) {
                        badge.textContent = data.unread_count;
                    }
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                    console.log('Raw response causing error:', text); // Log raw text if defined
                });
        }

        // Initial call
        updateNotificationCount();
        setInterval(updateNotificationCount, 5000);
    </script>-->

    <script src="/Free-Write/public/js/notification.js"></script>
</body>

</html>