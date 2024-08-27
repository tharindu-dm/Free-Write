<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>
    <link rel="stylesheet" href="public\css\admin.css">
</head>

<body>
    <?php
    require '../app/views/layout/header-admin.php';
    ?>
    <main>
        <aside>
            <nav>
                <ul>
                    <li class="active"><img src="dashboard-icon.png" alt="Dashboard"> Dashboard</li>
                    <li><img src="site-logs-icon.png" alt="Site Logs"> Site Logs</li>
                    <li><img src="mod-logs-icon.png" alt="Mod Logs"> Mod Logs</li>
                    <li><img src="view-table-icon.png" alt="View Table"> View Table</li>
                </ul>
            </nav>
        </aside>

        <section class="dashboard">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total User Count</h3>
                    <p>4098</p>
                </div>
                <div class="stat-card">
                    <h3>Readers</h3>
                    <p>4090</p>
                </div>
                <div class="stat-card">
                    <h3>Writers</h3>
                    <p>1054</p>
                </div>
                <div class="stat-card">
                    <h3>Cover Designers</h3>
                    <p>546</p>
                </div>
                <div class="stat-card">
                    <h3>Publishers</h3>
                    <p>007</p>
                </div>
            </div>

            <div class="stats-grid secondary">
                <div class="stat-card">
                    <h3>Institutions</h3>
                    <p>001</p>
                </div>
                <div class="stat-card">
                    <h3>Premium Users</h3>
                    <p>241</p>
                </div>
                <div class="stat-card">
                    <h3>Moderators</h3>
                    <p>012</p>
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

    <script src="/Free-Write/public/js/admin.js"></script>
</body>

</html>