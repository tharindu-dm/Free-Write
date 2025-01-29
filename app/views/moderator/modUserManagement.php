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

    //show($data);
    ?>
    <main>

        <?php require_once "../app/views/layout/admin_aside_nav.php"; ?>
        <div class="container">
            <div class="mod-user-header">
                <h2>User Management</h2>
                <div class="mod-user-header-info">
                    <div><span id="currentDate"><?= htmlspecialchars(date('D M j, Y')) ?></span></div>
                    <div><span id="currentTime"><?= htmlspecialchars(date('H:i:s')) ?></span>&nbsp;UTC</div>
                    <div>Moderator: <?= htmlspecialchars($_SESSION['user_name']) ?></div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <form action="/Free-Write/public/Mod/Search" method="post" id="searchForm">
                    <select id="searchCriteria" name="searchCriteria" required>
                        <option value="" disabled selected>Select Criteria</option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                    </select>
                    <input type="text" name="searchInput" placeholder="Search..." required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <div class="tabs">
                <a href="/Free-Write/public/Mod/Users"><button class="tab">All Users</button></a>
                <a href="/Free-Write/public/Mod/Users?filter=normal"><button class="tab">Regular Users</button></a>
                <a href="/Free-Write/public/Mod/Users?filter=premium"><button class="tab">Premium Users</button></a>
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
                                <a href="/Free-Write/public/Mod/Users?filter=premium">
                                    <a href="/Free-Write/public/Mod/Search?uid=<?= htmlspecialchars($user['userID']) ?>"><button
                                            class="table-select-user-btn">Select User</button></a>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="special-btns">
                <a href="/Free-Write/public/Mod/DeactivateUser ?usr_id="><button>Deactivate User</button></a>
                <a href="/Free-Write/public/Mod/DeleteUser"><button>Delete User</button></a>
            </div>

            <!-- User details form -->
            <div class="user-details-form">
                <h3>User Details</h3>
                <form id="userDetailsForm">
                    <!-- Row 1: User ID and Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userId">User ID</label>
                            <input type="text" id="userId" name="userId" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['user']) . '"';
                            }
                            ?> disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($users[0]['email']) . '"';
                            }
                            ?> disabled>
                        </div>
                    </div>

                    <!-- Row 2: Log attempts and User Type -->
                    <div class="form-row">

                        <div class="form-group">
                            <label for="loginAttempts">Login Attempts</label>
                            <input type="text" id="loginAttempts" name="loginAttempts" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($users[0]['loginAttempt']) . '"';
                            }
                            ?> disabled>
                        </div>
                        <div class="form-group">
                            <label for="userType">User Type</label>
                            <select name="userType" required>
                                <option value="" disabled <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Type</option>
                                <option value="reader" <?php echo (isset($userDetails) && $users[0]['userType'] == 'reader') ? 'selected' : ''; ?>>Reader</option>
                                <option value="writer" <?php echo (isset($userDetails) && $users[0]['userType'] == 'writer') ? 'selected' : ''; ?>>Writer</option>
                                <option value="covdes" <?php echo (isset($userDetails) && $users[0]['userType'] == 'covdes') ? 'selected' : ''; ?>>Cover Page Designer</option>
                                <option value="wricov" <?php echo (isset($userDetails) && $users[0]['userType'] == 'wricov') ? 'selected' : ''; ?>>Writer and Cover Page
                                    Designer</option>
                                <option value="pub" <?php echo (isset($userDetails) && $users[0]['userType'] == 'pub') ? 'selected' : ''; ?>>Publisher</option>
                                <option value="mod" <?php echo (isset($userDetails) && $users[0]['userType'] == 'mod') ? 'selected' : ''; ?>>Moderator</option>
                                <option value="inst" <?php echo (isset($userDetails) && $users[0]['userType'] == 'inst') ? 'selected' : ''; ?>>Institute</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 3: Premium and Activated -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="premium">Premium</label>
                            <select id="premium" name="premium" <?php echo isset($userDetails) ? '' : 'disabled'; ?>>
                                <option value="" disabled <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Premium Status</option>
                                <option value="true" <?php echo (isset($userDetails) && $users[0]['isPremium'] === '1') ? 'selected' : ''; ?>>True</option>
                                <option value="false" <?php echo (isset($userDetails) && $users[0]['isPremium'] === '0') ? 'selected' : ''; ?>>False</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activated">Activated</label>
                            <select id="activated" name="activated" <?php echo isset($userDetails) ? '' : 'disabled'; ?>>
                                <option value="" disabled <?php echo !isset($userDetails) ? 'selected' : ''; ?>>Select
                                    Activation Status</option>
                                <option value="true" <?php echo (isset($userDetails) && $users[0]['isActivated'] === '1') ? 'selected' : ''; ?>>True</option>
                                <option value="false" <?php echo (isset($userDetails) && $users[0]['isActivated'] === '0') ? 'selected' : ''; ?>>False</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: First last Name -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['firstName']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['lastName']) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <!-- Row 5: dob log Country -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" <?php
                            if (isset($userDetails)) {
                                echo 'value="' . htmlspecialchars($userDetails[0]['country']) . '"';
                            }
                            ?>>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" <?php
                            if (isset($userDetails) && !empty($userDetails[0]['dob'])) {
                                // Convert the date to the format YYYY-MM-DD if it's not already in that format
                                $dob = date('Y-m-d', strtotime($userDetails[0]['dob']));
                                echo 'value="' . htmlspecialchars($dob) . '"';
                            }
                            ?>>
                        </div>
                    </div>

                    <!-- Row 6: last log and Registration Date -->
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

                    <!-- Row 7: Bio -->
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio">
                            <?php
                            if (isset($userDetails)) {
                                echo $userDetails[0]['bio'];
                            }
                            ?>
                            </textarea>
                        </div>
                    </div>
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