<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookDesignForUsers</title>
    <style>
        body {
            background-color: #F5F0E5;
            font-family: Arial, sans-serif;
        }

        /* Book Details Styles */
        .Names {
            margin-left: 10%;
            width: 80%;
        }

        .Names p {
            color: gray;
        }

        .Names h4 {
            font-weight: normal;
        }

        .details {
            margin: 20px;
            margin-left: 10%;
            width: 80%;
        }

        .details h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .column {
            flex: 1;
            padding: 10px;
        }

        .column p {
            color: #333;
        }

        .column p:first-of-type {
            color: #6c757d;
            font-weight: bold;
        }

        .resButton {
            background-color: #FFD052;
            width: 40%;
            margin-left: 10%;
            height: 55px;
            margin-top: 2%;
            font-size: 24px;
            font-weight: normal;
            color: white;
            border: none;
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

    <!-- Book Details -->
    <div class="Names">
        <h1>The Art of War</h1>
        <p>By Sun Tzu</p>

        <h3>Availability </h3>
        <h4>In stock</h4>
        <p>Due back: 2023-10-23</p>
        <h3>Synopsis</h3>
        <h4>The Art of War is an ancient Chinese military treatise attributed to Sun Tzu, a military strategist, and
            philosopher. The text is composed of 13 chapters, each of which is devoted to one aspect of warfare. It is
            commonly known to be the definitive work on strategy and tactics.</h4>
    </div>
    <div class="details">
        <h3>Details</h3>
        <div class="row">
            <div class="column">
                <p><strong>Author</strong></p>
                <p>Sun Tzu</p>
            </div>
            <div class="column">
                <p><strong>Genre</strong></p>
                <p>Non-fiction, Philosophy</p>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <p><strong>Publisher</strong></p>
                <p>Penguin Classics</p>
            </div>
            <div class="column">
                <p><strong>Published Date</strong></p>
                <p>5th century BC</p>
            </div>
        </div>
    </div>
    <button class="resButton">Reserve Book</button>
</body>

</html>