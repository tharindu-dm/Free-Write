<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moderator Panel - User Management</title>
    <link rel="stylesheet" href="/Free-Write/public/css/modUserManagement.css">
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
                <h2>User Management</h2>
                <div class="header-info">
                    <div>Date: <span id="currentDate"></span></div>
                    <div>Time: <span id="currentTime"></span></div>
                    <div>Moderator: John Doe</div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>User Type</th>
                        <th>Premium</th>
                        <th>Activated</th>
                        <th>Login Attempts</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="fillForm(1, 'user1@example.com', '********', 'Regular', 'No', 'Yes', 3)">
                        <td>1</td>
                        <td>user1@example.com</td>
                        <td>********</td>
                        <td>Regular</td>
                        <td>No</td>
                        <td>Yes</td>
                        <td>3</td>
                    </tr>
                    <tr onclick="fillForm(2, 'user2@example.com', '********', 'Admin', 'Yes', 'Yes', 1)">
                        <td>2</td>
                        <td>user2@example.com</td>
                        <td>********</td>
                        <td>Admin</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td>1</td>
                    </tr>
                    <!-- More rows can be added here -->
                </tbody>
            </table>

            <div class="pagination">
                <button>1</button>
                <button class="active">2</button>
                <button>3</button>
                <button>4</button>
                <button>5</button>
            </div>

            <!-- User details form -->
            <div class="user-details-form">
                <h3>User Details</h3>
                <form id="userDetailsForm">
                    <label for="userId">UserID</label>
                    <input type="text" id="userId" name="userId" disabled>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" disabled>

                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" disabled>

                    <label for="userType">User Type</label>
                    <input type="text" id="userType" name="userType" disabled>

                    <label for="premium">Premium</label>
                    <input type="text" id="premium" name="premium" disabled>

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