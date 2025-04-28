<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Signup - Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteSignUpForm.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <div class="signup-container">
        <div class="signup-header">
            <h1>Accessibility For Everyone - Join Freewrite</h1>
            <p>Join our community of institutions fostering creativity in education.</p>
        </div>

        <form action="/Free-Write/public/Institute/signup" method="POST" class="signup-form" id="institutionSignupForm">
            <div class="form-group">
                <label for="institutionName">Institution Name</label>
                <input type="text" id="institutionName" name="institutionName" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <div class="form-group-username">
                    <input type="text" id="username" name="username" required>
                    <input type="text" value="@inst.fw" disabled minlength="10">
                </div>

                <input type="hidden" id="emaildomain">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="Creater">Created By (email)</label>
                    <input type="email" id="Creater" name="Creater" disabled
                        value="<?= htmlspecialchars($user['email']) ?>" />
                </div>
            </div>

            <div class="form-actions">
                <a href="/login" class="login-link">Return to Login</a>
                <button type="submit" class="btn btn-submit">Sign Up</button>
            </div>
        </form>
    </div>

    <?php require_once "../app/views/layout/footer.php"; ?>
    <script src="/Free-Write/public/js/Institute/InstituteSignUpForm.js"></script>
</body>

</html>