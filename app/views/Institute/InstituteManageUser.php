<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - FreeWrite Platform</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteManageUser.css">
</head>
<body>
    <nav class="top-nav">
        <div class="nav-left">
            <a href="/" class="logo"><img src="/CRUD_OOP/public/assets/images/logo.png" alt="Freewrite" class="logo-icon">
                Freewrite</a>
                <a href="/browse">Browse</a>
                <a href="/contests">Contests</a>
                <a href="/publishers">For Publishers</a>
                <a href="/advertisers">For Advertisers</a>
        </div>
        <div class="nav-right">
            <div class="search-container">
                <input type="search" placeholder="Search" class="search-input">
                <button class="search-button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
            <div class="profile-image">
                <img src="/CRUD_OOP/public/assets/images/profile-placeholder.jpg" alt="Profile">
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="nav-item active">
                <i class="icon-dashboard"></i>
                <span>Dashboard</span>
            </div>
            <div class="nav-item">
                <i class="icon-institution"></i>
                <span>Library</span>
            </div>
            <div class="nav-item">
                <i class="icon-users"></i>
                <span>Purchase Package</span>
            </div>
            <div class="nav-item">
                <i class="icon-settings"></i>
                <span>Manage Users</span>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <h1>Manage Users</h1>
            
            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by username, email or name">
                <i class="icon-search"></i>
            </div>

            <!-- User Type Tabs -->
            <div class="tabs">
                <button class="tab-btn active" data-type="all">All Users</button>
                <button class="tab-btn" data-type="writers">Writers</button>
                <button class="tab-btn" data-type="readers">Readers</button>
            </div>

            <!-- Users Table -->
            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Join Date</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Table content will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="prev-btn">&lt;</button>
                <div class="page-numbers">
                    <span class="page-number active">1</span>
                    <span class="page-number">2</span>
                    <span class="page-number">3</span>
                    <span class="page-number">4</span>
                    <span class="page-number">5</span>
                </div>
                <button class="next-btn">&gt;</button>
            </div>

            <!-- New User Button
            <button class="new-user-btn">New User</button> -->

            <!-- Button to Open Popup -->
            <button id="openPopupBtn" class="open-popup-btn">Add New User</button>

            <!-- Popup Window -->
            <div id="popupForm" class="popup-overlay">
                <div class="popup-content">
                    <span id="closePopupBtn" class="close-btn">&times;</span>
                    <h2>Add New User</h2>
                    <form id="addInstitutionForm" method="POST">
                        <label for="institutionName">Institution Name:</label>
                        <input type="text" name="institutionName" id="institutionName" required>
                        

                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>

                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required>

                        <label for="subStartDate">Subscription Start Date:</label>
                        <input type="date" name="subStartDate" id="subStartDate" required>

                        <label for="subEndDate">Subscription End Date:</label>
                        <input type="date" name="subEndDate" id="subEndDate" required>

                        <label for="subPlan">Subscription Plan (ID):</label>
                        <input type="number" name="subPlan" id="subPlan" required>

                        <label for="Creater">Created By (email):</label>
                        <!-- <input type="email" name="Creater" id="Creater" required> -->
                        <input type="email" id="Creater" name="Creater" disabled value="<?= htmlspecialchars($user['email']) ?>" />

                        <button type="submit" class="submit-btn">Add Institution</button>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm">
                <input type="hidden" id="userId">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" required>
                </div>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" required>
                        <option value="writer">Writer</option>
                        <option value="reader">Reader</option>
                    </select>
                </div>
                <button type="submit" class="save-btn">Save Changes</button>
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