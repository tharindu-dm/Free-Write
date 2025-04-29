<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moderator Panel - Courier Management</title>
    <link rel="stylesheet" href="/Free-Write/public/css/modUserManagement.css">
    <link rel="stylesheet" href="/Free-Write/public/css/admin.css">

</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";

    ?>

    <main>
        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>
        <div class="container">
            <div class="mod-user-header">
                <h2>Courier Management</h2>
                <div class="mod-user-header-info">
                    <div><span id="currentDate"><?= htmlspecialchars(date('D M j, Y')) ?></span></div>
                    <div><span id="currentTime"><?= htmlspecialchars(date('H:i:s')) ?></span>&nbsp;UTC</div>
                    <div>Moderator: <?= htmlspecialchars($_SESSION['user_name']) ?></div>
                </div>
            </div>

            <div class="search-bar">
                <form action="/Free-Write/public/Mod/CouSearch" method="post" id="searchForm">
                    <select id="searchCriteria" name="searchCriteria" required>
                        <option value="" readonly selected>Select Criteria</option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                    <input type="text" name="searchInput" placeholder="Search..." required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <div class="tabs">
                <a href="/Free-Write/public/Mod/AddCourier"><button class="tab">All Couriers</button></a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Premium</th>
                        <th>Activated</th>
                        <th>Login Attempts</th>
                        <th>Select User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?= $user['userID'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['userType'] ?></td>
                            <td><?= $user['isPremium'] ?></td>
                            <td><?= $user['isActivated'] ?></td>
                            <td><?= $user['loginAttempt'] ?></td>
                            <td>
                                <a href="/Free-Write/public/Mod/CouSearch?filter=<?= htmlspecialchars($user['userID']) ?>">
                                    <button class="table-select-user-btn">Select User</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="user-details-form">
                <h3>Courier Details</h3>
                <form id="userDetailsForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userId">User ID</label>
                            <input type="text" id="userId" name="userId" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['user']) . '"';
                            }
                            ?> readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" maxlength="100" id="email" name="email" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($users[0]['email']) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group">
                            <label for="loginAttempts">Login Attempts</label>
                            <input type="number" max="4" min="0" id="loginAttempts" name="loginAttempts" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($users[0]['loginAttempt']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <select id="userType" name="userType" required>
                                <option value="" <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Type</option>
                                <option value="courier" <?php echo (isset($userDetails) && $users[0]['userType'] == 'courier') ? 'selected' : ''; ?>>Courier</option>
                                <option value="reader" <?php echo (isset($userDetails) && $users[0]['userType'] == 'reader') ? 'selected' : ''; ?>>Reader</option>
                                <option value="writer" <?php echo (isset($userDetails) && $users[0]['userType'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
                                <option value="covdes" <?php echo (isset($userDetails) && $users[0]['userType'] == 'covdes') ? 'selected' : ''; ?>>Cover Page Designer</option>
                                <option value="wricov" <?php echo (isset($userDetails) && $users[0]['userType'] == 'wricov') ? 'selected' : ''; ?>>Writer and Cover Page
                                    Designer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="premium">Premium</label>
                            <select id="premium" name="premium" <?php echo isset($userDetails) ? '' : 'readonly'; ?>>
                                <option value="" <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Premium Status</option>
                                <option value="1" <?php echo (isset($userDetails) && $users[0]['isPremium'] === '1') ? 'selected' : ''; ?>>True</option>
                                <option value="0" <?php echo (isset($userDetails) && $users[0]['isPremium'] === '0') ? 'selected' : ''; ?>>False</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activated">Activated</label>
                            <select id="activated" name="activated" <?php echo isset($userDetails) ? '' : 'readonly'; ?>>
                                <option value="" <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Activation Status</option>
                                <option value="1" <?php echo (isset($userDetails) && $users[0]['isActivated'] === '1') ? 'selected' : ''; ?>>True</option>
                                <option value="0" <?php echo (isset($userDetails) && $users[0]['isActivated'] === '0') ? 'selected' : ''; ?>>False</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" maxlength="45" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['firstName']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" maxlength="45" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['lastName']) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" maxlength="45" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['country']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" <?php
                            if (isset($userDetails) && !empty($userDetails[0]['dob'])) {

                                $dob = date('Y-m-d', strtotime($userDetails[0]['dob']));
                                echo 'value="' . htmlspecialchars($dob) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="lastLogin">Last Login Date</label>
                            <input type="text" disabled id="lastLogin" name="lastLogin" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['lastLogDate']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="regDate">Registration Date</label>
                            <input type="text" disabled id="regDate" name="regDate" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['regDate']) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" maxlength="255">
                            <?php
                            if (isset($userDetails)) {
                                echo $userDetails[0]['bio'];
                            }
                            ?>
                            </textarea>
                        </div>
                    </div>
                    <?php
                    if (isset($userDetails)): ?>
                        <div class="special-btns">
                            <button id="mod-delete-user">Delete User</button>
                            <button id="mod-update-user">Update User</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

    </main>

    <div id="updatePreviewModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Update User Details</h3>
                <button type="button" class="close-modal" onclick="closeUpdateModal()">&times;</button>
            </div>
            <div class="update-notice">
                <p><strong>You are updating details for user:</strong> <span id="update-user-name"></span></p>
                <p>Please review the changes carefully before confirming.</p>
            </div>
            <form id="updateModalForm" method="POST" action="/Free-Write/public/Mod/UpdateUser">
                <div class="preview-form">
                </div>
                <div class="modal-buttons">
                    <button type="button" class="cancel-button" onclick="closeUpdateModal()">Cancel</button>
                    <button type="submit" class="confirm-button">Confirm Update</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteConfirmModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Delete User Account</h3>
                <button type="button" class="close-modal" onclick="closeDeleteModal()">&times;</button>
            </div>
            <form id="deleteModalForm" method="POST" action="/Free-Write/public/Mod/DeleteUser">
                <div class="delete-info">
                    <p><strong>User ID:</strong> <span id="delete-uid"></span></p>
                    <p><strong>Email:</strong> <span id="delete-email"></span></p>
                    <p><strong>Name:</strong> <span id="delete-name"></span></p>
                    <p><strong>User Type:</strong> <span id="delete-usertype"></span></p>
                    <p><strong>Premium Status:</strong> <span id="delete-premium"></span></p>
                </div>

                <div class="warning-text">
                    ⚠️ WARNING: This action is irreversible!
                    <ul>
                        <li>All user content will be permanently removed from the database</li>
                        <li>This includes all posts, comments, and uploaded content</li>
                        <li>User's account access will be immediately terminated</li>
                        <li>This action cannot be undone</li>
                    </ul>
                </div>

                <div class="delete-confirmation">
                    <label>
                        <strong>To confirm deletion, type "DELETE THIS USER" (all caps):</strong>
                        <input type="text" id="deleteConfirmText" name="deleteConfirmText"
                            oninput="validateDeleteConfirmation()" placeholder="Type DELETE THIS USER">
                    </label>
                </div>

                <input type="hidden" name="userId" id="deleteUserId">

                <div class="modal-buttons">
                    <button type="button" class="cancel-button" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="confirm-button delete-btn" id="deleteSubmitBtn" disabled>Delete
                        User</button>
                </div>
            </form>
        </div>
    </div>


    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/Moderator/modUserManagement.js"></script>
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