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
        <div class="notfication-title">
            <h1>My Notifications</h1>
            <div class="notification-counts">
                <div class="importance-notify" style="background-color:#ffd700;">Total: <?= $data['notifyCounts'] ?>
                </div>
                <div class="importance-notify" style="background-color:red;">Important:
                    <?= $importanceCounts['important'] ?>
                </div>
                <div class="importance-notify">Normal: <?= $importanceCounts['normal'] ?> </div>
            </div>
        </div>

        <section class="notifications">

            <?php if (isset($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <div
                        class="notification <?= $notification['isRead'] ? 'read' : 'unread' ?> <?= $notification['importance'] == 'important' ? 'important-noti' : 'normal-noti' ?>">
                        <div class="notification-header">
                            <h2 class="subject">
                                <?= ($notification['importance'] == 'important') ? '(IMPORTANT)' : '' ?>        <?= $notification['subject'] ?>
                            </h2>
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