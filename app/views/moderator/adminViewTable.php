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
        case 'admin':
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
                <?php if (!empty($data) && is_array($data)): ?>
                    <?php for ($i = 0; $i < 36; $i++): ?>
                        <div class="stat-card">
                            <p><?= htmlspecialchars($data[$i]['name']); ?></p>
                        </div>
                    <?php endfor; ?>

                <?php else: ?>
                    <p>No table found</p>
                <?php endif; ?>
            </div>
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