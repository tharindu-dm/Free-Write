<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Login</title>
    <link rel="stylesheet" href="/Free-Write/public/css/login.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header.php";
    ?>
    <main>
        <div class="login-page">
            <div class="creativity-section">
                <div class="creativity-content">
                    <h1>Unleash Your Creativity</h1>
                    <p>Join a community of passionate readers and writers. Transform your ideas into compelling stories,
                        connect with like-minded creators, and bring your imagination to life.</p>
                    <div class="feature-highlights">
                        <div class="feature">
                            <svg xmlns="http://www.w3.com/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 18.636A8.214 8.214 0 0118 16.75c.966 0 1.907.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v14.103z" />
                            </svg>
                            <span>Unlimited Writing Space</span>

                        </div>
                        <div class="feature">
                            <svg xmlns="http://www.w3.com/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.902.524v2.475a.75.75 0 01-1.264.546l-3.75-3.75a.75.75 0 01.372-1.295l2.642-.523V6.341c0-1.691-1.1-3.193-2.716-3.566a48.111 48.111 0 00-6.837-.355.75.75 0 01-.722-.807z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Community Feedback</span>
                        </div>
                        <div class="feature">
                            <svg xmlns="http://www.w3.com/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 00-1.838-.788H4.107a2.625 2.625 0 00-1.838.788C1.026 3.335 0 5.025 0 6.977V17.5A2.507 2.507 0 002.5 20h19a2.507 2.507 0 002.5-2.5V6.977c0-1.952-1.026-3.642-2.769-4.708z" />
                            </svg>
                            <span>Publish & Share</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-section">
                <section class="login-container">
                    <!-- Your existing form content remains the same -->
                    <div class="two-forms-container">
                        <div id="login-form-div">
                            <h1>Log In</h1><br>
                            <form id="login-form" action="/Free-Write/public/Login/login" method="POST">
                                <legend></legend>
                                <input type="hidden" name="action" value="login">
                                <input type="email" name="log-email" id="log-email"
                                    placeholder="Enter your email/username" required>
                                <input type="password" id="log-password" name="log-password" placeholder="Password"
                                    required>
                                <div class="button-group">
                                    <button type="button" class="sign-up-btn" id="sign-up-btn">Sign Up</button>
                                    <button type="submit" class="login-btn" id="login-btn-submit">Login</button>
                                </div>
                            </form>
                        </div>

                        <div id="register-form-div" style="display: none;">
                            <h1>Sign Up</h1><br>
                            <form id="register-form" action="/Free-Write/public/Login/register" method="POST">

                                <div class="signup-names">
                                    <input type="hidden" name="action" value="register">
                                    <input type="text" name="fname" placeholder="Enter your first name" required>
                                    <input type="text" name="lname" placeholder="Enter your last name" required>
                                </div>

                                <input type="email" name="signup-email" id="emailReg" placeholder="Enter your email"
                                    required>
                                <input type="password" id="passwordReg" name="pw" placeholder="Password" required>
                                <input type="password" id="confpass" name="confpw" placeholder="Confirm Password"
                                    required>
                                <div class="button-group">
                                    <button type="button" class="return-btn" id="login-btn">Return To Login</button>
                                    <button type="submit" class="login-btn" id="register-btn">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="/Free-Write/public/js/login.js"></script>
</body>

</html>