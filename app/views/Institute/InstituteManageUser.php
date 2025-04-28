<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - FreeWrite Platform</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteManageUser.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <div class="inst-container">
        <!-- Sidebar Navigation -->
        <?php include_once "../app/views/Institute/sidebar.php"; ?>

        <!-- Main Content -->
        <main class="inst-main-content">
            <h1>Manage Users</h1>
            
            <!-- Users Table -->
            <div class="inst-table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Last Login</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if (!empty($instUsers) && is_array($instUsers)): ?>
                            <?php foreach ($instUsers as $user): ?>
                                <tr data-user-id="<?= htmlspecialchars($user['userID']); ?>"
                                    data-user-firstname="<?= htmlspecialchars($user['firstName']); ?>"
                                    data-user-lastname="<?= htmlspecialchars($user['lastName']); ?>"
                                    data-user-email="<?= htmlspecialchars($user['email']); ?>">
                                    <td><?= htmlspecialchars($user['userID']); ?> </td>
                                    <td><?= htmlspecialchars($user['fullName']); ?> </td>
                                    <td><?= htmlspecialchars($user['email']); ?> </td>
                                    <td><?= htmlspecialchars($user['lastLogDate']); ?> </td>
                                    <td><button id="btn_EditUser" class="listEdit-btn">Edit</button></td>
                                    <td><button id="btn_DelteUser" class="listDelete-btn">Delete</button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <p>No users under the institute name.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="inst-pagination">
                <button class="inst-prev-btn">&lt;</button>
                <div class="inst-page-numbers">
                    <span class="inst-page-number active">1</span>
                    <span class="inst-page-number">2</span>
                    <span class="inst-page-number">3</span>
                    <span class="inst-page-number">4</span>
                    <span class="inst-page-number">5</span>
                </div>
                <button class="inst-next-btn">&gt;</button>
            </div>

            <!-- New User Button
            <button class="inst-new-user-btn">New User</button> -->

            <!-- Button to Open Popup -->
            <button id="openPopupBtn" class="inst-open-popup-btn">Add New User</button>

            <!-- Popup Window -->
            <?php if (isset($_SESSION['add_user_error'])): ?>
                <div id="addUserError" class="inst-error-message">
                    <?= htmlspecialchars($_SESSION['add_user_error']) ?>
                </div>
                <?php unset($_SESSION['add_user_error']); ?>
            <?php endif; ?>

            <div id="popupForm" class="inst-popup-overlay">
                <div class="inst-popup-content">
                    <span id="closePopupBtn" class="inst-close-btn">&times;</span>
                    <h2>Add New User</h2>

                    <form id="addInstitutionForm" action="/Free-Write/public/Institute/addNewUser" method="POST">
                        <label for="firstName">First Name:</label>
                        <input type="text" name="firstName" id="firstName" required>

                        <label for="lastName">Last Name:</label>
                        <input type="text" name="lastName" id="lastName" required>

                        <input type="hidden" name="instName" value="<?= htmlspecialchars($instDetails['name']) ?>">

                        <label for="institutionName">Institute User Email Domain</label>
                        <input disabled type="text"
                            value="@usr.<?= htmlspecialchars(explode('@', $instDetails['username'])[0]) ?>.fw">
                        <input type="hidden" name="instUserDomain" id="instUserDomain"
                            value="@usr.<?= htmlspecialchars(explode('@', $instDetails['username'])[0]) ?>.fw" required>

                        <label for="username">Username:</label>
                        <h6>Do not include the email domain</h6>
                        <input type="text" name="username" id="username" required>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>

                        <button type="submit" class="inst-submit-btn">Add Institution</button>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <!-- Edit User -->
    <div class="update-to-list">
        <div class="list-container">
            <h3>Edit User</h3>
            <h4 id="user-header">User:</h4>
            <input type="input" disabled id="user_update">

            <form id="editUserForm" action="/Free-Write/public/Institute/updateUser" method="POST">
                <input type="hidden" name="userID" id="user_update_post">
                <div class="form-content">
                    <label for="user_firstName">First Name:</label>
                    <input type="text" name="user_firstName" id="user_firstName" required>

                    <label for="user_lastName">Last Name:</label>
                    <input type="text" name="user_lastName" id="user_lastName" required>

                    <label for="user_username">Username:</label>
                    <input type="text" name="user_username" id="user_username" required>
                </div>
                <div class="list-add-actionBtns">
                    <button id="cancel-button" type="button" class="add-list-cancel-button">
                        Cancel
                    </button>
                    <button id="subBtn" type="submit" class="add-list-submit-button">Update Record</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete User -->
    <div class="delete-from-list">
        <div class="list-container">
            <h3 style="color:crimson;">You are about to delete a user!</h3>
            <h4 id="user-header-delete">User:</h4>

            <form id="deleteUserForm" action="/Free-Write/public/Institute/deleteUser" method="POST">

                <input type="input" disabled id="user_delete">
                <input type="hidden" name="userID" id="user_delete_post">

                <div class="list-add-actionBtns">
                    <button id="cancel-delete-button" type="button" class="add-list-cancel-button">
                        Cancel
                    </button>
                    <button id="subBtn" type="submit" class="delete-list-submit-button">Delete Record</button>
                </div>
            </form>
        </div>
    </div>
    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="\Free-Write\public\js\Institute\InstituteManageUser.js"></script>
</body>

</html>