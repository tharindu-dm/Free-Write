<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Platform Feedbacks</title>
    <link rel="stylesheet" href="/Free-Write/public/css/reportHandlePage.css">
    <link rel="stylesheet" href="/Free-Write/public/css/admin.css">

</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>

        <div class="container">
            <div class="header">
                <h2>Feedbacks</h2>
                <div>Moderator: <?= htmlspecialchars($_SESSION['user_name']) ?></div>
            </div>

            <div class="tabs">
                <a href="/Free-Write/public/Mod/Feedbacks"><button class="tab">All Feedbacks</button></a>
                <a href="/Free-Write/public/Mod/Feedbacks?filter=unread"><button class="tab">Unread</button></a>
                <a href="/Free-Write/public/Mod/Feedbacks?filter=read"><button class="tab">Read</button></a>
            </div>

            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Feedback ID</th>
                            <th>User email</th>
                            <th>Description</th>
                            <th>Read Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['feedbacks'] as $feedback): ?>
                            <tr onclick="showFeedbackDetails(this)">
                                <td><?= $feedback['feedbackID'] ?></td>
                                <td><?= $feedback['email'] ?></td>
                                <td><?= $feedback['content'] ?></td>
                                <td>
                                    <?php
                                    $modResponse = $feedback['isRead'] ?? '';
                                    // Display truncated version in the table
                                    echo ($modResponse) ? 'Read' : 'Unread';
                                    ?>
                                    <span style="display:none;"><?= htmlspecialchars($modResponse) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <form action="/Free-Write/public/Mod/HandleFeedback" method="post">
                <div class="detail-sections">
                    <div class="report-details">
                        <h3>Feedback Details</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="FeedbackID">Feedback ID</label>
                                <input type="text" id="FeedbackID" name="FeedbackID" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Feedbackstatus">Feedback status</label>
                                <select id="Feedbackstatus" name="Feedbackstatus" required>
                                    <option value="unread">unread</option>
                                    <option value="read">read</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userEmail">User</label>
                                <input type="text" id="userEmail" name="userEmail" readonly>
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label for="FeedbackDescription">Description</label>
                                <textarea id="FeedbackDescription" name="reportDescription" maxlength="600" rows="5"
                                    readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mod-response">
                    <h3>Action</h3>
                    <div class="action-buttons">
                        <input type="hidden" name="fid" value="<?= $feedback['feedbackID'] ?>">
                        <input type="hidden" name="action" value="read">
                        <button type="submit">Mark as Read</button>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\Moderator\FeedbackPage.js"></script>
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

            if (path === '/Free-Write/public/Mod/Feedbacks' && query === '') {
                document.querySelector('.tabs a:nth-child(1) button').classList.add('active');
            } else if (path === '/Free-Write/public/Mod/Feedbacks' && query === '?filter=unread') {
                document.querySelector('.tabs a:nth-child(2) button').classList.add('active');
            } else if (path === '/Free-Write/public/Mod/Feedbacks' && query === '?filter=read') {
                document.querySelector('.tabs a:nth-child(3) button').classList.add('active');
            }
        });
    </script>


</body>

</html>