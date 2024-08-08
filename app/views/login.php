<?php
require_once 'layout/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>
    <link rel="stylesheet" href="/Free-Write/public/css/index.css">
    <link rel="stylesheet" href="/Free-Write/public/css/login.css">
</head>

<body>
    <div class="form-body">
        <div class="form-img">
            <img src="/Free-Write/public/images/FeatherIcon.png" alt="Logo">
        </div>

        <div class="form-container">
            <div class="form-login" id="login-form">
                <form action="/login" method="post">
                    <h2>Welcome Back!</h2>
                    <?php if (isset($error)): ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <p>Not a reader yet? <a href="#" id="joinLink">Join here</a></p>

                    <button class="form-button" type="submit">Login</button>

                    <p><a href="#" id="instLog">Institution Login Here</a></p>
                </form>
            </div>

            <div class="form-login" id="signup-form" style="display: none;">
                <form action="/login" method="post">
                    <h2>Nice To Meet You!</h2>
                    <?php if (isset($error)): ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <div class="form-name">
                        <input type="text" name="first-name" placeholder="First Name" required>
                        <input type="text" name="last-name" placeholder="Last Name" required>
                    </div>

                    <input type="text" name="email" placeholder="Email" required>

                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required oninput="">
                    <input type="password" name="conf-password" placeholder="Confirm Password" required oninput="">

                    <p>Already a reader? <a href="#" id="loginLink">Login here</a></p>

                    <button class="form-button" type="submit">Login</button>
                </form>
            </div>

            <div class="form-institution" id="inst-form" style="display: none;">
                <form action="/login" method="post">
                    <h2>Library Access Login</h2>
                    <?php if (isset($error)): ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <input type="text" name="username" placeholder="Institute Username" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <button class="form-button-diff" type="submit">Login</button>

                    <p>Reader <a id="instTOread" href="#">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="/Free-Write/public/js/login.js"></script>
</body>

</html>