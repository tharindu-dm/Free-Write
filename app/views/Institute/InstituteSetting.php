<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Institution Dashboard</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstituteSetting.css">
</head>
<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <div class="container">
        <?php include_once "../app/views/Institute/sidebar.php"; 
        ?>
        
        <main class="main-content">
            <section class="settings-section">
                <h1>Institution Settings</h1>
                <p>Manage your institution details.</p>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">Details updated successfully!</div>
                <?php elseif (!empty($error)): ?>
                    <div class="alert alert-danger">Failed to update details.</div>
                <?php endif; ?>

                <form method="POST" action="/Free-Write/public/Institute/updateSetting" class="settings-form">
                    <div class="form-group">
                        <label for="name">Institution Name</label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($instDetails['name'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Institution Email</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($instDetails['username'] ?? '') ?>" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <?php require_once "../app/views/layout/footer.php"; ?>
</body>
</html>