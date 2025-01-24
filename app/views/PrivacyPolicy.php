<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <style>
        main {
            margin-top: 1rem;
            margin-bottom: 1rem;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ffd700;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-height: fit-content;
        }

        h1 {
            color: #ffd700;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
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
        <div class="container">
            <h1>Privacy Policy</h1>
            <h2>1. Information We Collect</h2>
            <h3>Personal Information</h3>
            <ul>
                <li>Name and email address</li>
                <li>Birthday</li>
                <li>Reading preferences and history</li>
                <li>User-generated content</li>
            </ul>
            <h3>Automatically Collected Information</h3>
            <ul>
                <li>Device information</li>
                <li>IP address</li>
                <li>Browser type</li>
                <li>Usage data</li>
            </ul>

            <h2>2. How We Use Your Information</h2>
            <ul>
                <li>To provide and maintain our service</li>
                <li>To notify you about changes to our service</li>
                <li>To provide customer support</li>
                <li>To analyze usage patterns and improve our service</li>
                <li>To communicate with you about features and updates</li>
            </ul>

            <h2>3. Information Sharing</h2>
            <p>We do not sell your personal information. We may share your information:</p>
            <ul>
                <li>With your consent</li>
                <li>To comply with legal obligations</li>
                <li>To protect our rights and safety</li>
                <li>With service providers who assist in our operations</li>
            </ul>

            <h2>4. Data Security</h2>
            <p>We implement appropriate security measures to protect your personal information.</p>

            <h2>5. Your Rights</h2>
            <ul>
                <li>Access your personal information</li>
                <li>Correct inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Object to data processing</li>
                <li>Export your data</li>
            </ul>

            <h2>6. Cookies</h2>
            <p>We use cookies to:</p>
            <ul>
                <li>Remember your preferences</li>
                <li>Understand how you use our service</li>
                <li>Improve user experience</li>
            </ul>

            <h2>7. Contact Us</h2>
            <p>For questions about these policies or your privacy rights, contact us at <a
                    href="mailto:privacy@free-write.com">privacy@free-write.com</a></p>

            <h2>8. Changes to Privacy Policy</h2>
            <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new
                policy on this page.</p>

            <p>Last updated: January 17, 2025</p>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>