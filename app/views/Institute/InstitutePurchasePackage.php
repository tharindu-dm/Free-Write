<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution - Purchase Packages</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstitutePurchasePackage.css">
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

    <main>
        <aside class="sidebar">
            <div class="institution-info">
                <img src="/CRUD_OOP/public/assets/images/institution-logo.png" alt="Institution Name">
                <h2>Institution Name</h2>
                <p>Access and Manage</p>
            </div>
            <nav>
                <div class="menu-item" onclick="location.href='index.php?page=instituteDashboard'">Dashboard</div>
                <a href="#"><i class="icon-library"></i> Library</a>
                <a href="#" class="active"><i class="icon-package"></i> Purchase Packages</a>
                <a href="#"><i class="icon-users"></i> Manage Users</a>
            </nav>
            <!-- <button class="btn btn-secondary btn-full-width">Update Profile</button> -->
        </aside>

        <section class="main-content">
            <div class="institution-header">
                <img src="/CRUD_OOP/public/assets/images/institution-header.png" alt="Institution Building">
                <h1>Institution Name</h1>
                <p>Welcome to your Freewrite dashboard</p>
                <p>Last login: 1 day ago</p>
            </div>

            <nav class="tabs">
                <a href="#" class="active">Overview</a>
                <a href="#">Activities</a>
                <a href="#">Settings</a>
            </nav>

            <h2>Purchase Packages</h2>

            <div class="package-grid">
                <!-- Basic Package -->
                <div class="package-card">
                    <h3>Basic</h3>
                    <div class="price">$9.99 <span>per month</span></div>
                    <form action="/Free-Write/public/paymentPage.php" method="POST">
                        <input type="hidden" name="package" value="basic">
                        <input type="hidden" name="price" value="9.99">
                        <button type="submit" class="btn btn-secondary">Choose Basic</button>
                    </form>
                    <ul>
                        <li>Access to 100 books in the Library</li>
                        <li>Access to 5 user accounts</li>
                        <li>1 year validity</li>
                    </ul>
                </div>
                <div class="package-card">
                    <h3>Premium</h3>
                    <div class="price">$19.99 <span>per month</span></div>
                    <button class="btn btn-secondary">Choose Premium</button>
                    <ul>
                        <li>Access to 500 books in the Library</li>
                        <li>Access to 25 user accounts</li>
                        <li>1 year validity</li>
                    </ul>
                </div>
                <div class="package-card">
                    <h3>Unlimited</h3>
                    <div class="price">$29.99 <span>per month</span></div>
                    <button class="btn btn-secondary">Choose Unlimited</button>
                    <ul>
                        <li>Access to unlimited books in the Library</li>
                        <li>Access to 100 user accounts</li>
                        <li>1 year validity</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <?php
  require_once "../app/views/layout/footer.php";
  ?>

    <script src="script.js"></script>
</body>

</html>