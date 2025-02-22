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
        <!--sidebar-->
        <?php include_once "../app/views/Institute/sidebar.php"; ?>

        <section class="main-content">
            <div class="institution-header">
                <img src="/CRUD_OOP/public/assets/images/institution-header.png" alt="Institution Building">
                <h1>Institution Name</h1>
                <p>Welcome to your Freewrite dashboard</p>
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
                        <li>Access to 10 user accounts</li>
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