<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/Free-Write/public/css/profile.css">
    <link rel="stylesheet" href="/Free-Write/public/css/createCollection.css">
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

                            <?php if (!isset($_SESSION['user_id']) || (isset($_GET['user']) && $_GET['user']!=$_SESSION['user_id'])): ?>
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
                    <?php if ($userType != 'pub' && $userType != 'inst'): ?>
                        <button class="user-nav-button" data-view="spinoffs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            My Spin-offs
                        </button>
                        <button class="user-nav-button" data-view="my-network">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            My Network
                        </button>
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
                            <p><?= htmlspecialchars($userDetails['bio']) ?></p>
                        </div>
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

                    </div>
                    <!-- My Book Collections Section -->
                    <div class="my-book-collections">
                        <div class="book-collection-heading">
                            <h3>My Book Collections</h3>
                            <button class="edit-profile-btn" id="createCollectionBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12"
                                    stroke-width="0.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 2.25v7.5m3.75-3.75h-7.5" />
                                </svg>
                                New Collection
                            </button>
                        </div>
                        <div class="collections-grid">
                            <!-- Collection items will be dynamically populated -->
                            <?php if (!empty($collections)): ?>
                                <?php foreach ($collections as $collection): ?>
                                    <a
                                        href="/Free-Write/public/Collection/view/<?= htmlspecialchars($collection['collectionID']); ?>">
                                        
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

                <!-- Spin-offs Section -->
                <div id="spinoffs" class="view-section">
                    <h2>My Spin-offs</h2>
                    <div class="spin-off-message">
                        <h3>Creating a Spin-off</h3>
                        <p>
                            Spin-offs are stories that are based on existing stories. You can create a spin-off of
                            your
                            own story or any other story you like. Please note that you need to have read the
                            chapter
                            you create a spin-off of, and you can only create spin-offs of chapters that are public
                            except the first chapter.
                        </p>
                        <p>
                            Additionally, spin-offs are a great way to explore alternate storylines, character arcs,
                            or
                            even dive deeper into untold backstories. Remember to give credit to the original story
                            where required,
                            and ensure your spin-off aligns with the community guidelines to maintain a respectful
                            and
                            engaging environment for all users.
                        </p>
                        <p>Access spinoff creation through the book overview.</p>
                    </div>

                    <?php if (!empty($spinoffs)): ?>
                        <div class="spinoff-container">
                            <?php foreach ($spinoffs as $spinoff): ?>
                                <a href="/Free-Write/public/spinoff/Overview/<?= htmlspecialchars($spinoff['spinoffID']); ?>">
                                    <div class="spinoff-item">
                                        <div class="spinoff-content">
                                            <h3 class="spinoff-title"><?= htmlspecialchars($spinoff['SpinoffName']); ?></h3>
                                            <p class="book-title"><?= htmlspecialchars($spinoff['BookTitle']); ?></p>
                                            <div class="spinoff-details">
                                                <div class="spinoff-meta">
                                                    <span class="chapter-count"><?= $spinoff['SpinoffChapterCount'] ?>
                                                        Chapters</span>
                                                    <span
                                                        class="access-type"><?= htmlspecialchars($spinoff['AccessType']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No spin-offs yet.</p>
                    <?php endif; ?>
                </div>

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
                    <h2>My Orders</h2>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <div class="order-item">
                                <p>Order #<?= htmlspecialchars($order['orderID']); ?></p>
                                <p>Date: <?= htmlspecialchars($order['orderDate']); ?></p>
                                <p>Total: $<?= number_format($order['total'], 2); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No orders yet.</p>
                    <?php endif; ?>
                </div>

                <!-- Followers Section -->
                <div id="my-network" class="view-section">
                    <div class="myfollow-tabs">
                        <div class="myfollow-tab active" onclick="switchTab('followers')">Followers</div>
                        <div class="myfollow-tab" onclick="switchTab('following')">Following</div>
                    </div>

                    <div id="followers-grid" class="myfollow-user-grid">
                        <?php if ($followedByList): ?>
                            <?php foreach ($followedByList as $follower): ?>
                                <a href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($follower['user']) ?>">
                                    <div class="myfollow-user-card">
                                        <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($follower['profileImage'] ?? 'profile-image.jpg') ?>"
                                            alt="John Doe" class="myfollow-user-image">
                                        <div class="myfollow-user-info">
                                            <div class="myfollow-user-name"><?= htmlspecialchars($follower['userName']) ?>
                                            </div>
                                            <div class="myfollow-user-last-logged">
                                                <?= htmlspecialchars($follower['lastLogDate']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No followers yet.</p>
                        <?php endif; ?>
                    </div>

                    <div id="following-grid" class="myfollow-user-grid" style="display: none;">
                        <?php if ($followingList): ?>
                            <?php foreach ($followingList as $follower): ?>
                                <a href="/Free-Write/public/User/Profile?user=<?= htmlspecialchars($follower['user']) ?>">
                                    <div class="myfollow-user-card">
                                        <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($follower['profileImage'] ?? 'profile-image.jpg') ?>"
                                            alt="Sarah Lee" class="myfollow-user-image">
                                        <div class="myfollow-user-info">
                                            <div class="myfollow-user-name"><?= htmlspecialchars($follower['userName']) ?>
                                            </div>
                                            <div class="myfollow-user-last-logged">
                                                <?= htmlspecialchars($follower['lastLogDate']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Not following anyone yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <!-- Edit profile form --------------------------------------- -->
    <div class="edit-profile">
        <div class="close-overlay-button">
            <button id="cancelOverlayBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                close
            </button>
        </div>
        <div class="edit-profile-container">
            <form enctype="multipart/form-data" id="edit-profile-form" action="/Free-Write/public/User/EditProfile"
                method="POST" onsubmit="return validateForm()">

                <div class="edit-profile-item edit-name">
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName"
                            value="<?= htmlspecialchars($userDetails['firstName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="First name can only contain letters and spaces">
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName"
                            value="<?= htmlspecialchars($userDetails['lastName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="Last name can only contain letters and spaces">
                    </div>
                </div>
                <div class="edit-profile-item">
                    <label for="bio">Bio</label>
                    <textarea id="bio" rows="6" name="bio" maxlength="255"
                        required><?= htmlspecialchars($userDetails['bio']); ?></textarea>
                </div>

                <div class="edit-profile-item">
                    <label for="profileImage" class="drop-zone" id="drop-zone">
                        <span>Drag & drop your profile image here or click to select</span>
                        <input type="file" id="PlaceImage" name="profileImage" accept="image/*">
                    </label>
                </div>

                <div class="edit-profile-item">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($userDetails['dob']); ?>">
                </div>
                <div class="edit-profile-item">
                    <label for="country">Country</label>
                    <select id="country" name="country">
                        <!-- 195 main countries -->
                        <option value="">country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia (Plurinational State of)">Bolivia (Plurinational State of)
                        </option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the
                        </option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Greece">Greece</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, North">Korea, North</option>
                        <option value="Korea, South">Korea, South</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                        </option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macedonia North">Macedonia North</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia">Micronesia</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                        </option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Sudan">South Sudan</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syria</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey (Türkiye)">Turkey (Türkiye)</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Vatican City Holy See">Vatican City Holy See</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>

                    </select>
                </div>
                <div class="edit-profile-item">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($userAccount['email']); ?>"
                        required>
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
                <form action="/Free-Write/public/User/DeleteProfile" method="POST">
                    <button class="delete-account-btn" type="submit">Delete Account</button>
                </form>
            </div>
            <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
        </div>
    </div>

    <!-- Report user form --------------------------------------- -->
    <div id="report-profile" class="edit-profile">
        <div class="close-overlay-button">
            <button id="report-cancelOverlayBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                close
            </button>
        </div>
        <div class="edit-profile-container">
            <form id="report-profile-form" action="/Free-Write/public/User/ReportProfile" method="POST"
                onsubmit="return validateForm()">
                <input hidden type="text" id="reportedUserID" name="reportedUserID"
                    value="<?= htmlspecialchars($userAccount['userID']); ?>">

                <div class="edit-profile-item edit-name">
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName"
                            value="<?= htmlspecialchars($userDetails['firstName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="First name can only contain letters and spaces" disabled>
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName"
                            value="<?= htmlspecialchars($userDetails['lastName']); ?>" required maxlength="45"
                            pattern="[A-Za-z\s]+" title="Last name can only contain letters and spaces" disabled>
                    </div>
                </div>
                <div class="edit-profile-item">
                    <label for="select">For further details we may contact you</label>
                    <select type="select" id="selectReason" name="selectReason" required>
                        <option value="">Select Reason</option>
                        <option value="harassment">Harassment</option>
                        <option value="spam">Spam</option>
                        <option value="hate speech">Hate Speech</option>
                        <option value="violence">Violence</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="edit-profile-item">
                    <label for="description">Briefly Describe Your Reason (600 characters)</label>
                    <textarea id="description" rows="6" name="description" maxlength="600" required></textarea>
                </div>

                <div class="edit-profile-item">
                    <label for="email">We may contact you for further details</label>
                    <input type="email" id="email" name="email" maxlength="50" required>
                </div>
                <div class="edit-profile-item">
                    <label for="bio">You can contact us via</label>
                    <p>freewrite_support@freewrite.com</p>
                </div>
                <div class="edit-profile-item">
                    <button type="submit" name="submit">Submit Report</button>
                </div>
            </form>
            <button class="discard-change-btn" id="cancelOverlay">Discard Changes</button>
        </div>
    </div>

    <!-- Create Collection Form --------------------------------------- -->
    <div class="edit-profile create-collection-overlay">
        <div class="close-overlay-button">
            <button id="collection-cancelOverlayBtn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                close
            </button>
        </div>
        <div class="edit-profile-container">
            <form id="collectionForm" action="/Free-Write/public/User/CreateCollection" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" maxlength="45" placeholder="Enter a title for your collection">
                    <span class="error-message" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="Collect_description" name="Collect_description"
                        placeholder="Tell us about your collection..." maxlength="255"></textarea>
                    <span class="error-message" id="descriptionError"></span>
                </div>

                <div class="form-group">
                    <label for="visibility">Visibility</label>
                    <select id="visibility" name="visibility">
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                </div>

                <button class="create-btn" type="submit">
                    <span>Create Collection</span>
                    <i class="arrow-icon"></i>
                </button>
            </form>
            <button class="discard-change-btn-collection" id="cancelOverlay">Discard Changes</button>
        </div>
    </div>

    <script src="/Free-Write/public/js/user/profile.js"></script>
    <script src="/Free-Write/public/js/user/createCollection.js"></script>
    <script src="/Free-Write/public/js/user/reportUser.js"></script>
    <script src="/Free-Write/public/js/imageAdd.js"></script>
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