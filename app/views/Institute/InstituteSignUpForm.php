<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Signup - Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteSignUpForm.css">
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
    //show($data);
    ?>

    <div class="signup-container">
        <div class="signup-header">
            <h1>Unleash Your Creativity with Freewrite</h1>
            <p>Join our community of institutions fostering creativity in education.</p>
        </div>

        <form action="/Free-Write/public/Institute/signup" method="POST" class="signup-form" id="institutionSignupForm">
            <div class="form-group">
                <label for="institutionName">Institution Name</label>
                <input type="text" id="institutionName" name="institutionName" required>
            </div>

            <div class="form-group">
                <label for="username">Username (@inst.fw)</label>
                <input type="text" id="username" name="username" required>
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
                    <input type="email" id="Creater" name="Creater" disabled value="<?= htmlspecialchars($user['email']) ?>" />
                </div>
            </div>

            <div class="form-actions">
                <a href="/login" class="login-link">Return to Login</a>
                <button type="submit" class="btn btn-submit">Sign Up</button>
            </div>
        </form>
    </div>

    <?php require_once "../app/views/layout/footer.php"; ?>
    <script>
        /*document.getElementById('institutionSignupForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Password validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            // Date validation
            const startDate = new Date(document.getElementById('subStartDate').value);
            const endDate = new Date(document.getElementById('subEndDate').value);

            if (endDate <= startDate) {
                alert('End date must be after start date!');
                return;
            }

            // Form submission logic here
            console.log('Form submitted successfully');
        });

        // Set minimum date for subscription dates to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('subStartDate').min = today;
        document.getElementById('subEndDate').min = today;

        // Update end date minimum when start date changes
        document.getElementById('subStartDate').addEventListener('change', function(e) {
            document.getElementById('subEndDate').min = e.target.value;
        });*/
    </script>
</body>

</html>