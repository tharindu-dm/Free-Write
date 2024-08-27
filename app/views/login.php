<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Unleash Your Creativity</title>
    <link rel="stylesheet" href="/Free-Write/public/css/login.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header.php";
    ?>
    <main>
        <section class="login-container">
            <h1>Unleash Your Creativity with Freewrite</h1>
            <p>Join a community of passionate readers and writers.</p>
            <div>
                <div id="login-form-div">
                    <form id="login-form" action="http://localhost/Free-Write/public/User/login" method="POST">
                        <input type="hidden" name="action" value="login">
                        <input type="email" onchange="validateEmail()" name="log-email" id="log-email" placeholder="Enter your email" required>
                        <input type="password" name="log-password" placeholder="Password" required>
                        <div class="button-group">
                            <button type="button" class="sign-up-btn" id="sign-up-btn">Sign Up</button>
                            <button type="submit" class="login-btn" id="login-btn-submit">Login</button>
                        </div>
                    </form>
                </div>
                <div id="register-form-div">
                    <form id="register-form" action="http://localhost/Free-Write/public/User/register" method="POST">
                        <input type="hidden" name="action" value="register">
                        <input type="text" name="fname" placeholder="Enter your first name" required>
                        <input type="text" name="lname" placeholder="Enter your last name" required>
                        <input type="email" name="email" onchange="validateEmail()" placeholder="Enter your email" required>
                        <input type="password" onchange="checkPassStrength()" onsubmit="hashPassword()" id="passwordReg" name="pw" placeholder="Password" required>
                        <input type="password" onchange="checkpwMatch()" id="confpass" name="confpw" placeholder="Confirm Password" required>
                        <div class="button-group">
                            <button type="button" class="return-btn" id="login-btn">Return To Login</button>
                            <button type="submit" class="login-btn" id="register-btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/login.js"></script>
</body>

</html>