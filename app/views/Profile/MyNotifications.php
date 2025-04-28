<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Collection</title>
    <link rel="stylesheet" href="/Free-Write/public/css/notificationView.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>


    <main class="notification-page">
        <h1>My Notifications</h1>
        <section class="notifications">

            <?php if (isset($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="notification <?= $notification['isRead'] ? 'read' : 'unread' ?>">
                        <div class="notification-header">
                            <h2 class="subject"><?= htmlspecialchars($notification['subject']) ?></h2>
                            <span class="sent-date">Sent: <?= htmlspecialchars($notification['sentDate']) ?></span>
                        </div>
                        <p class="message">
                            <?= htmlspecialchars($notification['message']) ?>
                        </p>
                        <div class="notification-footer">
                            <span
                                class="read-date"><?= $notification['isRead'] ? 'Read: ' . htmlspecialchars($notification['isReadDate']) : 'Unread' ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notification no-notifications">
                    <p>You have no notifications.</p>
                </div>
            <?php endif; ?>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="#"></script>
</body>

</html>