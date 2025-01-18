<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Free-Write/public/css/header.css">
</head>

<body>
    <div>
        <button id="writerDashboard">Visit Institute Dashboard</button>
    </div>

    <script>
        document.getElementById('writerDashboard').addEventListener('click', function () {
            window.location.href = '/Free-Write/public/Institute/Dashboard';
        });
    </script>
</body>


</html>