<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <link rel="icon" type="image/x-icon" href="/images/FeatherIcon.ico">
        Login
    </title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <form action="/login" method="post">
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>