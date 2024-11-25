<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteDashboard.css">
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
        case 'inst':
            require_once "../app/views/layout/header-inst.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="institution-info">
                <div class="institution-icon"></div>
                <div>
                    <h3><?= htmlspecialchars($instDetails['name']) ?></h3>
                </div>
            </div>
            <nav class="menu">
                <div class="menu-item active"><a href="/Free-Write/public/Institute/Dashboard">Dashboard</a></div>
                <div class="menu-item"><a href="/Free-Write/public/Institute/Library">Library</a></div>
                <div class="menu-item"><a href="/Free-Write/public/Institute/PurchasePackage">Packages</a></div>
                <div class="menu-item"><a href="/Free-Write/public/Institute/ManageUser">User Management</a></div>
            </nav>
        </aside>
        <main class="main-content">
            <header class="header">
                <h1>Welcome to Freewrite, Institution Name</h1>
                <p>Manage your institution's Freewrite experience</p>
            </header>
            <section class="dashboard-overview">
                <h2>Institution Dashboard</h2>
                <p>Access and manage your institution's Freewrite resources.</p>
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Access Library</h3>
                        <p>Explore a vast collection of stories and educational material tailored for your institution.
                        </p>
                    </div>
                    <div class="card">
                        <h3>Purchase Packages</h3>
                        <p>Browse and purchase content packages to expand your library and resources.</p>
                    </div>
                    <div class="card">
                        <h3>Manage Users</h3>
                        <p>Add, remove, or modify user accounts and permissions within your institution.</p>
                    </div>
                </div>
            </section>
            <section class="feature-section">
                <div class="feature-image"></div>
                <div class="feature-content">
                    <h2>Explore and Share Incredible Stories</h2>
                    <p>Join a community of passionate writers and readers. Discover new narratives, participate in
                        contests, and connect with fellow creatives.</p>
                    <div class="feature-buttons">
                        <button class="btn btn-primary">Browse Stories</button>
                        <button class="btn btn-secondary">Start Writing</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="../public/js/Institute/institute dashboard.js"></script>
</body>

</html>