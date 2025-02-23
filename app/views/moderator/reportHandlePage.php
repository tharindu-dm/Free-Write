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
        case 'admin':
        case 'mod':
            require_once "../app/views/layout/header-user.php";
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
                <div>Moderator: <?= htmlspecialchars($_SESSION['user_name']) ?></div>
            </div>

            <!--<div class="search-bar">
                <input type="text" placeholder="Search reports...">
            </div>-->

            <div class="tabs">
                <a href="/Free-Write/public/Mod/Reports"><button class="tab">All Reports</button></a>
                <a href="/Free-Write/public/Mod/Reports?filter=unhandled"><button class="tab">Unhandled</button></a>
                <a href="/Free-Write/public/Mod/Reports?filter=handled"><button class="tab">Handled</button></a>
                <a href="/Free-Write/public/Mod/Reports?filter=escalated"><button class="tab">Escalated</button></a>
            </div>

            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>User email</th>
                            <th>Report Type</th>
                            <th>Description</th>
                            <th>Submit Stamp</th>
                            <th>Status</th>
                            <th>Last Handler</th>
                            <th>Mod Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['reports'] as $report): ?>
                            <tr onclick="showReportDetails(this)">
                                <td><?= $report['reportID'] ?></td>
                                <td><?= $report['email'] ?></td>
                                <td><?= $report['type'] ?></td>
                                <td><?= $report['description'] ?></td>
                                <td><?= $report['submitTime'] ?></td>
                                <td><?= $report['status'] ?></td>
                                <td><?= $report['handler'] ?? 'None' ?></td>
                                <td>
                                    <?php
                                    $modResponse = $report['modResponse'] ?? '';
                                    // Display truncated version in the table
                                    echo ($modResponse) ? 'Available' : 'None';
                                    ?>
                                    <span style="display:none;"><?= htmlspecialchars($modResponse) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
            <form action="/Free-Write/public/Mod/HandleReport" method="post">
                <div class="detail-sections">
                    <div class="report-details">
                        <h3>Report Details</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="reportID">Report ID</label>
                                <input type="text" id="reportID" name="reportID" readonly>
                            </div>
                            <div class="form-group">
                                <label for="reportstatus">Report status</label>
                                <input type="text" id="reportstatus" name="reportstatus" readonly>
                            </div>
                            <div class="form-group">
                                <label for="reportType">Report Type</label>
                                <input type="text" id="reportType" name="reportType" readonly>
                            </div>
                            <div class="form-group">
                                <label for="reportHandler">Report Last Handler</label>
                                <input type="text" id="reportHandler" name="reportHandler" readonly>
                            </div>
                            <div class="form-group">
                                <label for="userEmail">User</label>
                                <input type="text" id="userEmail" name="userEmail" readonly>
                            </div>
                            <div class="form-group">
                                <label for="submitDate">Submit Date</label>
                                <input type="text" id="submitDate" name="submitDate" readonly>
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label for="reportDescription">Description</label>
                                <textarea id="reportDescription" name="reportDescription" maxlength="600"
                                    readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mod-response">

                    <h3>Moderator Response</h3>
                    <div class="form-group">
                        <label for="modResponse">Mod Response</label>
                        <textarea id="modResponse" name="modResponse" placeholder="Enter your mode notes..."
                            required></textarea>
                    </div>
                    <div class="action-buttons">
                        <div>
                            <input type="radio" value="Escalated" name="newstatus" required>&nbsp;Escalate</input>
                            <input type="radio" value="Unfinished" name="newstatus" required>&nbsp;Unfinished</input>
                            <input type="radio" value="Handled" name="newstatus" required>&nbsp;Finished</input>
                        </div>
                        <button type="submit">Mark as Handled</button>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\Moderator\reportHandlePage.js"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const path = window.location.pathname;
            const query = window.location.search;

            if (path === '/Free-Write/public/Mod/Reports' && query === '') {
                document.querySelector('.tabs a:nth-child(1) button').classList.add('active');
            } else if (path === '/Free-Write/public/Mod/Reports' && query === '?filter=unhandled') {
                document.querySelector('.tabs a:nth-child(2) button').classList.add('active');
            } else if (path === '/Free-Write/public/Mod/Reports' && query === '?filter=handled') {
                document.querySelector('.tabs a:nth-child(3) button').classList.add('active');
            } else if (path === '/Free-Write/public/Mod/Reports' && query === '?filter=escalated') {
                document.querySelector('.tabs a:nth-child(4) button').classList.add('active');
            }
        });
    </script>


</body>

</html>