<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite - Explore and Share Incredible Stories</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
    <?php
    // Check if user type exists in session, else set as guest
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }

    // Include different headers based on user type
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

    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                    <img src="../../app/images/profile/profile-image.jpg" alt="User Profile Image">
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
            
            
    
            <div class="spinoff-container">

    <!-- Navigation Tabs -->
    <div class="spinoff-nav">
        <button class="tab-btn active" onclick="showSection('pending')">Pending</button>
        <button class="tab-btn" onclick="showSection('accepted')">Accepted</button>
        <button class="tab-btn" onclick="showSection('rejected')">Rejected</button>
    </div>

    <!-- Pending Spinoff Requests Section -->
    <section id="pending" class="spinoff-section active">
  <h2>Pending Spinoff Requests</h2>
  <?php if (!empty($pendingSpinoffs)): ?>
    <ul class="spinoff-list">
      <?php foreach ($pendingSpinoffs as $pendingSpinoff): ?>
        <li class="spinoff-item">
          <a href="/Free-Write/public/Writer/ViewSpinoff/<?= htmlspecialchars($pendingSpinoff['spinoffID']); ?>" class="spinoff-link">
            <h3><?= htmlspecialchars($pendingSpinoff['SpinoffTitle']); ?></h3>
            <p>
              <strong><?= htmlspecialchars($pendingSpinoff['BookTitle']); ?></strong> |
              <?= htmlspecialchars($pendingSpinoff['ChapterTitle']); ?>
            </p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <div class="no-requests">
      <p>No pending spinoff requests available</p>
    </div>
  <?php endif; ?>
</section>

<!-- Accepted Spinoff Requests Section -->
<section id="accepted" class="spinoff-section">
  <h2>Accepted Spinoff Requests</h2>
  <?php if (!empty($acceptedSpinoffs)): ?>
    <ul class="spinoff-list">
      <?php foreach ($acceptedSpinoffs as $acceptedSpinoff): ?>
        <li class="spinoff-item">
          <a href="/Free-Write/public/Writer/ViewSpinoff/<?= htmlspecialchars($acceptedSpinoff['spinoffID']); ?>" class="spinoff-link">
            <h3><?= htmlspecialchars($acceptedSpinoff['SpinoffTitle']); ?></h3>
            <p>
              <strong><?= htmlspecialchars($acceptedSpinoff['BookTitle']); ?></strong> |
              <?= htmlspecialchars($acceptedSpinoff['ChapterTitle']); ?>
            </p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <div class="no-requests">
      <p>No accepted spinoff requests available</p>
    </div>
  <?php endif; ?>
</section>

<!-- Rejected Spinoff Requests Section -->
<section id="rejected" class="spinoff-section">
  <h2>Rejected Spinoff Requests</h2>
  <?php if (!empty($rejectedSpinoffs)): ?>
    <ul class="spinoff-list">
      <?php foreach ($rejectedSpinoffs as $rejectedSpinoff): ?>
        <li class="spinoff-item">
          <a href="/Free-Write/public/Writer/ViewSpinoff/<?= htmlspecialchars($rejectedSpinoff['spinoffID']); ?>" class="spinoff-link">
            <h3><?= htmlspecialchars($rejectedSpinoff['SpinoffTitle']); ?></h3>
            <p>
              <strong><?= htmlspecialchars($rejectedSpinoff['BookTitle']); ?></strong> |
              <?= htmlspecialchars($rejectedSpinoff['ChapterTitle']); ?>
            </p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <div class="no-requests">
      <p>No rejected spinoff requests available</p>
    </div>
  <?php endif; ?>
</section>
</div>

  </div>

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
