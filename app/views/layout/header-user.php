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
                        <?php if ($_SESSION['user_type'] === 'reader' || $_SESSION['user_type'] === 'writer'): ?>

                            <a class="nav-link" href="/Free-Write/public/User/uploadFirstDesign">
                                <div class="sign-in-btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <button>&nbsp;Upload Design</button>
                                </div>
                            </a>

                        <?php endif; ?>
                    </div>
                    <div class="action-button">
                        <form action="/Free-Write/public/Writer/DashboardNew" method="post">
                            <div class="sign-in-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>

                                <button type="submit">&nbsp;Write </button>
                            </div>
                        </form>
                    </div>
                    <div class="premium-notification-container">
                        <?php if ($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'mod'): ?>
                            <?php if ($_SESSION['user_premium'] == false): ?>
                                <div class="go-premium-button">
                                    <a href="/Free-Write/public#price-plans">
                                        <button class="premium-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                                            </svg>
                                            Go Premium
                                        </button>
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