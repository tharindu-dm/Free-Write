<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/home.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header.php";
    ?>

    <main>
        <section class="hero">
            <img src="..\public\images\FeatherIcon.png" alt="Feather" class="feather-icon">
            <h1>Explore and Share Incredible Stories</h1>
            <p>Join a community of passionate writers and readers. Discover new fanfictions, participate in contests,
                and connect with fellow creatives.</p>
            <div class="cta-buttons">
                <button class="browse-btn">Browse Stories</button>
                <button class="start-writing-btn">Start Writing</button>
                <button class="share-designs-btn">Share Designs</button>
            </div>
        </section>

        <section class="why-freewrite">
            <h2>Why Freewrite?</h2>
            <p>A platform that celebrates creativity and collaboration.</p>
            <div class="features">
                <div class="feature">
                    <img src="pen-icon.png" alt="Publish">
                    <h3>Publish Your Work</h3>
                    <p>Share your fanfictions with an engaged audience.</p>
                </div>
                <div class="feature">
                    <img src="trophy-icon.png" alt="Contests">
                    <h3>Join Contests</h3>
                    <p>Participate in writing and cover design contests.</p>
                </div>
                <div class="feature">
                    <img src="money-icon.png" alt="Monetize">
                    <h3>Monetize Creatively</h3>
                    <p>Sell exclusive content and gain subscribers.</p>
                </div>
            </div>
        </section>

        <section class="cta">
            <h2>Ready to unleash your creativity?</h2>
            <button class="join-btn">Join Freewrite</button>
        </section>

        <section class="pricing">
            <div class="plan">
                <h3>Free Membership</h3>
                <p class="price">LKR. 0 <span>per month</span></p>
                <button class="get-started-btn">Get Started</button>
                <ul>
                    <li>Access to all stories</li>
                    <li>Create Spin-offs</li>
                    <li>Purchase Content</li>
                </ul>
            </div>
            <div class="plan premium">
                <h3>Premium Reader</h3>
                <p class="price">LKR. 899 <span>per month</span></p>
                <button class="upgrade-btn">Upgrade Now</button>
                <ul>
                    <li>10% Discount on virtual book/chapters</li>
                    <li>Ad-free experience</li>
                    <li>Premium contests</li>
                </ul>
            </div>
            <div class="plan premium">
                <h3>Premium Writer</h3>
                <p class="price">LKR. 1,199 <span>per month</span></p>
                <button class="upgrade-btn">Upgrade Now</button>
                <ul>
                    <li>Ad-free experience</li>
                    <li>Create contests</li>
                    <li>Boost books</li>
                    <li>24 hr support</li>
                </ul>
            </div>
            <div class="plan premium">
                <h3>Institution</h3>
                <p class="price">LKR. 4,999 <span>per month</span></p>
                <button class="upgrade-btn">Request Now</button>
                <ul>
                    <li>Access to all public stories</li>
                    <li>Ad-free experience</li>
                    <li>Customizable restictions on displayed content</li>
                </ul>
            </div>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="..\public\js\home.js"></script>
</body>

</html>