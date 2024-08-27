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
            <img src="settings-icon.png" alt="Settings" class="icon">
            <img src="notifications-icon.png" alt="Notifications" class="icon">
            <span>Administrator</span>
        </div>
        </nav>
    </header>
</body>

</html>