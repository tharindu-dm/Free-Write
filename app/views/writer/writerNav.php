<!-- Navigation for Writer Options -->
<!DOCTYPE html>
<html lang="en">

<body>
    <nav class="writer-nav">
        <?php if (isset($_SESSION['user_id']) && ($userDetails['user'] == $_SESSION['user_id'])): ?>
            <a href="/Free-Write/public/Writer/DashboardNew" id="dashboard-link">Books</a>
            <a href="/Free-Write/public/Writer/Quotes" id="quotes-link">Quotes</a>
            <a href="/Free-Write/public/Writer/Spinoffs" id="spinoffs-link">Spin-off Requests</a>

            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_premium'] === '1'): ?>
                <a href="/Free-Write/public/Writer/Competitions" id="competitions-link">Competitions</a>
                <a href="/Free-Write/public/Writer/Insights" id="insights-link">Insights</a>
            <?php endif; ?>

        <?php else: ?>
            <a href="/Free-Write/public/Writer/DashboardNew?writer=<?= htmlspecialchars($userDetails['user']) ?>"
                id="dashboard-link">Books</a>
            <a href="/Free-Write/public/Writer/Quotes?writer=<?= htmlspecialchars($userDetails['user']) ?>"
                id="quotes-link">Quotes</a>
        <?php endif; ?>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get current path
            const currentPath = window.location.pathname;

            // Get all navigation links
            const navLinks = document.querySelectorAll('.writer-nav a');

            // Loop through links and check if href matches current path
            navLinks.forEach(link => {
                if (currentPath === link.getAttribute('href') ||
                    (currentPath.includes(link.getAttribute('href')) &&
                        link.getAttribute('href') !== '/Free-Write/public/Writer/Dashboard')) {
                    link.classList.add('active');
                }
            });

            // Special case for Dashboard/Books which might be the default route
            if (currentPath === '/Free-Write/public/Writer/' ||
                currentPath === '/Free-Write/public/Writer' ||
                currentPath === '/Free-Write/public/Writer/Dashboard') {
                document.getElementById('dashboard-link').classList.add('active');
            }
        });
    </script>
</body>

</html>