<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">

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
      <h1><?= htmlspecialchars($competition['title']); ?></h1>
      <p><?= htmlspecialchars($competition['description']); ?></p>
      <h3>Prize: <?= htmlspecialchars($competition['first_prize']); ?></h3>

      <?php if ($competition['status'] === 'ended'): ?>
        <h4>Competition Ended</h4>
      <?php else: ?>
        <h4>End Date: <?= htmlspecialchars($competition['end_date']); ?></h4>
      <?php endif; ?>
    </div>

    <!-- Right Column (Cover Image) -->
    <div class="right-column">
      <div class="coverComp">
        <img src="/Free-Write/app/images/competition/coverComp.png" alt="Competition Cover">
      </div>
    </div>
    </div>

  <!-- Centered Buttons -->
  <div class="button-container">
    <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
    <div class="right-buttons">
      <button class="edit-btn" onclick="window.location.href='/Free-Write/public/Writer/editCompetition/<?= htmlspecialchars($competition['competitionID']); ?>'">Edit</button>
      <button class="delete-btn" id="delete-details">Delete</button>
    </div>
</main>



<div class="deleteOverlay-container">
                <div class="deleteOverlay">
                    <h2>Are you sure you want to delete this Competition?</h2>
                    <form action="/Free-Write/public/Writer/deleteCompetition/<?= htmlspecialchars($competition['competitionID']); ?>" method="POST">                    
                        <div class="right-buttons">
                            <button class="read-button delete-btn" type="submit">Yes, Delete</button>
                            <button class="edit-btn" type="button" id="cancelDelete">Cancel</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

        
    </main>
    
    <script src="/Free-Write/public/js/writer/bookDetails.js"></script>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

