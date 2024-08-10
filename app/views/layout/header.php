<?php
require_once "/Free-Write/app/controllers/UserController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/index.css">
</head>

<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php">
                <img src="/Free-Write/public/images/FeatherIcon.png" alt="Logo">
                <h1>Freewrite</h1>
            </a>

            <div class="navbar-menu">
                <select class="dropdown">
                    <option value="" selected>Browse All</option>
                    <option value="#">Stories</option>
                    <option value="#">Spin-offs</option>
                    <option value="#">Publisher</option>
                    <option value="#">Cover Designs</option>
                </select>

                <div class="search-bar">
                    <input class="search" type="text" placeholder="Search...">
                    <button type="submit">Search</button>
                </div>

                <div class="auth-buttons">
                    <form action="User/handleLogin" method="post">
                        <button id="loginBtn" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>