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
            <ul>
                <li><a href="#">Browse</a></li>
                <li><a href="#">Designers</a></li>
                <li><a href="#">Publishers</a></li>
                <li><a href="#">Contests</a></li>
            </ul>
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