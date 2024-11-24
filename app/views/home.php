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
        default:
            require_once "../app/views/layout/header.php";
    }
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>

                    <h3>Publish Your Work</h3>
                    <p>Share your fanfictions with an engaged audience.</p>
                </div>
                <div class="feature">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                    </svg>

                    <h3>Join Contests</h3>
                    <p>Participate in writing and cover design contests.</p>
                </div>
                <div class="feature">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

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
                <a href="/Free-Write/public/Institute/Register"><button class="upgrade-btn">Request Now</button></a>
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