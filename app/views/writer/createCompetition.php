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
  
  ?>

  <!-- Main Content -->
  <main class="book-section">
    <div class="competition-info">
      <form action="/Free-Write/public/Writer/createCompetition" method="POST" enctype="multipart/form-data">
        <h1>Create a Competition</h1>
        <p>Invite designers to submit their best book cover designs at competitive prices.</p>
        <div class="form-layout">
          <!-- Left: Input Fields -->
          <div class="book-info">
            <div class="input-group">
              <label for="title">Title</label>
              <input type="text" maxlength="45" id="title" name="title" placeholder="Title" required>
            </div>

            <div class="input-group">
              <label for="Description">Description</label>
              <textarea id="Description" maxlength="255" name="Description" placeholder="Description"
                required></textarea>
            </div>

            <div class="input-group">
              <label for="price">Price (LKR)</label>
              <input type="number" min="0" id="price" name="price" placeholder="Price" required>
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
          <button type="submit" class="create-btn">Create</button>
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