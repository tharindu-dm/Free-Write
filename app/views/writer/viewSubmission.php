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
      <h1>Last of it</h1>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>


        <h4>Submitted by : James Smith</h4>
    </div>

    <!-- Right Column (Cover Image) -->
    <div class="right-column">
      <div class="coverComp">
        <img src="/Free-Write/app/images/competition/coverComp.png" alt="Competition Cover">
      </div>
    </div>
    </div>
    <div class="button-container">
    <button type="button" class="edit-btn cancel-btn" onclick="window.location.href='/Free-Write/public/Writer/Submissions/<?= htmlspecialchars($competition['competitionID']); ?>'">Back</button>
    <div class="right-buttons">
      <button class="edit-btn" onclick="window.location.href='/Free-Write/public/Writer/Win/<?= htmlspecialchars($submission['covID']); ?>'">Choose As Winner</button>
    </div>
    </div>
    </main>

    <!-- Footer -->
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>

