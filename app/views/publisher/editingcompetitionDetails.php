<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Edit a competition on Free Write">
  <title>Edit Competition</title>
  <style>
    :root {
      --gold: #FFD700;
      --gold-light: rgba(255, 215, 0, 0.05);
      --gold-medium: rgba(255, 215, 0, 0.2);
      --orange: #c47c15;
      --dark: #1C160C;
      --cream: #FCFAF5;
      --white: #FFFFFF;
      --red: #dc3545;
    }

    .form-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2.5rem;
      background-color: var(--white);
      border-radius: 1rem;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      border: 1px solid var(--gold);
    }

    .form-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-header h1 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--dark);
    }

    .form-header h4 {
      color: var(--orange);
      font-weight: 500;
      font-size: 1.1rem;
    }

    .form-section {
      margin-bottom: 2rem;
      background-color: var(--gold-light);
      padding: 1.5rem;
      border-radius: 1rem;
      border: 1px solid var(--gold);
    }

    .form-section h3 {
      margin-bottom: 1rem;
      color: var(--orange);
      font-size: 1.3rem;
      position: relative;
      padding-bottom: 0.5rem;
    }

    .form-section h3:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 0.1rem;
      background-color: var(--gold);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group:last-child {
      margin-bottom: 0;
    }

    label {
      display: block;
      margin-bottom: 0.6rem;
      font-weight: 600;
      color: var(--dark);
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 2px solid var(--gold);
      border-radius: 0.5rem;
      font-size: 1rem;
      transition: all 0.3s ease;
      background-color: var(--white);
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: var(--orange);
      box-shadow: 0 0 0 3px var(--gold-medium);
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 2rem;
    }

    .button-group button {
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.2s ease;
      flex: 1;
    }

    .button-group button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
      background-color: var(--gold);
      color: var(--dark);
    }

    .submit-btn:hover {
      background-color: #E0B94A;
    }

    .cancel-btn {
      background-color: var(--orange);
      color: white;
    }

    .cancel-btn:hover {
      background-color: #AA6A10;
    }

    .delete-btn {
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.2s ease;
      flex: 1;
      background-color: #FF5A5A;
      color: white;
      margin-top: 1rem;
    }

    .delete-btn:hover {
      background-color: #E04545;
    }

    .file-upload {
      padding: 1.5rem;
      border: 2px dashed var(--gold);
      border-radius: 0.5rem;
      text-align: center;
      background-color: var(--gold-light);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .file-upload:hover {
      background-color: var(--gold-medium);
    }

    .file-upload p {
      color: var(--orange);
      margin: 0.5rem 0;
    }

    .file-upload input[type="file"] {
      display: none;
    }

    .file-upload-label {
      display: inline-block;
      padding: 0.5rem 1rem;
      background-color: var(--white);
      border: 1px solid var(--gold);
      border-radius: 0.5rem;
      cursor: pointer;
      font-weight: 500;
      margin-top: 0.5rem;
    }

    .error-message {
      color: var(--red);
      font-size: 0.875rem;
      margin-top: 0.5rem;
      display: none;
    }

    .horizontal-divider {
      margin: 2rem 0;
      border: 0.1rem solid var(--gold);
      border-radius: 0.05rem;
    }

    .deleteOverlay-container {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .deleteOverlay {
      width: 90%;
      max-width: 500px;
      background-color: var(--white);
      padding: 2rem;
      border-radius: 1rem;
      z-index: 1001;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      border: 1px solid var(--gold);
    }

    .deleteOverlay h2 {
      color: var(--red);
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .deleteOverlay .form-group {
      margin-bottom: 1rem;
    }

    .deleteOverlay-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 2rem;
      gap: 1rem;
    }

    #deleteCompetition_Agree {
      background-color: var(--red);
      color: white;
      flex: 1;
    }

    #deleteCompetition_Agree:hover {
      background-color: #c82333;
    }

    #cancelDelete {
      background-color: #6c757d;
      color: white;
      flex: 1;
    }

    @media (max-width: 768px) {
      .form-container {
        margin: 1rem;
        padding: 1.5rem;
      }

      .button-group {
        flex-direction: column;
      }

      button {
        width: 100%;
      }
    }

    .prizes-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
    }

    @media (max-width: 600px) {
      .prizes-grid {
        grid-template-columns: 1fr;
      }
    }

    .dates-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }

    @media (max-width: 600px) {
      .dates-grid {
        grid-template-columns: 1fr;
      }
    }

    .custom-file-input {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }

    .file-name {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: var(--orange);
      text-align: center;
    }
  </style>
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php"; ?>

  <main>
    <div class="form-container">
      <div class="form-header">
        <h1>Edit Competition</h1>
        <h4>Update the details for your competition</h4>
      </div>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message"
          style="display: block; margin-bottom: 1.5rem; text-align: center; padding: 0.75rem; background-color: #ffe6e6; border: 1px solid #ffcccc; border-radius: 0.5rem;">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php endif; ?>

      <form action="/Free-Write/public/Competition/editCompetition" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">
        <input type="hidden" name="compID" value="<?= htmlspecialchars($competitionDetails['competitionID']) ?>">

        <div class="form-section">
          <h3>Basic Information</h3>

          <div class="form-group">
            <label for="title">Competition Name</label>
            <input type="text" maxlength="45" id="title" name="title" placeholder="Enter competition name"
              value="<?= htmlspecialchars($competitionDetails['title']) ?>" required />
            <div id="title_error" class="error-message"></div>
          </div>

          <div class="form-group">
            <label for="description">Competition Description</label>
            <textarea id="description" name="description" placeholder="Describe your competition"
              required><?= htmlspecialchars($competitionDetails['description']) ?></textarea>
            <div id="description_error" class="error-message"></div>
          </div>

          <div class="form-group">
            <label for="rules">Judging Criteria</label>
            <textarea id="rules" name="rules" placeholder="Enter your competition judging criteria"
              required><?= htmlspecialchars($competitionDetails['rules'] ?? '') ?></textarea>
            <div id="rules_error" class="error-message"></div>
          </div>
        </div>

        <div class="form-section">
          <h3>Competition Settings</h3>

          <div class="form-group">
            <label for="type">Competition For</label>
            <select id="type" name="type" required>
              <option value="writer" <?= $competitionDetails['type'] === 'writer' ? 'selected' : '' ?>>Writer</option>
              <option value="CoverDesigners" <?= $competitionDetails['type'] === 'CoverDesigners' ? 'selected' : '' ?>>
                Cover Designers</option>
            </select>
          </div>

          <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" maxlength="45" name="category" placeholder="Enter category"
              value="<?= htmlspecialchars($competitionDetails['category']) ?>" required />
            <div id="category_error" class="error-message"></div>
          </div>
        </div>

        <div class="form-section">
          <h3>Prize Information</h3>

          <div class="prizes-grid">
            <div class="form-group">
              <label for="first_prize">First Prize Amount</label>
              <input type="number" id="first_prize" name="first_prize" placeholder="Enter first prize amount"
                value="<?= htmlspecialchars($competitionDetails['first_prize'] ?? $competitionDetails['prizes']) ?>"
                required min="0" step="0.01" />
              <div id="first_prize_error" class="error-message"></div>
            </div>

            <div class="form-group">
              <label for="second_prize">Second Prize Amount</label>
              <input type="number" id="second_prize" name="second_prize" placeholder="Enter second prize amount"
                value="<?= htmlspecialchars($competitionDetails['second_prize'] ?? 0) ?>" required min="0"
                step="0.01" />
              <div id="second_prize_error" class="error-message"></div>
            </div>

            <div class="form-group">
              <label for="third_prize">Third Prize Amount</label>
              <input type="number" id="third_prize" name="third_prize" placeholder="Enter third prize amount"
                value="<?= htmlspecialchars($competitionDetails['third_prize'] ?? 0) ?>" required min="0" step="0.01" />
              <div id="third_prize_error" class="error-message"></div>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3>Competition Dates</h3>

          <div class="dates-grid">
            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input type="date" id="start_date" name="start_date"
                value="<?= htmlspecialchars($competitionDetails['start_date']) ?>" required />
              <div id="start_date_error" class="error-message"></div>
            </div>

            <div class="form-group">
              <label for="end_date">End Date</label>
              <input type="date" id="end_date" name="end_date"
                value="<?= htmlspecialchars($competitionDetails['end_date']) ?>" required />
              <div id="end_date_error" class="error-message"></div>
            </div>
          </div>
        </div>

        <div class="form-section">
          <h3>Competition Image</h3>

          <div class="custom-file-input">
            <div class="file-upload">
              <p>Update competition image (Optional)</p>
              <p><small>JPG or PNG, 2MB max</small></p>
              <label for="competition_image" class="file-upload-label">Choose File</label>
              <input type="file" id="competition_image" name="competition_image" accept="image/jpeg,image/png"
                onchange="updateFileName(this)" />
            </div>
            <div id="file-name" class="file-name">No file chosen</div>
          </div>
        </div>

        <hr class="horizontal-divider">

        <div class="button-group">
          <button type="button" class="cancel-btn"
            onclick="location.href='/Free-Write/public/Competition/'">Cancel</button>
          <button type="submit" class="submit-btn">Save Changes</button>
        </div>

        <button type="button" id="DeleteCompetition" class="delete-btn">Delete Competition</button>
      </form>
    </div>
  </main>

  <div class="deleteOverlay-container">
    <div class="deleteOverlay">
      <h2>Delete Competition</h2>
      <p>Are you sure you want to delete this competition? This action cannot be undone.</p>

      <form action="/Free-Write/public/Competition/deleteCompetition" method="POST">
        <input type="hidden" name="compID" value="<?= htmlspecialchars($competitionDetails['competitionID']) ?>">

        <div class="form-group">
          <label for="compID-label">Competition ID</label>
          <input type="text" id="compID-label" disabled
            value="<?= htmlspecialchars($competitionDetails['competitionID']) ?>">
        </div>

        <div class="form-group">
          <label for="title-label">Competition Name</label>
          <input id="title-label" type="text" disabled value="<?= htmlspecialchars($competitionDetails['title']) ?>">
        </div>

        <div class="deleteOverlay-buttons">
          <button type="button" id="cancelDelete">Cancel</button>
          <button type="submit" id="deleteCompetition_Agree">Yes, Delete</button>
        </div>
      </form>
    </div>
  </div>

  <?php require_once "../app/views/layout/footer.php"; ?>

  <script>
    function countWords(str) {
      return str.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    function updateFileName(input) {
      const fileNameDisplay = document.getElementById('file-name');
      if (input.files && input.files[0]) {
        fileNameDisplay.textContent = input.files[0].name;
      } else {
        fileNameDisplay.textContent = 'No file chosen';
      }
    }

    function validateForm() {
      let isValid = true;
      const errorMessages = {
        title: document.getElementById('title_error'),
        category: document.getElementById('category_error'),
        description: document.getElementById('description_error'),
        rules: document.getElementById('rules_error'),
        firstPrize: document.getElementById('first_prize_error'),
        secondPrize: document.getElementById('second_prize_error'),
        thirdPrize: document.getElementById('third_prize_error'),
        startDate: document.getElementById('start_date_error'),
        endDate: document.getElementById('end_date_error')
      };


      Object.values(errorMessages).forEach(elem => {
        if (elem) elem.style.display = 'none';
      });


      const title = document.getElementById('title').value;
      if (/\d/.test(title)) {
        errorMessages.title.textContent = 'Competition name cannot contain numbers';
        errorMessages.title.style.display = 'block';
        isValid = false;
      }


      const category = document.getElementById('category').value;
      if (/\d/.test(category)) {
        errorMessages.category.textContent = 'Category cannot contain numbers';
        errorMessages.category.style.display = 'block';
        isValid = false;
      }


      const description = document.getElementById('description').value;
      const descriptionWordCount = countWords(description);
      if (descriptionWordCount < 5) {
        errorMessages.description.textContent = 'Description must be at least 5 words';
        errorMessages.description.style.display = 'block';
        isValid = false;
      } else if (descriptionWordCount > 100) {
        errorMessages.description.textContent = 'Description cannot exceed 100 words';
        errorMessages.description.style.display = 'block';
        isValid = false;
      }


      const rules = document.getElementById('rules').value;
      const rulesWordCount = countWords(rules);
      if (rulesWordCount < 5) {
        errorMessages.rules.textContent = 'Rules must be at least 5 words';
        errorMessages.rules.style.display = 'block';
        isValid = false;
      } else if (rulesWordCount > 100) {
        errorMessages.rules.textContent = 'Rules cannot exceed 100 words';
        errorMessages.rules.style.display = 'block';
        isValid = false;
      }


      const firstPrize = parseFloat(document.getElementById('first_prize').value);
      const secondPrize = parseFloat(document.getElementById('second_prize').value);
      const thirdPrize = parseFloat(document.getElementById('third_prize').value);

      if (isNaN(firstPrize) || isNaN(secondPrize) || isNaN(thirdPrize)) {
        errorMessages.firstPrize.textContent = 'All prize amounts must be valid numbers';
        errorMessages.firstPrize.style.display = 'block';
        isValid = false;
      } else if (firstPrize <= secondPrize || secondPrize <= thirdPrize) {
        errorMessages.firstPrize.textContent = 'First prize must be greater than second, and second greater than third';
        errorMessages.firstPrize.style.display = 'block';
        isValid = false;
      }


      const startDate = new Date(document.getElementById('start_date').value);
      const endDate = new Date(document.getElementById('end_date').value);
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      if (startDate < today) {
        errorMessages.startDate.textContent = 'Start date cannot be in the past';
        errorMessages.startDate.style.display = 'block';
        isValid = false;
      }

      if (endDate <= startDate) {
        errorMessages.endDate.textContent = 'End date must be at least one day after start date';
        errorMessages.endDate.style.display = 'block';
        isValid = false;
      }

      return isValid;
    }


    document.getElementById('title').addEventListener('input', function () {
      const errorElem = document.getElementById('title_error');
      if (/\d/.test(this.value)) {
        errorElem.textContent = 'Competition name cannot contain numbers';
        errorElem.style.display = 'block';
      } else {
        errorElem.style.display = 'none';
      }
    });

    document.getElementById('category').addEventListener('input', function () {
      const errorElem = document.getElementById('category_error');
      if (/\d/.test(this.value)) {
        errorElem.textContent = 'Category cannot contain numbers';
        errorElem.style.display = 'block';
      } else {
        errorElem.style.display = 'none';
      }
    });

    document.getElementById('description').addEventListener('input', function () {
      const errorElem = document.getElementById('description_error');
      const wordCount = countWords(this.value);
      if (wordCount < 5) {
        errorElem.textContent = 'Description must be at least 5 words';
        errorElem.style.display = 'block';
      } else if (wordCount > 100) {
        errorElem.textContent = 'Description cannot exceed 100 words';
        errorElem.style.display = 'block';
      } else {
        errorElem.style.display = 'none';
      }
    });

    document.getElementById('rules').addEventListener('input', function () {
      const errorElem = document.getElementById('rules_error');
      const wordCount = countWords(this.value);
      if (wordCount < 5) {
        errorElem.textContent = 'Rules must be at least 5 words';
        errorElem.style.display = 'block';
      } else if (wordCount > 100) {
        errorElem.textContent = 'Rules cannot exceed 100 words';
        errorElem.style.display = 'block';
      } else {
        errorElem.style.display = 'none';
      }
    });


    function validatePrizes() {
      const firstPrize = parseFloat(document.getElementById('first_prize').value);
      const secondPrize = parseFloat(document.getElementById('second_prize').value);
      const thirdPrize = parseFloat(document.getElementById('third_prize').value);
      const errorElem = document.getElementById('first_prize_error');

      if (isNaN(firstPrize) || isNaN(secondPrize) || isNaN(thirdPrize)) {
        errorElem.textContent = 'All prize amounts must be valid numbers';
        errorElem.style.display = 'block';
      } else if (firstPrize <= secondPrize || secondPrize <= thirdPrize) {
        errorElem.textContent = 'First prize must be greater than second, and second greater than third';
        errorElem.style.display = 'block';
      } else {
        errorElem.style.display = 'none';
      }
    }

    document.getElementById('first_prize').addEventListener('input', validatePrizes);
    document.getElementById('second_prize').addEventListener('input', validatePrizes);
    document.getElementById('third_prize').addEventListener('input', validatePrizes);


    const today = new Date();
    const todayFormatted = today.toISOString().split('T')[0];
    document.getElementById('start_date').setAttribute('min', todayFormatted);


    document.getElementById('start_date').addEventListener('change', function () {
      const startDate = new Date(this.value);
      const minEndDate = new Date(startDate);
      minEndDate.setDate(startDate.getDate() + 1);
      const minEndDateFormatted = minEndDate.toISOString().split('T')[0];

      const endDateInput = document.getElementById('end_date');
      endDateInput.setAttribute('min', minEndDateFormatted);

      if (endDateInput.value && new Date(endDateInput.value) <= startDate) {
        endDateInput.value = '';
      }
    });


    const deleteBtn = document.getElementById('DeleteCompetition');
    const deleteOverlay = document.querySelector('.deleteOverlay-container');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    deleteBtn.addEventListener('click', () => {
      deleteOverlay.style.display = 'flex';
    });

    cancelDeleteBtn.addEventListener('click', () => {
      deleteOverlay.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
      if (e.target === deleteOverlay) {
        deleteOverlay.style.display = 'none';
      }
    });
  </script>
</body>

</html>