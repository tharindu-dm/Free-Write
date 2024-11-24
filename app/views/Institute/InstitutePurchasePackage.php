<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution - Purchase Packages</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstitutePurchasePackage.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/CRUD_OOP/public/assets/images/logo.png" alt="Freewrite">
            Freewrite
        </div>
        <nav>
            <a href="#">Browse</a>
            <a href="#">Contests</a>
            <a href="#">For Publishers</a>
            <a href="#">For Advertisers</a>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        <button class="btn btn-primary">Publish</button>
        <button class="btn btn-secondary">Sign In</button>
        <div class="user-avatar">
            <img src="/CRUD_OOP/public/assets/images/profile-placeholder.jpg" alt="User">
        </div>
    </header>

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
                <div class="package-card">
                    <h3>Basic</h3>
                    <div class="price">$9.99 <span>per month</span></div>
                    <button class="btn btn-secondary">Choose Basic</button>
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
                        <li>2 years validity</li>
                    </ul>
                </div>
                <div class="package-card">
                    <h3>Unlimited</h3>
                    <div class="price">$29.99 <span>per month</span></div>
                    <button class="btn btn-secondary">Choose Unlimited</button>
                    <ul>
                        <li>Access to unlimited books in the Library</li>
                        <li>Access to 100 user accounts</li>
                        <li>Lifetime validity</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <nav>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Terms of Use</a>
            <a href="#">Privacy Policy</a>
        </nav>
        <div class="social-icons">
            <a href="#" class="icon-twitter"></a>
            <a href="#" class="icon-facebook"></a>
            <a href="#" class="icon-instagram"></a>
        </div>
        <p>&copy; 2023 Freewrite. All rights reserved</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>