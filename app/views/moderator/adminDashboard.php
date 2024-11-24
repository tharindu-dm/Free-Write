<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Administrator | Freewrite
    </title>
    <link rel="stylesheet" href="/Free-Write/public/css/admin.css">
</head>

<body>

    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'mod':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>
    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <section class="dashboard">
            <div class="stats-grid">
                <div class="stat-card">

                    <h3>Total User Count</h3>
                    <p><?= htmlspecialchars($data[0]['totalUsers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Readers</h3>
                    <p><?= htmlspecialchars($data[0]['readers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Writers</h3>
                    <p><?= htmlspecialchars($data[0]['writers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Cover Designers</h3>
                    <p><?= htmlspecialchars($data[0]['covdes'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Publishers</h3>
                    <p><?= htmlspecialchars($data[0]['pubs'] ?? '0'); ?></p>
                </div>
            </div>

            <div class="stats-grid secondary">
                <div class="stat-card">
                    <h3>Institutions</h3>
                    <p><?= htmlspecialchars($data[0]['inst'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Premium Users</h3>
                    <p><?= htmlspecialchars(($data[0]['premium']) ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Moderators</h3>
                    <p><?= htmlspecialchars($data[0]['mod'] ?? '0'); ?></p>
                </div>
            </div>

            <form class="publish-form">
                <input type="text" placeholder="Subject" class="subject-input">
                <textarea placeholder="Descriptions" class="description-input"></textarea>
                <div class="checkbox-group">
                    <label><input type="checkbox"> All users</label>
                    <label><input type="checkbox"> Writers</label>
                    <label><input type="checkbox"> Cover Designers</label>
                    <label><input type="checkbox"> Institutes</label>
                    <label><input type="checkbox"> Publishers</label>
                </div>
                <button type="submit" class="publish-btn">Publish</button>
            </form>
        </section>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/Admin/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarNav = document.getElementById('sidebar-nav');
            const navItems = sidebarNav.getElementsByTagName('li');

            for (let item of navItems) {
                item.addEventListener('click', function () {
                    // Get the href from data-href attribute
                    const href = this.getAttribute('data-href');

                    // Redirect to the specified URL
                    if (href) {
                        window.location.href = href;
                    }
                });
            }
        });
    </script>
</body>

</html>