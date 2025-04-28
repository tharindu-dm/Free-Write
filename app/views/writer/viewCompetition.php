<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Competition | Free Write</title>
  <link rel="stylesheet" href="/Free-Write/public/css/writerViewCompetition.css">
</head>

<body>
  <?php
  require_once "../app/views/layout/header-user.php";
  ?>

  <!-- Main Content -->
  <main class="competition-section">
    <div class="competition-info">
      <div class="form-layout">
        <!-- Left Column -->
        <div class="left-column">
          <h1 class="competition-title"><?= htmlspecialchars($competition['title']); ?></h1>
          <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700;" />

          <p class="competition-description"><?= htmlspecialchars($competition['description']); ?></p>

          <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700;" />

          <div class="prize-section">
            <h3 class="prize-amount"><?= htmlspecialchars($competition['first_prize']); ?></h3>
          </div>

          <?php if ($competition['status'] === 'ended'): ?>
            <div class="date-info ended">Competition Ended</div>
          <?php else: ?>
            <div class="date-info active">End Date: <?= date('F j, Y', strtotime($competition['end_date'])); ?></div>
          <?php endif; ?>
        </div>

        <!-- Right Column (Cover Image) -->
        <div class="right-column">
          <div class="coverComp">
            <img src="/Free-Write/app/images/competition/coverComp.png" alt="Competition Cover">
          </div>
        </div>
      </div>

      <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700;" />

      <!-- Centered Buttons -->
      <div class="button-container">
        <button type="button" class="edit-btn cancel-btn"
          onclick="window.location.href='/Free-Write/public/Writer/Competitions/'">Back</button>
        <div class="right-buttons">
          <button class="edit-btn"
            onclick="window.location.href='/Free-Write/public/Writer/editCompetition/<?= htmlspecialchars($competition['competitionID']); ?>'">Edit</button>
          <button class="edit-btn"
            onclick="window.location.href='/Free-Write/public/Writer/Submissions/<?= htmlspecialchars($competition['competitionID']); ?>'">View
            Submissions</button>
          <button class="delete-btn" id="delete-details">Delete</button>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Overlay -->
    <div class="deleteOverlay-container">
      <div class="deleteOverlay">
        <h2>Are you sure you want to delete this Competition?</h2>
        <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700;" />
        <form
          action="/Free-Write/public/Writer/deleteCompetition/<?= htmlspecialchars($competition['competitionID']); ?>"
          method="POST">
          <div class="right-buttons">
            <button class="delete-btn" type="submit">Yes, Delete</button>
            <button class="edit-btn" type="button" id="cancelDelete">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script>
    // JavaScript to handle delete overlay
    document.addEventListener('DOMContentLoaded', function () {
      const deleteBtn = document.getElementById('delete-details');
      const cancelDelete = document.getElementById('cancelDelete');
      const deleteOverlay = document.querySelector('.deleteOverlay-container');

      deleteBtn.addEventListener('click', function () {
        deleteOverlay.classList.add('show-overlay');
      });

      cancelDelete.addEventListener('click', function () {
        deleteOverlay.classList.remove('show-overlay');
      });
    });
  </script>

  <!-- Footer -->
  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>