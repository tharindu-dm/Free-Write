<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a Competition - Free Write</title>
  <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php";
  //show($data);
  ?>

  <!-- Main Content -->
  <main class="book-section">
    <div class="competition-info">
      <form action="/Free-Write/public/Writer/updateCompetition" method="POST" enctype="multipart/form-data">
        <h1>Update Competition</h1>
        <p>Invite designers to submit their best book cover designs at competitive prices.</p>

        <input type="hidden" name="cID" value="<?= $competition['competitionID']; ?>">

        <div class="form-layout">
          <!-- Left: Input Fields -->
          <div class="book-info">
            <div class="input-group">
              <label for="title">Title</label>
              <input type="text" maxlength="45" id="title" name="title" placeholder="Book Title"
                value="<?= htmlspecialchars($competition['title']); ?>" required>
            </div>

            <div class="input-group">
              <label for="Description">Description</label>
              <textarea id="Description" name="Description" maxlength="255" placeholder="Description"
                required><?= htmlspecialchars($competition['description']); ?></textarea>
            </div>

            <div class="input-group">
              <label for="price">Price (LKR)</label>
              <input type="number" min="0" id="price" name="price" placeholder="Price"
                value="<?= htmlspecialchars($competition['first_prize'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <p>*The competition expires two months after its creation date.</p>
          </div>

          <!-- Right: Book Cover -->
          <div class="coverComp">
            <img src="/Free-Write/app/images/competition/coverComp.png" alt="Competition Cover">
          </div>
        </div>

        <!-- Bottom Center: Buttons -->
        <div class="right-buttons">
          <button type="button" class="edit-btn cancel-btn" onclick="window.history.back();">Back</button>
          <button type="submit" class="create-btn">Update</button>
        </div>
      </form>
    </div>
  </main>


  <!-- Footer -->
  <?php
  // Including the footer
  require_once "../app/views/layout/footer.php";
  ?>

</body>

</html>