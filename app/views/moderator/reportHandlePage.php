<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moderator Report Management</title>
    <link rel="stylesheet" href="/Free-Write/public/css/reportHandlePage.css">
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
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }

    //show($data);
    ?>
    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <div class="container">
            <div class="header">
                <h2>Report Management</h2>
                <div>Moderator: John Doe</div>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Search reports...">
            </div>

            <div class="tabs">
                <div class="tab active" onclick="switchTab('all')">All Reports</div>
                <div class="tab" onclick="switchTab('unhandled')">Unhandled</div>
                <div class="tab" onclick="switchTab('handled')">Handled</div>
            </div>

            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>User</th>
                            <th>Report Type</th>
                            <th>Description</th>
                            <th>Submit Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="showReportDetails(this)">
                            <td>RPT001</td>
                            <td>user@example.com</td>
                            <td>Harassment</td>
                            <td>Inappropriate content...</td>
                            <td>2023-06-15 14:30</td>
                            <td>Unhandled</td>
                        </tr>
                        <tr onclick="showReportDetails(this)">
                            <td>RPT002</td>
                            <td>another@user.com</td>
                            <td>Spam</td>
                            <td>Multiple spam messages...</td>
                            <td>2023-06-14 10:15</td>
                            <td>Handled</td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <button>1</button>
                    <button class="active">2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>5</button>
                </div>
            </div>

            <div class="detail-sections">
                <div class="report-details">
                    <h3>Report Details</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Report ID</label>
                            <input type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <input type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label>Report Type</label>
                            <input type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label>Submit Date</label>
                            <input type="text" readonly>
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label>Description</label>
                            <textarea readonly></textarea>
                        </div>
                    </div>
                </div>

                <div class="mod-response">
                    <h3>Moderator Response</h3>
                    <div class="form-group">
                        <label>Mod Response</label>
                        <textarea placeholder="Enter your moderation notes..."></textarea>
                    </div>
                    <div class="action-buttons">
                        <button>Mark as Handled</button>
                        <button>Escalate</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="\Free-Write\public\js\reportHandlePage.js">
    </script>
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