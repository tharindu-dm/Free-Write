<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main class="new-section">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 4v16a2 2 0 0 0 2 2h16" />
            <path d="M6 2h12a2 2 0 0 1 2 2v16" />
            <path d="M6 8h12" />
        </svg><br>

        <h2>'Hi, <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>!
            You haven't written any stories yet.</h2><br>
        <a href="/Free-Write/public/Writer/New" class="button-new">+ Create a Story</a>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>


    <script src="/public/js/home.js"></script>
</body>

</html>