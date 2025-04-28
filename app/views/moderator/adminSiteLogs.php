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
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <section class="dashboard">
            <section class="search-section">
                <div class="search-container">
                    <h2>Search Site Logs
                        <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />
                    </h2>
                    <form id="log-search-form" method="GET" action="/Free-Write/public/Mod/siteLogs">
                        <div class="search-fields">
                            <div class="search-field">
                                <label for="search-id">Log ID:</label>
                                <input type="text" id="logid" name="logid" placeholder="Search by ID">
                            </div>

                            <div class="search-field">
                                <label for="search-user">User:</label>
                                <input type="number" id="userID" name="userID" placeholder="Search by USER ID">
                            </div>

                            <div class="search-field">
                                <label for="search-date">Date:</label>
                                <input type="date" id="logdate" name="logdate">
                            </div>
                        </div>

                        <div class="search-buttons">
                            <button type="reset" class="reset-btn">Reset</button>
                            <button type="submit" class="search-btn">Search</button>
                        </div>
                    </form>
                </div>
            </section>

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
                            <?php foreach ($data as $log): ?>
                                <tr>
                                    <td><?= htmlspecialchars($log['siteLogID']); ?></td>
                                    <td><?= htmlspecialchars($log['user']); ?></td>
                                    <td><?= htmlspecialchars($log['activity']); ?></td>
                                    <td><?= htmlspecialchars($log['occurrence']); ?></td>
                                </tr>
                            <?php endforeach; ?>
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
                    const href = this.getAttribute('data-href');

                    if (href) {
                        window.location.href = href;
                    }
                });
            }
        });
    </script>
</body>

</html>