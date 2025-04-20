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
    //show($data);
    ?>

    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <section class="dashboard">
            <section class="search-section">
                <div class="search-container">
                    <h2>Search Mod Logs
                        <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />
                    </h2>
                    <form id="log-search-form" method="GET" action="/Free-Write/public/Mod/modLogs">
                        <div class="search-fields">
                            <div class="search-field">
                                <label for="search-id">Log ID:</label>
                                <input type="text" id="logid" name="logid" placeholder="Search by ID">
                            </div>

                            <div class="search-field">
                                <label for="search-user">Moderator:</label>
                                <input type="text" id="userID" name="userID" placeholder="Search by username">
                            </div>

                            <div class="search-field">
                                <label for="search-activity">Activity:</label>
                                <input type="text" id="logactivity" name="logactivity" placeholder="Search by activity">
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
                                <th>Mod Log ID</th>
                                <th>Moderator</th>
                                <th>Activity</th>
                                <th>Occurrence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $log): ?>
                                <tr>
                                    <td><?= htmlspecialchars($log['modlogID']); ?></td>
                                    <td><?= htmlspecialchars($log['mod']); ?></td>
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