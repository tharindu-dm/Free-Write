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
            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Mod Log ID</th>
                                <th>Mod</th>
                                <th>Activity</th>
                                <th>Occurrence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ayato</td>
                                <td>Deleted user with ID 123</td>
                                <td>2024-05-01 12:00:00</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ayaka</td>
                                <td>Deleted user with ID 456</td>
                                <td>2024-05-01 12:30:00</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Ayato</td>
                                <td>Deleted user with ID 789</td>
                                <td>2024-05-01 13:00:00</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ayaka</td>
                                <td>Deleted user with ID 101112</td>
                                <td>2024-05-01 13:30:00</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Ayato</td>
                                <td>Deleted user with ID 131415</td>
                                <td>2024-05-01 14:00:00</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Ayaka</td>
                                <td>Deleted user with ID 161718</td>
                                <td>2024-05-01 14:30:00</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Ayato</td>
                                <td>Deleted user with ID 192024</td>
                                <td>2024-05-01 15:00:00</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Ayaka</td>
                                <td>Deleted user with ID 222324</td>
                                <td>2024-05-11 15:30:00</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Ayato</td>
                                <td>Deleted user with ID 252627</td>
                                <td>2024-05-12 16:00:00</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Ayaka</td>
                                <td>Deleted user with ID 282930</td>
                                <td>2024-05-14 16:30:00</td>
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