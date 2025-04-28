<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite Institution - Purchase Packages</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstitutePurchasePackage.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>
        <?php include_once "../app/views/Institute/sidebar.php"; ?>

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
                    <form action="/Free-Write/public/paymentPage.php" method="POST">
                        <input type="hidden" name="package" value="basic">
                        <input type="hidden" name="price" value="9.99">

                        <button type="submit" class="btn btn-secondary">Choose Basic</button>

                    </form>
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