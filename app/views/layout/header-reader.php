<?php
require_once "../app/controllers/UserController.php"; //since this "navigation bar" contain login button
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/header.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo"><a href="/Free-Write/public/">Free Write</a></div>
            
            <div class="nav-button-container">
                <div class="nav-button">
                    <a href="/Free-Write/public/Browse/">Browse</a>
                </div>
                <div class="nav-button">
                    <a href="/Free-Write/public/Designers/">Designers</a>
                </div>
                <div class="nav-button">
                    <a href="/Free-Write/public/Publishers/">Publishers</a>
                </div>
                <div class="nav-button">
                    <a href="/Free-Write/public/Contests/">Contests</a>
                </div>
            </div>

            <div class="search-container">
                <input type="text" placeholder="Search">
                <button class="publish-btn">Search</button>
            </div>

            <div class="action-button-container">
                <div class="action-button">
                    <button class="publish-btn">Publish</button>
                </div>
                <div class="action-button">
                    <form action="/Free-Write/public/Login/logout" method="post">
                        <button type="submit" class="sign-in-btn">Log Out</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>