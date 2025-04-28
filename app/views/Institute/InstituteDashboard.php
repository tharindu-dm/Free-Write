<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteDashboard.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <div class="dashboard-container">
        <?php include_once "../app/views/Institute/sidebar.php"; ?>
        <main class="main-content">
            <header class="header">
                <h1>Welcome to Freewrite, </h1>
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
                    <a href="/Free-Write/public/Browse" class="btn btn-primary">Browse Stories</a>
                    </div>
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