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
            <div class="logo">Free Write</div>
            <ul>
                <li><a href="#">Browse</a></li>
                <li><a href="#">Designers</a></li>
                <li><a href="#">Publishers</a></li>
                <li><a href="#">Contests</a></li>
            </ul>
            <div class="search-container">
                <input type="text" placeholder="Search">
            </div>
            <button class="publish-btn">Publish</button>

            <form action="/Free-Write/public/User/logout" method="post">
                <button type="submit" class="sign-out-btn">Sign out</button>
            </form>
            <form action="/Free-Write/public/User/Home" method="post">
                <button type="submit" class="publish-btn">My Profile</button>
            </form>
        </nav>
    </header>
</body>

</html>