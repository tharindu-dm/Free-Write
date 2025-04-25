<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service</title>
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

        ol {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="container">
            <h1>Terms of Service</h1>
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing and using Free-Write, you agree to be bound by these Terms of Service ("Terms"). Please read
                them carefully before using our services.</p>

            <h2>2. User Accounts</h2>
            <ol>
                <li>You must be at least 13 years old to create an account.</li>
                <li>You are responsible for maintaining the security of your account.</li>
                <li>You must provide accurate and complete information when creating an account.</li>
                <li>One person or legal entity may maintain no more than one account.</li>
            </ol>

            <h2>3. User Content</h2>
            <p>You retain ownership of any content you post on Free-Write. By posting content, you grant Free-Write a
                non-exclusive license to use, display, and distribute your content. You are responsible for ensuring you
                have the right to post any content. Prohibited content includes but is not limited to:</p>
            <ul>
                <li>Copyrighted material without permission</li>
                <li>Hate speech or discriminatory content</li>
                <li>Explicit adult content</li>
                <li>Spam or misleading information</li>
            </ul>

            <h2>4. Account Termination</h2>
            <p>We reserve the right to suspend or terminate accounts that violate our Terms of Service or engage in
                inappropriate behavior.</p>

            <h2>5. Changes to Service</h2>
            <p>We may modify or discontinue any part of our service with or without notice.</p>

            <h2>6. Limitation of Liability</h2>
            <p>Free-Write is provided "as is" without warranties of any kind, either express or implied.</p>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>