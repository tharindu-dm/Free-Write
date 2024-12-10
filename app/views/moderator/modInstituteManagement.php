<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moderator Panel - Institutes</title>
    <link rel="stylesheet" href="/Free-Write/public/css/modUserManagement.css">
    <link rel="stylesheet" href="/Free-Write/public/css/admin.css">

</head>

<body>

    <?php
    date_default_timezone_set('UTC'); // Set timezone to UTC
    
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'mod':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }

    show($data);
    ?>
    <main>

        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>
        <div class="container">
            <div class="mod-user-header">
                <h2>Institute Management</h2>
                <div class="mod-user-header-info">
                    <div><span id="currentDate"><?= htmlspecialchars(date('D M j, Y')) ?></span></div>
                    <div><span id="currentTime"><?= htmlspecialchars(date('H:i:s')) ?></span>&nbsp;UTC</div>
                    <div>Moderator: <?= htmlspecialchars($_SESSION['user_name']) ?></div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <form action="/Free-Write/public/Mod/Search" method="post" id="searchForm">
                    <select id="searchCriteria" required>
                        <option value="" disabled selected>Select Criteria</option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                    <input type="text" id="searchInput" placeholder="Search..." required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Institute ID</th>
                        <th>Email</th>
                        <th>Institute  Type</th>
                        <th>Premium</th>
                        <th>Activated</th>
                        <th>Login Attempts</th>
                        <th>Select Institute </th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="fillForm(1, 'user1@example.com', '********', 'Regular', 'No', 'Yes', 3)">
                        <td>1</td>
                        <td>user1@example.com</td>
                        <td>Regular</td>
                        <td>No</td>
                        <td>Yes</td>
                        <td>3</td>
                        <td><button class="table-select-user-btn">Select</button></td>
                    </tr>
                </tbody>
            </table>

            <div class="special-btns">
                <a href="/Free-Write/public/Mod/DeactivateUser ?usr_id="><button>Deactivate Institute</button></a>
                <button id="edit_user_details">Edit Details</button>
                <button>Delete</button>
            </div>

            <!-- User details form -->
            <div class="user-details-form">
                <h3>Institute Details</h3>
                <form id="userDetailsForm">
                    <label for="userId">Institute ID</label>
                    <input type="text" id="userId" name="userId" disabled>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" disabled>

                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" disabled>

                    <label for="activated">Activated</label>
                    <input type="text" id="activated" name="activated" disabled>

                    <label for="loginAttempts">Login Attempts</label>
                    <input type="text" id="loginAttempts" name="loginAttempts" disabled>

                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName">

                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName">

                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob">

                    <label for="regDate">Registration Date</label>
                    <input type="date" id="regDate" name="regDate">

                    <label for="country">Country</label>
                    <input type="text" id="country" name="country">

                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio"></textarea>

                    <label for="lastLogin">Last Login Date</label>
                    <input type="date" id="lastLogin" name="lastLogin">
                </form>
            </div>
        </div>

    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\modUserManagement.js">    </script>
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