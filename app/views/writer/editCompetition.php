<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Competition | Free Write</title>
  <style>
    .book-section {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 1rem;
      background: rgba(255, 215, 0, 0.05);
      border: #ffd700 solid 1px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .competition-info {
      width: 100%;
    }

    .competition-info h1 {
      font-size: 2.2rem;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .competition-info>p {
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      color: #555;
    }

    .form-layout {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      margin: 2rem 0;
    }

    .book-info {
      flex: 1;
      min-width: 300px;
    }

    .coverComp {
      flex: 0 0 300px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .coverComp img {
      width: 100%;
      max-width: 300px;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      border: #ffd700 solid 1px;
    }

    .input-group {
      margin-bottom: 1.5rem;
    }

    .input-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: #444;
    }

    .input-group input,
    .input-group textarea {
      width: 100%;
      padding: 0.75rem;
      border-radius: 0.5rem;
      border: 1px solid #ddd;
      background-color: #fff;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input-group input:focus,
    .input-group textarea:focus {
      outline: none;
      border-color: #ffd700;
      box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
    }

    .input-group textarea {
      min-height: 150px;
      resize: vertical;
    }

    .notice {
      font-size: 0.9rem;
      color: #666;
      font-style: italic;
      margin-top: 1rem;
    }

    .right-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 2rem;
    }

    .right-buttons button {
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .cancel-btn {
      background: rgba(108, 117, 125, 0.1);
      border: 1px solid #6c757d;
      color: #6c757d;
    }

    .cancel-btn:hover {
      background: rgba(108, 117, 125, 0.2);
      transform: translateY(-2px);
    }

    .create-btn,
    .edit-btn {
      background: rgba(255, 215, 0, 0.1);
      border: #ffd700 solid 1px;
      color: #333;
    }

    .create-btn:hover,
    .edit-btn:hover {
      background: rgba(255, 215, 0, 0.2);
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
    }

    @media (max-width: 768px) {
      .form-layout {
        flex-direction: column;
      }

      .coverComp {
        order: -1;
        margin-bottom: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php"; ?>

  <main class="book-section">
    <div class="competition-info">
      <form action="/Free-Write/public/Writer/updateCompetition" method="POST" enctype="multipart/form-data">
        <h1>Update Competition</h1>
        <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700;" />
        <p>Invite designers to submit their best book cover designs at competitive prices.</p>

        <input type="hidden" name="cID" value="<?= $competition['competitionID']; ?>">

        <div class="form-layout">
          <div class="book-info">
            <div class="input-group">
              <label for="title">Title</label>
              <input type="text" maxlength="45" id="title" name="title" placeholder="Competition Title"
                value="<?= htmlspecialchars($competition['title']); ?>" required>
            </div>

            <div class="input-group">
              <label for="Description">Description</label>
              <textarea id="Description" name="Description" maxlength="255"
                placeholder="Describe your competition requirements in detail"
                required><?= htmlspecialchars($competition['description']); ?></textarea>
            </div>

            <div class="input-group">
              <label for="price">Prize Amount (LKR)</label>
              <input type="number" min="0" id="price" name="price" placeholder="Prize amount for winner"
                value="<?= htmlspecialchars($competition['first_prize'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <p class="notice">*The competition expires two months after its creation date.</p>
          </div>

          <div class="coverComp">
            <img src="/Free-Write/app/images/competition/coverComp.png" alt="Competition Cover">
          </div>
        </div>

        <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700;" />

        <div class="right-buttons">
          <button type="button" class="cancel-btn" onclick="window.history.back();">Cancel</button>
          <button type="submit" class="create-btn">Update Competition</button>
        </div>
      </form>
    </div>
  </main>

  <?php require_once "../app/views/layout/footer.php"; ?>

</body>

</html>