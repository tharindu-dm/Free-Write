<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/Free-Write/public/css/profile.css">
    <link rel="stylesheet" href="/Free-Write/public/css/createCollection.css">
    <link rel="stylesheet" href="/Free-Write/public/css/advertisement.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <div class="user-profile-container">
            <div class="user-profile-sidebar">
                <div class="user-profile-header">
                    <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                        alt="Profile Picture" class="user-profile-picture">

                    <h2 style="color: var(--black);">
                        <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                    </h2>
                    <div class="follower-stats">
                        <span>Followers <?= htmlspecialchars($follows['followers']) ?></span>
                        <span>Following <?= htmlspecialchars($follows['following']) ?></span>
                    </div>


                    <div class="user-profile-details">
                        <div class="user-profile-actions">
                            <?php if (isset($_SESSION['user_id']) && ($userAccount['userID'] == $_SESSION['user_id'])): ?>
                                <button id="profileEditBtn" class="edit-profile-btn">Edit Profile</button>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['user_id'])): ?>
                                <?php if ($userAccount['userID'] != $_SESSION['user_id']): ?>

                                    <?php if ($isFollowing): ?>
                                        <form method="get" action="/Free-Write/public/User/unfollowUser">
                                            <input hidden name="user" value="<?= $userAccount['userID'] ?>">
                                            <button class="follower-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                                Unfollow
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form method="get" action="/Free-Write/public/User/followUser">
                                            <input hidden name="user" value="<?= $userAccount['userID'] ?>">
                                            <button class="follower-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                                Follow
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>

                            <?php endif; ?>

                            <?php if (!isset($_SESSION['user_id']) || (isset($_GET['user']) && $_GET['user'] != $_SESSION['user_id'])): ?>
                                <button id="reportBtn" class="report-profile-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                    </svg>
                                    Report
                                </button>
                            <?php endif; ?>
                        </div>
                        <p>
                            <strong>Birthday:</strong>
                            <?= date('M d', strtotime($userDetails['dob'])); ?>
                        </p>
                        <p>
                            <strong>Country:</strong>
                            <?= htmlspecialchars($userDetails['country']); ?>
                        </p>
                        <p>
                            <strong>Joined:</strong>
                            <?= date('M d, Y', strtotime($userDetails['regDate'])); ?>
                        </p>
                    </div>
                </div>

                <!-- USER NAV BAR ON LEFT-->
                <hr class="user-profile-divider">
                <div class="user-profile-navigation">
                    <button class="user-nav-button active" data-view="dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </button>
                    <?php if ($userType == 'pub'): ?>
                        <button class="user-nav-button" data-view="advertisements">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75" />
                            </svg>
                            My Advertisements
                        </button>
                    <?php endif; ?>

                    <?php if ($userType == 'pub' || $userType == 'writer'): ?>
                        <button class="user-nav-button" data-view="quotations">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                            </svg>
                            My Quotation Chat
                        </button>
                    <?php endif; ?>

                    <?php if ($userType == 'courier'): ?>
                        <button class="user-nav-button" data-view="courierOrders">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                            </svg>
                            My Courier Orders
                        </button>
                    <?php endif; ?>

                    <?php if ($userType != 'pub' && $userType != 'inst' && $userType != 'courier'): ?>
                        <button class="user-nav-button" data-view="spinoffs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            My Spin-offs
                        </button>
                        <?php if (isset($_SESSION['user_id'])):
                            //if the user logged in then show the button ?>
                            <button class="user-nav-button" data-view="my-network">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                My Network
                            </button>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['user_id']) && ($userAccount['userID'] == $_SESSION['user_id'])): ?>
                            <button class="user-nav-button" data-view="purchased-books">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                Purchased Books
                            </button>
                            <button class="user-nav-button" data-view="orders">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                My Orders
                            </button>
                            <button class="user-nav-button" data-view="my-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                My Cart
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="user-profile-content">
                <div id="dashboard" class="view-section active">
                    <h2>Dashboard</h2>
                    <!-- Existing stats -->
                    <div class="dashboard-stats">
                        <div class="stat-card">
                            <h3>About</h3>
                            <p><?= htmlspecialchars($userDetails['bio'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>

                        </div>
                    </div>
                    <div class="user-type-redirect-btn-container">
                        <?php if (!isset($_SESSION['user_id']) || (isset($_GET['user']) && $_GET['user'] != $_SESSION['user_id'])): ?>
                            <div class="writer-dashboard-btn">

                                <a
                                    href="/Free-Write/public/Writer/DashboardNew?writer=<?= htmlspecialchars($userAccount['userID']) ?>">
                                    <button>Books</button>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['user_id']) || (isset($_GET['user']) && $_GET['user'] != $_SESSION['user_id'])): ?>
                            <div class="writer-dashboard-btn">

                                <a href="#">
                                    <button>Covers</button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    //backend values
                    $totalEntries = $listCounts[0]['reading'] + $listCounts[0]['completed'] + $listCounts[0]['hold'] + $listCounts[0]['dropped'] + $listCounts[0]['planned'];

                    if ($totalEntries == 0) {
                        $readingPercentage = 0;
                        $completedPercentage = 0;
                        $onHoldPercentage = 0;
                        $droppedPercentage = 0;
                        $plannedPercentage = 0;
                    } else {
                        $readingPercentage = ($listCounts[0]['reading'] / $totalEntries) * 100;
                        $completedPercentage = ($listCounts[0]['completed'] / $totalEntries) * 100;
                        $onHoldPercentage = ($listCounts[0]['hold'] / $totalEntries) * 100;
                        $droppedPercentage = ($listCounts[0]['dropped'] / $totalEntries) * 100;
                        $plannedPercentage = ($listCounts[0]['planned'] / $totalEntries) * 100;
                    }
                    ?>

                    <div class="statistics-container">
                        <!-- Book Lists Section -->
                        <div class="book-lists-container">
                            <div class="my-book-list">
                                <h3>My Book List</h3>

                                <!-- Progress Bar -->
                                <div class="book-progress-bar">
                                    <div class="book-progress-segment book-progress-reading"
                                        style="width: <?= htmlspecialchars($readingPercentage) ?>%;"></div>
                                    <div class="book-progress-segment book-progress-completed"
                                        style="width: <?= htmlspecialchars($completedPercentage) ?>%;"></div>
                                    <div class="book-progress-segment book-progress-onhold"
                                        style="width: <?= htmlspecialchars($onHoldPercentage) ?>%;"></div>
                                    <div class="book-progress-segment book-progress-dropped"
                                        style="width: <?= htmlspecialchars($droppedPercentage) ?>%;"></div>
                                    <div class="book-progress-segment book-progress-planned"
                                        style="width: <?= htmlspecialchars($plannedPercentage) ?>%;"></div>
                                </div>

                                <!-- List Items -->
                                <div class="book-list-stats">
                                    <a
                                        href="/Free-Write/public/BookList/Reading?user=<?= htmlspecialchars($userAccount['userID']); ?>">
                                        <div class="book-list-item">
                                            <span class="book-list-label">Reading</span>
                                            <span
                                                class="book-list-count"><?= htmlspecialchars($listCounts[0]['reading']) ?></span>
                                        </div>
                                    </a>
                                    <a
                                        href="/Free-Write/public/BookList/Completed?user=<?= htmlspecialchars($userAccount['userID']); ?>">
                                        <div class="book-list-item">
                                            <span class="book-list-label">Completed</span>
                                            <span
                                                class="book-list-count"><?= htmlspecialchars($listCounts[0]['completed']) ?></span>
                                        </div>
                                    </a>
                                    <a
                                        href="/Free-Write/public/BookList/Onhold?user=<?= htmlspecialchars($userAccount['userID']); ?>">
                                        <div class="book-list-item">
                                            <span class="book-list-label">On Hold</span>
                                            <span
                                                class="book-list-count"><?= htmlspecialchars($listCounts[0]['hold']) ?></span>
                                        </div>
                                    </a>
                                    <a
                                        href="/Free-Write/public/BookList/Dropped?user=<?= htmlspecialchars($userAccount['userID']); ?>">
                                        <div class="book-list-item">
                                            <span class="book-list-label">Dropped</span>
                                            <span
                                                class="book-list-count"><?= htmlspecialchars($listCounts[0]['dropped']) ?></span>
                                        </div>
                                    </a>
                                    <a
                                        href="/Free-Write/public/BookList/Planned?user=<?= htmlspecialchars($userAccount['userID']); ?>">
                                        <div class="book-list-item">
                                            <span class="book-list-label">To Read</span>
                                            <span
                                                class="book-list-count"><?= htmlspecialchars($listCounts[0]['planned']) ?></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php if ($genreFrequency != null): ?>
                            <!-- My Book Genre Section -->
                            <div class="genre-section">
                                <!-- Pie Chart Section -->
                                <div class="chart-container">
                                    <canvas id="genrePieChart"></canvas>
                                </div>

                                <!-- Genre List Section -->
                                <div class="genre-list-container">
                                    <ul id="genreList">
                                        <!-- Genre list will be dynamically populated -->
                                    </ul>
                                </div>
                            </div>

                            <!-- Include Chart.js -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // Convert PHP array to JavaScript array
                                const genreFrequency = <?php echo json_encode($genreFrequency); ?>;

                                // Extract genre names and percentages for the chart
                                const genreNames = genreFrequency.map(item => item.genre_name);
                                const genrePercentages = genreFrequency.map(item => item.percentage);

                                // Generate random colors for each genre
                                const generateColors = (count) => {
                                    if (count === 0) return [];
                                    const colors = [];
                                    for (let i = 0; i < count; i++) {
                                        const hue = (i * 360) / count;
                                        colors.push(`hsl(${hue}, 70%, 60%)`);
                                    }
                                    return colors;
                                };

                                const backgroundColor = generateColors(genreNames.length);

                                // Create pie chart
                                const ctx = document.getElementById('genrePieChart').getContext('2d');
                                const genrePieChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: genreNames,
                                        datasets: [{
                                            data: genrePercentages,
                                            backgroundColor: backgroundColor,
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                display: false // Hide default legend
                                            }
                                        }
                                    }
                                });

                                // Populate the genre list
                                const genreList = document.getElementById('genreList');
                                genreFrequency.forEach((item, index) => {
                                    const listItem = document.createElement('li');
                                    listItem.innerHTML = `
            <span class="color-box" style="background-color: ${backgroundColor[index]};"></span>
            ${item.genre_name}: ${parseFloat(item.percentage).toFixed(1)}%
        `;
                                    genreList.appendChild(listItem);
                                });
                            </script>
                        <?php endif; ?>

                    </div>

                    <!-- My Book Collections Section -->
                    <div class="my-book-collections">
                        <div class="book-collection-heading">
                            <h3>My Book Collections</h3>
                            <hr color="#ffd700" />
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $userAccount['userID']): ?>
                                <button class="edit-profile-btn" id="createCollectionBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12"
                                        stroke-width="0.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 2.25v7.5m3.75-3.75h-7.5" />
                                    </svg>
                                    New Collection
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="collections-grid">
                            <!-- Collection items will be dynamically populated -->
                            <?php if (!empty($collections)): ?>
                                <?php foreach ($collections as $collection): ?>
                                    <a
                                        href="/Free-Write/public/Collection/viewCollection/<?= htmlspecialchars($collection['collectionID']); ?>">

                                        <div class="collection-item">
                                            <img src="/Free-Write/public/images/collectionThumb.jpeg"
                                                alt="Collection Thumbnail">
                                            <div class="collection-details">
                                                <span><?= htmlspecialchars($collection['title']) ?></span>
                                                <span><?= htmlspecialchars($collection['BookCount']) ?></span>
                                                <span><?= htmlspecialchars(($collection['isPublic'] == 1 ? 'public' : 'private')) ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No collections made.</p>
                            <?php endif; ?>
                        </div>
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
                            case 'inst':
                                require_once "../app/views/Profile/instComponent.php";
                                break;
                        }
                        ?>
                    </div>
                    <div>
                        <?php if ($userType == 'pub'): ?>
                            <section class="profile-container">
                                <?= require_once "../app/views/Profile/publisherProfile.php"; ?>
                            </section>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Advertisement Section -->
                <div id="advertisements" class="view-section">
                    <h2>My Advertisement Site</h2>
                    <div class="advertisement-container">
                        <?php if (!empty($data['advertisements'])): ?>
                            <table class="advertisement-table">
                                <thead>
                                    <tr data-ad-id="<?= htmlspecialchars($ad['adID']) ?>">
                                        <th>Advertisement Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Contact Email</th>
                                        <th>Status</th>
                                        <th>Actions</th> <!-- New column for Edit, Save, Cancel, and Delete buttons -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['advertisements'] as $ad): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($ad['advertisementType']) ?></td>
                                            <td><?= htmlspecialchars($ad['startDate']) ?></td>
                                            <td class="editable" contenteditable="false"><?= htmlspecialchars($ad['endDate']) ?>
                                            </td>
                                            <td><?= htmlspecialchars($ad['contactEmail']) ?></td>
                                            <td><?= htmlspecialchars($ad['status']) ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <?php if ($ad['status'] === 'expired'): ?>
                                                        <a
                                                            href="/Free-Write/public/Publisher/applyingAdvertisement/<?= htmlspecialchars($ad['adID']) ?>"><button
                                                                class="edit-btn">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button></a>
                                                    <?php endif; ?>
                                                    <?php if ($ad['status'] === 'active' || $ad['status'] === 'pending'): ?>
                                                        <button class="btn delete-btn" id="deleteAdBtn"
                                                            onclick="showDeleteConfirmation('<?= htmlspecialchars($ad['adID']) ?>')">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="no-ads-message">
                                <p>No currently hired advertisements</p>
                            </div>
                        <?php endif; ?>
                        <a href="/Free-Write/public/Publisher/applyingAdvertisement">
                            <button class="edit-profile-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Apply for Advertisement
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Delete Confirmation Overlay -->
                <div class="deleteOverlay-container">
                    <div class="deleteOverlay">
                        <h2>You will not get refund for this.
                            Are you sure you want to remove this advertisement?</h2>
                        <form action="/Free-Write/public/Publisher/deleteAdvertisement" method="POST">
                            <input type="hidden" name="adID" id="deleteAdID" value="<?=
                                htmlspecialchars(string: $ad['adID']) ?>">
                            <label for="adID-label">Advertisement ID</label>
                            <input type="text" id="adID-label" disabled value="<?=
                                htmlspecialchars(string: $ad['adID']) ?>">
                            <label for="adType-label">Advertisement Type</label>
                            <input type="text" id="adType-label" disabled value="<?=
                                htmlspecialchars(string: $ad['advertisementType']) ?>">
                            <button type="submit" id="deleteAd_Agree">Yes, Delete</button>
                            <button type="button" id="cancelDeleteAd" onclick="hideDeleteOverlay()">Cancel</button>
                        </form>
                    </div>
                </div>

                <div class="editOverlay-container">
                    <div class="editOverlay">
                        <h2>Edit Advertisement End Date</h2>
                        <form action="/Free-Write/public/Publisher/payPage4ad" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="adID" id="editAdID">
                            <div class="form-group">
                                <label for="currentEndDate">Current End Date</label>
                                <input type="text" id="currentEndDate" name="oldEndDate" readonly>
                            </div>
                            <div class="form-group">
                                <label for="newEndDate">New End Date</label>
                                <input type="date" id="newEndDate" name="newEndDate" required>
                            </div>
                            <div class="form-group">
                                <label for="newAdImage">New Advertisement Image</label>
                                <input type="file" id="newAdImage" name="newAdImage" accept="image/*">
                                <p class="description">JPG or PNG, 2MB max</p>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="save-btn">Proceed to Payment</button>
                                <button type="button" class="cancel-btn" onclick="hideEditOverlay()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="quotations" class="view-section">
                    <h2>My Quotation chat </h2>
                    <style>
                        .quotation-container {
                            display: flex;
                            max-width: 1600px;
                            margin-top: 20px;
                            border: 1px solid #ccc;
                            border-radius: 10px;
                            overflow: hidden;
                            font-family: Arial, sans-serif;
                            height: 1000px;
                        }

                        .chat-list {
                            width: 250px;
                            background: #fff;
                            border-right: 1px solid #ccc;
                        }

                        .chat-list-header {
                            background: #FFD052;
                            color: #1C160C;
                            padding: 10px;
                            font-weight: bold;
                            text-align: center;
                        }

                        .chat-user {
                            padding: 15px;
                            border-bottom: 1px solid #eee;
                            cursor: pointer;
                        }

                        .chat-area {
                            flex: 1;
                            display: flex;
                            flex-direction: column;
                            background: #fff;
                        }

                        .chat-header {
                            background: #FFD052;
                            color: #1C160C;
                            padding: 10px;
                            font-weight: bold;
                        }

                        .chat-messages {
                            padding: 15px;
                            height: 1000px;
                            overflow-y: auto;
                            background: #f9f9f9;
                        }

                        .empty-message {
                            text-align: center;
                            color: #888;
                        }

                        .reply-form {
                            padding: 10px;
                            border-top: 1px solid #eee;
                        }

                        .reply-form-container {
                            display: flex;
                            align-items: center;
                        }

                        .reply-textarea {
                            flex: 1;
                            padding: 8px;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                            resize: none;
                            height: 36px;
                            font-size: 14px;
                        }

                        .send-button {
                            margin-left: 8px;
                            background: #FFD052;
                            color: #1C160C;
                            border: none;
                            border-radius: 5px;
                            padding: 8px 12px;
                            cursor: pointer;
                            font-size: 14px;
                            height: 36px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        .no-quotations {
                            text-align: center;
                            padding: 30px;
                            background: #f9f9f9;
                            border-radius: 10px;
                            margin-top: 20px;
                        }
                    </style>

                    <?php if (!empty($quotationData)): ?>
                        <div class="quotation-container">

                            <div class="chat-list">
                                <div class="chat-list-header">Writers</div>

                                <?php foreach ($quotationData as $index => $quotation): ?>
                                    <div onclick="showChat(<?= $index ?>)" class="chat-user">
                                        <?php if ($userType == 'pub'): ?>
                                            <?= htmlspecialchars($quotation['writerName']) ?>
                                        <?php endif; ?>
                                        <?php if ($userType == 'writer'): ?>
                                            <?= htmlspecialchars($quotation['publisherName']) ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Chat area -->
                            <div class="chat-area">
                                <div class="chat-header" id="chatTitle">
                                    Select a writer
                                </div>

                                <div class="chat-messages" id="chatMessages">
                                    <!-- Messages will be inserted here -->
                                    <p class="empty-message">Select a conversation to view messages</p>
                                </div>

                                <!-- Reply form -->
                                <div class="reply-form" id="replyForm" style="display: none;">
                                    <form action="/Free-Write/public/Publisher/sendQuotationChat" method="post"
                                        id="quotationReplyForm">
                                        <input type="hidden" name="writer_id" id="replyWriterId" value="">
                                        <input type="hidden" name="book_id" id="replyBookId" value="">
                                        <input type="hidden" name="publisher_id" id="replyPublisherId" value="">
                                        <div class="reply-form-container">
                                            <textarea name="message" placeholder="Type your message here..." required
                                                class="reply-textarea"></textarea>
                                            <button type="submit" class="send-button">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Store all quotation data from PHP
                            const quotationData = <?= json_encode($quotationData) ?>;

                            function showChat(index) {
                                if (!quotationData[index]) return;

                                const messagesContainer = document.getElementById("chatMessages");
                                const chatTitle = document.getElementById("chatTitle");
                                const replyForm = document.getElementById("replyForm");
                                const replyWriterId = document.getElementById("replyWriterId");
                                const replyBookId = document.getElementById("replyBookId");
                                const replyPublisherId = document.getElementById("replyPublisherId");
                                messagesContainer.innerHTML = "";
                                chatTitle.innerText = quotationData[index].writerName;

                                // Update reply form with current writer and book IDs
                                replyWriterId.value = quotationData[index].writerId;
                                replyBookId.value = quotationData[index].bookId;
                                replyPublisherId.value = quotationData[index].publisherId;
                                replyForm.style.display = "block";

                                // Display messages
                                if (quotationData[index].messages && quotationData[index].messages.length > 0) {
                                    quotationData[index].messages.forEach(msg => {
                                        const div = document.createElement("div");
                                        div.style.marginBottom = "10px";
                                        const headerDiv = document.createElement("div");
                                        headerDiv.style.fontSize = "0.8em";
                                        headerDiv.style.color = "#666";
                                        headerDiv.style.marginBottom = "5px";
                                        headerDiv.textContent = msg.sender_name + " - " + msg.timestamp;
                                        div.appendChild(headerDiv);

                                        const contentDiv = document.createElement("div");
                                        contentDiv.style.padding = "10px";
                                        contentDiv.style.borderRadius = "10px";
                                        contentDiv.style.maxWidth = "75%";
                                        contentDiv.style.background = msg.sender_type === "publisher" ? "#e1ffc7" : "#c7dfff";
                                        contentDiv.textContent = msg.text;
                                        div.appendChild(contentDiv);

                                        // Align writer messages to the right
                                        if (msg.sender_type === "publisher") {
                                            div.style.marginLeft = "auto";
                                        }
                                        if (msg.sender_type === "writer") div.style.marginRight = "auto";
                                        messagesContainer.appendChild(div);
                                    });

                                    // Scroll to bottom
                                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                                } else {
                                    messagesContainer.innerHTML = "<p class='empty-message'>No messages yet</p>";
                                }
                            }

                            // Load first writer by default if available
                            if (quotationData.length > 0) {
                                showChat(0);
                            }
                        </script>

                    <?php else: ?>
                        <div class="no-quotations">
                            <p>You don't have any quotation conversations yet.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div id="courierOrders" class="view-section">
                    <h2>My Orders are here</h2>
                </div>


                <!-- Spin-offs Section -->
                <?php require_once "../app/views/Profile/layouts/Spinoff section.php" ?>

                <!-- Purchased Books Section -->
                <div id="purchased-books" class="view-section">
                    <h2>Purchased Books</h2>
                    <?php if (!empty($purchasedBooks)): ?>
                        <?php foreach ($purchasedBooks as $book): ?>
                            <div class="book-item">
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($book['covimage']); ?>"
                                    alt="Book Cover">
                                <div class="book-details">
                                    <h3><?= htmlspecialchars($book['title']); ?></h3>
                                    <p>Author: <?= htmlspecialchars($book['author']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No purchased books.</p>
                    <?php endif; ?>
                </div>

                <!-- Orders Section -->
                <div id="orders" class="view-section">
                    <h2 class="orders-title">My Orders</h2>

                    <?php if (!empty($orders)): ?>
                        <div class="table-responsive">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Book Name</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="order-row">
                                            <td class="order-id"><?= htmlspecialchars($order['orderID']); ?></td>
                                            <td class="order-id"><?= htmlspecialchars($order['bookTitle']); ?></td>
                                            <td class="order-date"><?= htmlspecialchars($order['quantity']); ?></td>
                                            <td class="order-date"><?= htmlspecialchars($order['orderDate']); ?></td>
                                            <td class="order-total">$<?= number_format($order['totalPrice'], 2); ?></td>
                                            <td class="order-date"><?= htmlspecialchars($order['delivery_status']); ?></td>
                                            <td class="order-actions">
                                                <a href="cancel-order.php?id=<?= htmlspecialchars($order['orderID']); ?>"
                                                    class="btn btn-cancel">Cancel</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="no-orders">
                            <div class="empty-state">
                                <i class="empty-icon">📦</i>
                                <p>No orders yet.</p>
                                <a href="shop.php" class="btn btn-shop">Start Shopping</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <style>
                    .view-section {
                        padding: 25px;
                        max-width: 1100px;
                        margin: 0 auto;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: #ffffff;
                    }

                    .orders-title {
                        font-size: 28px;
                        font-weight: 600;
                        margin-bottom: 25px;
                        color: #1a1a1a;
                        border-bottom: 2px solid #f0f0f0;
                        padding-bottom: 12px;
                    }

                    .table-responsive {
                        overflow-x: auto;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                        border-radius: 8px;
                    }

                    .orders-table {
                        width: 100%;
                        border-collapse: collapse;
                        background-color: #fff;
                        border-radius: 8px;
                        overflow: hidden;
                    }

                    .orders-table thead {
                        background-color: #fcba03;
                        color: #1a1a1a;
                    }

                    .orders-table th {
                        padding: 16px;
                        text-align: left;
                        font-weight: 600;
                        font-size: 15px;
                    }

                    .orders-table tbody tr {
                        border-bottom: 1px solid #f0f0f0;
                        transition: background-color 0.2s ease;
                    }

                    .orders-table tbody tr:last-child {
                        border-bottom: none;
                    }

                    .orders-table tbody tr:hover {
                        background-color: #fffbf0;
                    }

                    .orders-table td {
                        padding: 16px;
                        vertical-align: middle;
                    }

                    .order-id {
                        font-weight: 600;
                        color: #1a1a1a;
                    }

                    .order-date {
                        color: #555;
                    }

                    .order-total {
                        font-weight: 600;
                        color: #1a1a1a;
                    }

                    .order-actions {
                        text-align: center;
                    }

                    .btn {
                        display: inline-block;
                        padding: 8px 16px;
                        border-radius: 4px;
                        text-decoration: none;
                        font-size: 14px;
                        font-weight: 500;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    }

                    .btn-cancel {
                        background-color: #ff4b4b;
                        color: white;
                    }

                    .btn-cancel:hover {
                        background-color: #e53e3e;
                        transform: translateY(-2px);
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }

                    .no-orders {
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                        padding: 40px 20px;
                        text-align: center;
                    }

                    .empty-state {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                    }

                    .empty-icon {
                        font-size: 48px;
                        margin-bottom: 16px;
                        display: block;
                    }

                    .empty-state p {
                        color: #555;
                        font-size: 18px;
                        margin-bottom: 24px;
                    }

                    .btn-shop {
                        background-color: #fcba03;
                        color: #1a1a1a;
                        padding: 10px 24px;
                        font-size: 16px;
                    }

                    .btn-shop:hover {
                        background-color: #e5aa00;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                    }

                    @media (max-width: 768px) {

                        .orders-table th,
                        .orders-table td {
                            padding: 12px 10px;
                        }

                        .orders-title {
                            font-size: 24px;
                        }
                    }
                </style>

                <!-- My Shopping Cart Section -->
                <div id="my-cart" class="view-section">
                    <h2>My Shopping Cart</h2>

                    <?php if (!empty($cartItems)): ?>
                        <div class="table-responsive">
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Book Title</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item): ?>
                                        <tr class="cart-row">
                                            <td><?= htmlspecialchars($item['bookID']) ?></td>
                                            <td><?= htmlspecialchars($item['bookTitle'] ?? 'Book Title') ?></td>
                                            <td>
                                                <div class="quantity-control">
                                                    <button class="quantity-btn minus"
                                                        data-cart-id="<?= htmlspecialchars($item['cartID']) ?>">-</button>
                                                    <span class="quantity"><?= htmlspecialchars($item['quantity']) ?></span>
                                                    <button class="quantity-btn plus"
                                                        data-cart-id="<?= htmlspecialchars($item['cartID']) ?>">+</button>
                                                </div>
                                            </td>
                                            <td>$<?= number_format($item['price'] ?? 0, 2) ?></td>
                                            <td>$<?= number_format(($item['price'] ?? 0) * $item['quantity'], 2) ?></td>
                                            <td>
                                                <form method="post" action="/Free-Write/public/Cart/RemoveFromCart">
                                                    <input type="hidden" name="cartID"
                                                        value="<?= htmlspecialchars($item['cartID']) ?>">
                                                    <button type="submit" class="remove-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </form>
                                                <a href="/Free-Write/public/Publisher/paymentPage/<?= htmlspecialchars($item['bookID']) ?>/<?= htmlspecialchars($item['quantity']) ?>"
                                                    class="checkout-btn-small">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                    </svg>
                                                    Checkout
                                                </a>


                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-cart">
                            <div class="empty-state">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="empty-cart-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <p>Your cart is empty</p>
                                <a href="/Free-Write/public/Publisher" class="btn btn-shop">Start Shopping</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <script>
                        // Quantity adjustment functionality
                        document.querySelectorAll('.quantity-btn').forEach(button => {
                            button.addEventListener('click', function () {
                                const cartId = this.getAttribute('data-cart-id');
                                const isPlus = this.classList.contains('plus');
                                const currentQuantity = parseInt(this.parentElement.querySelector('.quantity').textContent);
                                if (!isPlus && currentQuantity <= 1) {
                                    alert("Quantity cannot be less than 1");
                                    return;
                                }
                                // Send AJAX request to update quantity
                                if (confirm("Are you sure you want to update the quantity?")) {
                                    fetch('/Free-Write/public/Cart/UpdateQuantity', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: `cartID=${cartId}&action=${isPlus ? 'increase' : 'decrease'}`
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // Refresh the page to show updated cart
                                                window.location.reload();
                                            } else {
                                                alert(data.message || 'Failed to update quantity');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('An error occurred while updating the cart');
                                        });
                                }
                            });
                        });
                    </script>
                    <style>
                        .cart-table {
                            width: 100%;
                            border-collapse: collapse;
                            background-color: #fff;
                            border-radius: 8px;
                            overflow: hidden;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                            margin-bottom: 25px;
                        }

                        .checkout-btn-small {
                            display: inline-flex;
                            align-items: center;
                            gap: 5px;
                            background-color: #fcba03;
                            color: #1a1a1a;
                            border: none;
                            border-radius: 4px;
                            padding: 8px 12px;
                            margin-left: 8px;
                            font-size: 14px;
                            font-weight: 500;
                            text-decoration: none;
                            transition: background-color 0.2s, transform 0.2s;
                        }

                        .checkout-btn-small:hover {
                            background-color: #e5aa00;
                            transform: translateY(-2px);
                        }

                        .checkout-btn-small svg {
                            width: 16px;
                            height: 16px;
                        }


                        .cart-table thead {
                            background-color: #fcba03;
                            color: #1a1a1a;
                        }

                        .cart-table th,
                        .cart-table td {
                            padding: 16px;
                            text-align: left;
                            border-bottom: 1px solid #f0f0f0;
                        }

                        .cart-table th {
                            font-weight: 600;
                            font-size: 15px;
                        }

                        .cart-row:hover {
                            background-color: #fffbf0;
                        }

                        .quantity-control {
                            display: flex;
                            align-items: center;
                            justify-content: flex-start;
                        }

                        .quantity-btn {
                            width: 30px;
                            height: 30px;
                            background-color: #f0f0f0;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                            font-size: 16px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transition: background-color 0.2s;
                        }

                        .quantity-btn:hover {
                            background-color: #e0e0e0;
                        }

                        .quantity {
                            margin: 0 10px;
                            font-weight: 500;
                        }

                        .remove-btn {
                            background-color: #ff4b4b;
                            color: white;
                            border: none;
                            border-radius: 4px;
                            padding: 8px 12px;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            gap: 5px;
                            transition: background-color 0.2s;
                        }

                        .remove-btn:hover {
                            background-color: #e53e3e;
                        }

                        .remove-btn svg {
                            width: 16px;
                            height: 16px;
                        }






                        .checkout-btn,
                        .continue-shopping-btn {
                            padding: 12px 24px;
                            border-radius: 6px;
                            font-weight: 600;
                            text-decoration: none;
                            transition: all 0.2s;
                        }

                        .checkout-btn {
                            background-color: #fcba03;
                            color: #1a1a1a;
                        }

                        .checkout-btn:hover {
                            background-color: #e5aa00;
                            transform: translateY(-2px);
                        }

                        .continue-shopping-btn {
                            background-color: #f0f0f0;
                            color: #1a1a1a;
                        }

                        .continue-shopping-btn:hover {
                            background-color: #e0e0e0;
                        }

                        .empty-cart {
                            background-color: #fff;
                            border-radius: 8px;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                            padding: 40px 20px;
                            text-align: center;
                        }

                        .empty-state {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                        }

                        .empty-cart-icon {
                            width: 64px;
                            height: 64px;
                            color: #888;
                            margin-bottom: 16px;
                        }

                        .empty-state p {
                            color: #555;
                            font-size: 18px;
                            margin-bottom: 24px;
                        }

                        .btn-shop {
                            background-color: #fcba03;
                            color: #1a1a1a;
                            padding: 10px 24px;
                            font-size: 16px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-weight: 600;
                        }

                        .btn-shop:hover {
                            background-color: #e5aa00;
                            transform: translateY(-2px);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                        }

                        @media (max-width: 768px) {

                            .cart-table th,
                            .cart-table td {
                                padding: 12px 10px;
                            }



                            .checkout-btn,
                            .continue-shopping-btn {
                                width: 100%;
                                text-align: center;
                            }
                        }
                    </style>


                </div>

                <!-- Followers Section -->
                <?php require_once "../app/views/Profile/layouts/Followers section.php" ?>
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <!-- Edit profile form --------------------------------------- -->
    <?php require_once "../app/views/Profile/layouts/Edit Profile Form.php" ?>

    <!-- Report user form --------------------------------------- -->
    <?php require_once "../app/views/Profile/layouts/Report Profile.php" ?>


    <!-- Create Collection Form --------------------------------------- -->
    <?php require_once "../app/views/Profile/layouts/create collection form.php" ?>

    <script src="/Free-Write/public/js/user/profile.js"></script>
    <script src="/Free-Write/public/js/user/createCollection.js"></script>
    <script src="/Free-Write/public/js/user/reportUser.js"></script>
    <script src="/Free-Write/public/js/imageAdd.js"></script>
    <script src="/Free-Write/public/js/user/advertisement.js"></script>
    <script>
        //handle navigation button clicks
        document.querySelectorAll(".user-nav-button").forEach((button) => {
            button.addEventListener("click", () => {
                // Remove active class from all buttons and sections
                document
                    .querySelectorAll(".user-nav-button")
                    .forEach((btn) => btn.classList.remove("active"));
                document
                    .querySelectorAll(".view-section")
                    .forEach((section) => section.classList.remove("active"));

                // Add active class to clicked button and corresponding section
                button.classList.add("active");
                document.getElementById(button.dataset.view).classList.add("active");
            });
        });
    </script>
    <script>
        //script for switching between followers and following tabs
        function switchTab(tab) {
            const followersGrid = document.getElementById('followers-grid');
            const followingGrid = document.getElementById('following-grid');
            const tabs = document.querySelectorAll('.myfollow-tab');

            tabs.forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');

            if (tab === 'followers') {
                followersGrid.style.display = 'grid';
                followingGrid.style.display = 'none';
            } else {
                followersGrid.style.display = 'none';
                followingGrid.style.display = 'grid';
            }
        }
    </script>

</body>

</html>