<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Publisher Account</title>
    <style>
        /* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #FCFAF5;
    color: #1C160C;
    line-height: 1.6;
}

/* Form Section */
.form-section {
    max-width: 900px;
    margin: 3rem auto;
    padding: 2rem;
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-header h1 {
    font-size: 2.8rem;
    margin-bottom: 1rem;
    color: #1C160C;
    font-weight: 700;
}

.form-header p {
    color: #666;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

.publisher-form {
    background-color: #FFFFFF;
    padding: 3rem;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.publisher-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: #FFD052;
}

.form-group {
    margin-bottom: 2rem;
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 0.8rem;
    font-weight: 600;
    color: #1C160C;
    font-size: 1.1rem;
}

.form-group .description {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 1.2rem;
    border: 2px solid #E9DFCE;
    border-radius: 10px;
    background-color: #FCFAF5;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #FFD052;
    box-shadow: 0 0 0 4px rgba(255, 208, 82, 0.2);
    background-color: #FFFFFF;
}

.form-group textarea {
    min-height: 150px;
    resize: vertical;
}

/* Logo Upload Section */
.logo-upload {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    padding: 2rem;
    background-color: #FAFAFA;
    border-radius: 12px;
    border: 2px dashed #E9DFCE;
}

.logo-preview-container {
    position: relative;
}

.logo-upload img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #E9DFCE;
    transition: all 0.3s ease;
}

.logo-upload-content {
    flex: 1;
}

.logo-upload h3 {
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.logo-upload p {
    color: #666;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.upload-button {
    display: inline-block;
    padding: 0.8rem 1.5rem;
    background-color: #FFD052;
    color: #1C160C;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.upload-button:hover {
    background-color: #E0B94A;
    transform: translateY(-2px);
}

.file-requirements {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #666;
}

/* Submit Button */
.submit-button {
    width: 100%;
    padding: 1.2rem;
    background-color: #FFD052;
    color: #1C160C;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    margin-top: 2rem;
}

.submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    background-color: #E0B94A;
}

/* Form Validation Styles */
.form-group.error input,
.form-group.error textarea {
    border-color: #FF4D4D;
}

.error-message {
    color: #FF4D4D;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    display: none;
}

.form-group.error .error-message {
    display: block;
}

/* Success Styles */
.form-group.success input,
.form-group.success textarea {
    border-color: #4CAF50;
}

/* Password Strength Indicator */
.password-strength {
    margin-top: 0.5rem;
    height: 4px;
    background-color: #ddd;
    border-radius: 2px;
    overflow: hidden;
}

.password-strength-bar {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
}

.strength-weak {
    width: 33.33%;
    background-color: #FF4D4D;
}

.strength-medium {
    width: 66.66%;
    background-color: #FFA500;
}

.strength-strong {
    width: 100%;
    background-color: #4CAF50;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-section {
        padding: 1rem;
        margin: 1rem;
    }

    .publisher-form {
        padding: 1.5rem;
    }

    .form-header h1 {
        font-size: 2rem;
    }

    .logo-upload {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
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
        <section class="form-section">
            <div class="form-header">
                <h1>Create Publisher Account</h1>
                <p>Join our publishing community and share your literary works with readers worldwide. Complete the form below to get started.</p>
            </div>

            <form class="publisher-form" action="/Free-Write/public/Publisher/index" method="POST" enctype="multipart/form-data">
                <div class="logo-upload">
                    <div class="logo-preview-container">
                        <img src="/api/placeholder/120/120" alt="Publisher Logo Preview" id="logo-preview">
                    </div>
                    <div class="logo-upload-content">
                        <h3>Publisher Logo</h3>
                        <p>Upload a professional logo to represent your publishing brand</p>
                        <label for="logo-input" class="upload-button">Choose Image</label>
                        <input type="file" id="logo-input" name="logo" accept="image/*" hidden>
                        <div class="file-requirements">
                            Recommended: 400x400px or larger, Maximum size: 2MB
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Publisher Name</label>
                    <div class="description">This will be your public display name</div>
                    <input type="text" id="name" name="name" required>
                    <div class="error-message">Please enter a valid publisher name</div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="description">We'll use this for account verification and updates</div>
                    <input type="email" id="email" name="email" required>
                    <div class="error-message">Please enter a valid email address</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="description">Use at least 8 characters with a mix of letters, numbers & symbols</div>
                    <input type="password" id="password" name="password" required>
                    <div class="password-strength">
                        <div class="password-strength-bar"></div>
                    </div>
                    <div class="error-message">Password must meet the requirements</div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <div class="error-message">Passwords do not match</div>
                </div>

                <div class="form-group">
                    <label for="website">Website (Optional)</label>
                    <div class="description">Your official website or social media presence</div>
                    <input type="url" id="website" name="website" placeholder="https://">
                </div>

                <div class="form-group">
                    <label for="description">Publisher Description</label>
                    <div class="description">Tell readers about your publishing house, specialties, and vision</div>
                    <textarea id="description" name="description" required 
                        placeholder="Share your publishing journey, areas of focus, and what makes your publications unique..."></textarea>
                    <div class="error-message">Please provide a description</div>
                </div>

                <a href="/Free-Write/public/Publisher/index"><button type="submit" class="submit-button">Create Publisher Account</button></a>
            </form>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        // Logo preview functionality
        document.getElementById('logo-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logo-preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Simple password strength checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.querySelector('.password-strength-bar');
            
            // Simple password strength logic
            if (password.length >= 8) {
                if (password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/)) {
                    strengthBar.className = 'password-strength-bar strength-strong';
                } else if (password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/)) {
                    strengthBar.className = 'password-strength-bar strength-medium';
                } else {
                    strengthBar.className = 'password-strength-bar strength-weak';
                }
            } else {
                strengthBar.className = 'password-strength-bar';
            }
        });
    </script>
</body>

</html>