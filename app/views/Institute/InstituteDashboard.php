<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteDashboard.css">
</head>
<body>
    <header>
    <a href="/" class="logo"><img src="logo.png" alt="Freewrite" class="logo-icon">
        <nav>
            <a href="#">Browse</a>
            <a href="#">Contests</a>
            <a href="#">For Publishers</a>
            <a href="#">For Advertisers</a>
        </nav>
        <input type="text" class="search-bar" placeholder="Search">
        <button class="btn btn-primary">Publish</button>
        <button class="btn btn-secondary">Sign In</button>
    </header>
    
    <div class="container">
        <div class="sidebar">
            <div class="institution-info">
                <div class="institution-icon"></div>
                <div>
                    <h3>Institution Name</h3>
                    <small>Access Level: Administrator</small>
                </div>
            </div>
            <div class="menu-item active"><a href="/Free-Write/public/Institute/Dashboard">Dashboard</a></div>
            <div class="menu-item"><a href="/Free-Write/public/Institute/Library">Library</a></div>
            <div class="menu-item"><a href="/Free-Write/public/Institute/PurchasePackage">Packages</a></div>
            <div class="menu-item"><a href="/Free-Write/public/Institute/ManageUser">User Management</a></div>
        </div>
        
        <div class="main-content">
            <h1>Welcome to Freewrite, Institution Name</h1>
            <p>Manage your institution's Freewrite experience</p>
            
            <h2>Institution Dashboard</h2>
            <p>Access and manage your institution's Freewrite resources.</p>
            
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Access Library</h3>
                    <p>Explore a vast collection of stories and educational material tailored for your institution.</p>
                </div>
                <div class="card">
                    <h3>Purchase Packages</h3>
                    <p>Browse and purchase content packages to expand your library and resources.</p>
                </div>
                <div class="card">
                    <h3>Manage Users</h3>
                    <p>Add, remove, or modify user accounts and permissions within your institution.</p>
                </div>
            </div>
            
            <div class="feature-section">
                <div class="feature-image"></div>
                <div>
                    <h2>Explore and Share Incredible Stories</h2>
                    <p>Join a community of passionate writers and readers. Discover new narratives, participate in contests, and connect with fellow creatives.</p>
                    <button class="btn btn-primary">Browse Stories</button>
                    <button class="btn btn-secondary">Start Writing</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../public/js/Institute/institute dashboard.js"></script>
</body>
</html>