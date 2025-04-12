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
                <?php if (!empty($data) && is_array($data)): ?>
                    <?php for ($i = 0; $i < 36; $i++): ?>
                        <a href="/Free-Write/public/Mod/<?= htmlspecialchars($data[$i]['name']); ?>">
                            <div class="stat-card card-float">
                                <p><?= htmlspecialchars($data[$i]['name']); ?></p>
                            </div>
                        </a>
                    <?php endfor; ?>

                <?php else: ?>
                    <p>No table found</p>
                <?php endif; ?>
            </div>
        </section>

        <section style="display:none;">
            <div>
                <h1>Table Name</h1>
            </div>
            <div>
                <table>

                </table>
            </div>
        </section>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/Moderator/viewTable.js"></script>
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