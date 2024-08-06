<?php
require 'layout/header.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>

<body>
    <div class="form-body">
        <div class="form-img">
            <img src="../public/images/FeatherIcon.png" alt="Logo">
        </div>

        <div class="form-container">
            <div class="form-login" index="login" hidden>
                <form action="/User.php" method="post">
                    <h2>Welcome Back!</h2>
                    <?php if (isset($error)) : ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <button class="form-button" type="submit">Login</button>
                </form>
            </div>

            <div class="form-login" index="signup">
                <form action="/User.php" method="post">
                    <h2>Nice To Meet You!</h2>
                    <?php if (isset($error)) : ?>
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
                    
                    <button class="form-button" type="submit">Login</button>
                </form>
            </div>

            <div class="form-institution" index="institute" hidden>
                <form action="/User.php" method="post">
                    <h2>Library Access Login</h2>
                    <?php if (isset($error)) : ?>
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <input type="text" name="username" placeholder="Institute Username" required>
                    
                    <input type="password" name="password" placeholder="Password" required>
                    
                    <button class="form-button-diff" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>