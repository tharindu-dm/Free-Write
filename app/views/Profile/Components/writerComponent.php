<!DOCTYPE html>
<html lang="en">

<body>
    <div>
        <button id="writerDashboard" class="extra-btn-dashboard">Visit Writer Dashboard</button>
    </div>

    <script>
        document.getElementById('writerDashboard').addEventListener('click', function () {
            window.location.href = '/Free-Write/public/Writer/ViewWriter';
        });
    </script>
</body>


</html>