<?php
require_once "../app/controllers/UserController.php"; //since this "navigation bar" contain login button
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/home.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo"><a href="/Free-Write/public/">Free Write</a></div>
            <ul>
                <li><a href="/Free-Write/public/Browse">Browse</a></li>
                <li><a href="/Free-Write/public/Designers">Designers</a></li>
                <li><a href="/Free-Write/public/Publishers">Publishers</a></li>
                <li><a href="/Free-Write/public/Contests">Contests</a></li>
            </ul>
            <div class="search-container">
                <input type="text" placeholder="Search">
                <button class="publish-btn">Search</button>
            </div>

            <div class="action-button-container">
                <div class="action-button">
                    <button class="publish-btn">Publish</button>
                </div>
                <div class="action-button">
                    <form action="/Free-Write/public/Login" method="post">
                        <button type="submit" class="sign-in-btn">Sign In</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>