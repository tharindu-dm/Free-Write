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
    //show($data);
    ?>

    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                        alt="Profile Picture" class="user-profile-picture">
                </div>

                <?php if (!empty($userDetails) && is_array($userDetails)): ?>
                    <h2 style="color: var(--black);">
                        <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                    </h2>
                    <div class="profile-info">
                        <p><strong><?= htmlspecialchars($followers['followers']) ?> Followers</strong></p>
                        <p><strong><?= htmlspecialchars((string) $views); ?> Views</strong></p>
                    </div>
                <?php else: ?>
                    <h2>User Name</h2>
                <?php endif; ?>
            </div>

            <!-- Navigation for Writer Options -->
            <?php require_once "../app/views/writer/writerNav.php"; ?>

            <!-- Check if there are any spinoff requests -->
            <?php if (empty($pendingSpinoffs) && empty($acceptedSpinoffs) && empty($rejectedSpinoffs)): ?>
                <div class="no-requests">
                    <h2><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 4v16a2 2 0 0 0 2 2h16" />
                            <path d="M6 2h12a2 2 0 0 1 2 2v16" />
                            <path d="M6 8h12" />
                        </svg><br>
                        You haven't received any requests.
                    </h2>
                </div>
            <?php else: ?>
                <div class="spinoff-container">
                    <!-- Navigation Tabs -->
                    <div class="spinoff-nav">
                        <button class="tab-btn active" onclick="showSection('pending')">Pending</button>
                        <button class="tab-btn" onclick="showSection('accepted')">Accepted</button>
                        <button class="tab-btn" onclick="showSection('rejected')">Rejected</button>
                    </div>

                    <?php
                    // Helper function to generate the spinoff section
                    function generateSpinoffSection($spinoffs, $sectionId, $sectionTitle)
                    {
                        echo "<section id=\"$sectionId\" class=\"spinoff-section\">";
                        echo "<h2>$sectionTitle</h2>";
                        if (!empty($spinoffs)) {
                            echo "<ul class=\"spinoff-list\">";
                            foreach ($spinoffs as $spinoff) {
                                echo "<li class=\"spinoff-item\">
                                    <a href=\"/Free-Write/public/Writer/ViewSpinoff/" . htmlspecialchars($spinoff['spinoffID']) . "\" class=\"spinoff-link\">
                                        <h3>" . htmlspecialchars($spinoff['SpinoffTitle']) . "</h3>
                                        <p><strong>" . htmlspecialchars($spinoff['BookTitle']) . "</strong> | " . htmlspecialchars($spinoff['ChapterTitle']) . "</p>
                                    </a>
                                  </li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<div class=\"no-requests\"><p>No $sectionTitle spinoff requests available</p></div>";
                        }
                        echo "</section>";
                    }

                    // Generate sections for Pending, Accepted, and Rejected spinoffs
                    generateSpinoffSection($pendingSpinoffs, 'pending', 'Pending');
                    generateSpinoffSection($acceptedSpinoffs, 'accepted', 'Accepted');
                    generateSpinoffSection($rejectedSpinoffs, 'rejected', 'Rejected');
                    ?>
                </div>
            <?php endif; ?>
        </div> <!-- End of Dashboard -->
    </main>

    <!-- Footer Section -->
    <?php require_once "../app/views/layout/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize by showing the pending section
            showSection('pending');
        });

        function showSection(sectionId) {
            // Hide all sections first
            const sections = document.querySelectorAll('.spinoff-section');
            sections.forEach(section => {
                section.style.display = 'none';
                section.classList.remove('active');
            });

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
                selectedSection.classList.add('active');
            }

            // Add active class to the clicked button
            const activeButton = document.querySelector(`.tab-btn[onclick="showSection('${sectionId}')"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }
    </script>
</body>

</html>