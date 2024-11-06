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
    show($data);
    ?>
    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <section class="dashboard">
            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Site Log ID</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Occurrence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Aether</td>
                                <td>Logged in</td>
                                <td>2024-09-01 12:00:00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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