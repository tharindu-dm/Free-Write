<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - FreeWrite Platform</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteManageUser.css">
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
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        case 'inst':
            require_once "../app/views/layout/header-inst.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>

    <div class="inst-container">
        <!-- Sidebar Navigation -->
        <nav class="inst-sidebar">
            <div class="inst-nav-item active">
                <i class="inst-icon-dashboard"></i>
                <span>Dashboard</span>
            </div>
            <div class="inst-nav-item">
                <i class="inst-icon-institution"></i>
                <span>Library</span>
            </div>
            <div class="inst-nav-item">
                <i class="inst-icon-users"></i>
                <span>Purchase Package</span>
            </div>
            <div class="inst-nav-item">
                <i class="inst-icon-settings"></i>
                <span>Manage Users</span>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="inst-main-content">
            <h1>Manage Users</h1>

            <!-- Search Bar -->
            <div class="inst-search-container">
                <input type="text" id="searchInput" placeholder="Search by username, email or name">
                <i class="inst-icon-search"></i>
            </div>

            <!-- User Type Tabs -->
            <div class="inst-tabs">
                <button class="inst-tab-btn active" data-type="all">All Users</button>
                <button class="inst-tab-btn" data-type="writers">Writers</button>
                <button class="inst-tab-btn" data-type="readers">Readers</button>
            </div>

            <!-- Users Table -->
            <div class="inst-table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Join Date</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if (!empty($instUsers) && is_array($instUsers)): ?>
                            <?php foreach ($instUsers as $user): ?>
                                <tr>
                                    <td><?php echo $user['userID'] ?> </td>
                                    <td><?php echo $user['username'] ?> </td>
                                    <td><button class="listEdit-btn">Edit</button></td>
                                    <td><button class="listDelete-btn">Delete</button></td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <td><p>No users under the institute name.</p></td>
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
            <div id="popupForm" class="inst-popup-overlay">
                <div class="inst-popup-content">
                    <span id="closePopupBtn" class="inst-close-btn">&times;</span>
                    <h2>Add New User</h2>
                    <form id="addInstitutionForm" method="POST">
                        <label for="institutionName">Institution Name:</label>
                        <input disabled type="text" name="institutionName" id="institutionName" value="<?= htmlspecialchars($instName)?>" required>


                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>

                        <!-- <label for="Creater">Created By (email):</label>
                        <input type="email" name="Creater" id="Creater" required> 
                        <input type="email" id="Creater" name="Creater" disabled
                            value="<?= htmlspecialchars($user['email']) ?>" />-->

                        <button type="submit" class="inst-submit-btn">Add Institution</button>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="inst-modal">
        <div class="inst-modal-content">
            <span class="inst-close">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="userId">
                <div class="inst-form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" required>
                </div>
                <div class="inst-form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" required>
                </div>
                <div class="inst-form-group">
                    <label for="role">Role</label>
                    <select id="role" required>
                        <option value="writer">Writer</option>
                        <option value="reader">Reader</option>
                    </select>
                </div>
                <button type="submit" class="inst-save-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script> //src="../public/js/Institute/Institute ManageUser.js">
        // JavaScript for Popup Window
        document.addEventListener("DOMContentLoaded", () => {
            const openPopupBtn = document.getElementById("openPopupBtn");
            const popupForm = document.getElementById("popupForm");
            const closePopupBtn = document.getElementById("closePopupBtn");

            openPopupBtn.addEventListener("click", () => {
                popupForm.style.display = "flex";
            });

            closePopupBtn.addEventListener("click", () => {
                popupForm.style.display = "none";
            });

            popupForm.addEventListener("click", (event) => {
                if (event.target === popupForm) {
                    popupForm.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>