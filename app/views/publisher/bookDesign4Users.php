<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookDesignForUsers</title>
    <style>
        .user-actions {
            display: flex;
            align-items: center;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            margin: 0 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

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
            cursor: pointer;
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
        case 'mod':
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

    <div class="Names">
        <h1><?php echo htmlspecialchars($book['title']); ?></h1>
        <p>By <?php echo htmlspecialchars($book['author']); ?></p>

        <h3>Availability</h3>
        <h4><?php echo htmlspecialchars($book['status']); ?></h4>
        <p>Due back: <?php echo htmlspecialchars($book['due_date']); ?></p>
        <h3>Synopsis</h3>
        <h4><?php echo htmlspecialchars($book['synopsis']); ?></h4>
    </div>

    <div class="details">
        <h3>Details</h3>
        <div class="row">
            <div class="column">
                <p><strong>Author</strong></p>
                <p><?php echo htmlspecialchars($book['author']); ?></p>
            </div>
            <div class="column">
                <p><strong>Genre</strong></p>
                <p><?php echo htmlspecialchars($book['genre']); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <p><strong>Publisher</strong></p>
                <p><?php echo htmlspecialchars($book['publisher']); ?></p>
            </div>
            <div class="column">
                <p><strong>Published Date</strong></p>
                <p><?php echo htmlspecialchars($book['published_date']); ?></p>
            </div>
        </div>
    </div>

    <form method="POST" action="reserve.php">
        <input type="hidden" name="book_id" value="1">
        <button type="submit" class="resButton">Reserve Book</button>
    </form>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>