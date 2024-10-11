<?php
require_once "../app/controllers/AdminController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/admin.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">Free Write</div>
            <div class="nav-button-container">
                <div class="nav-button">
                    <a href="/Free-Write/public/Browse">Browse</a>
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
            </div>

            <div class="user-info">
                <span>Administrator</span>
            </div>
            <form action="/Free-Write/public/Admin/logout" method="post">
                <button type="submit" class="log-out-btn">LogOut</button>
            </form>
        </nav>
    </header>
</body>

</html>