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
                <div class="stat-card">
                    <h3>Total User Count</h3>
                    <p><?= htmlspecialchars($data[0]['totalUsers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Readers</h3>
                    <p><?= htmlspecialchars($data[0]['readers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Writers</h3>
                    <p><?= htmlspecialchars($data[0]['writers'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Cover Designers</h3>
                    <p><?= htmlspecialchars($data[0]['covdes'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Publishers</h3>
                    <p><?= htmlspecialchars($data[0]['pubs'] ?? '0'); ?></p>
                </div>
            </div>

            <div class="stats-grid secondary">
                <div class="stat-card">
                    <h3>Institutions</h3>
                    <p><?= htmlspecialchars($data[0]['inst'] ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Premium Users</h3>
                    <p><?= htmlspecialchars(($data[0]['premium']) ?? '0'); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Moderators</h3>
                    <p><?= htmlspecialchars($data[0]['mod'] ?? '0'); ?></p>
                </div>
            </div>

            <form class="publish-form" action="/Free-Write/public/Mod/sendAnnouncement" method="POST">
                <div class="form-content">
                    <div class="text-inputs">
                        <input type="text" placeholder="Subject" class="subject-input" name="subject">
                        <textarea placeholder="Descriptions" class="description-input" name="description"></textarea>
                    </div>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="roles[]" value="reader" class="all-users-checkbox">&nbsp;
                            All users</label>
                        <label><input type="checkbox" name="roles[]" value="writer">&nbsp; Writers</label>
                        <label><input type="checkbox" name="roles[]" value="covdes">&nbsp; Cover
                            Designers</label>
                        <label><input type="checkbox" name="roles[]" value="inst">&nbsp; Institutes</label>
                        <label><input type="checkbox" name="roles[]" value="pub">&nbsp; Publishers</label>                        
                        <label><input type="checkbox" name="roles[]" value="courier">&nbsp; Courier</label>
                        <?php if ($_SESSION['user_type'] == 'admin'): ?>
                            <label><input type="checkbox" name="roles[]" value="moderators">&nbsp; Moderators</label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="button-group">
                    <button type="reset" class="clear-btn">Clear</button>
                    <button type="submit" class="publish-btn">Announce</button>
                </div>
            </form>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/Admin/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.publish-form');
            const allUsersCheckbox = form.querySelector('.all-users-checkbox');
            const otherCheckboxes = Array.from(form.querySelectorAll('.checkbox-group input[type="checkbox"]:not(.all-users-checkbox)'));

            // Handle "All Users" checkbox
            allUsersCheckbox.addEventListener('change', function () {
                otherCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            // Handle other checkboxes
            otherCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    // If any checkbox is unchecked, uncheck "All Users"
                    if (!this.checked) {
                        allUsersCheckbox.checked = false;
                    }
                    // If all other checkboxes are checked, check "All Users"
                    else if (otherCheckboxes.every(cb => cb.checked)) {
                        allUsersCheckbox.checked = true;
                    }
                });
            });

            // Handle form reset properly
            form.addEventListener('reset', function () {
                setTimeout(() => {
                    allUsersCheckbox.checked = false;
                    otherCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                }, 10);
            });
        });
    </script>
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