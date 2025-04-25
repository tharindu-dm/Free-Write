<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Create a new competition on Free Write">
  <title>Create Competition</title>
  <style>
    .form-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      color: #1C160C;
    }

    .form-container h4 {
      color: #c47c15;
      margin-bottom: 2rem;
      font-weight: 500;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #1C160C;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 1rem;
      margin-bottom: 1.5rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
      background-color: #FCFAF5;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    textarea {
      min-height: 150px;
      resize: vertical;
    }

    button {
      padding: 1rem 1.5rem;
      margin-right: 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
      background-color: #FFD052;
      color: #1C160C;
    }

    .submit-btn:hover {
      background-color: #E0B94A;
    }

    .cancel-btn {
      background-color: #c47c15;
      color: white;
    }

    .cancel-btn:hover {
      background-color: #7A6F50;
    }

    .optional-section {
      padding: 1.5rem;
      border: 2px dashed #FFD700;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      text-align: center;
      background-color: #FCFAF5;
    }

    .optional-section h3 {
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #1C160C;
    }

    .optional-section p {
      color: #c47c15;
      margin-bottom: 1rem;
    }

    .optional-section button {
      background-color: #FFFFFF;
      border: 2px solid #FFD700;
      color: #1C160C;
    }

    .user-actions {
      display: flex;
      align-items: center;
    }

    .icon-button {
      background: none;
      border: none;
      cursor: pointer;
      margin: 0 10px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    @media (max-width: 768px) {
      .form-container {
        margin: 1rem;
        padding: 1rem;
      }

      button {
        width: 100%;
        margin: 0.5rem 0;
      }
    }

    .error-message {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: -1rem;
      margin-bottom: 1rem;
      display: none;
    }
  </style>
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php";
  //show($data);
  ?>

  <main>
    <div class="form-container">
      <h1>Create a New Competition</h1>
      <h4>Set up the details for your competition</h4>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php endif; ?>

      <form action="/Free-Write/public/Competition/CreateCompetition" method="POST" enctype="multipart/form-data"
        onsubmit="return validateForm()">

        <input type="hidden" name="compID" value="<?= htmlspecialchars($competitionDetails['competitionID']) ?>">

        <label for="title">Competition Name</label>
        <input type="text" maxlength="45" id="title" name="title" placeholder="Enter competition name" required />
        <div id="title_error" class="error-message"></div>

        <label for="description">Competition Description</label>
        <textarea id="description" name="description" placeholder="Describe your competition" required></textarea>
        <div id="description_error" class="error-message"></div>

        <label for="rules">Judging Criteria</label>
        <textarea id="rules" name="rules" placeholder="Enter your competition judging criteria" required></textarea>
        <div id="rules_error" class="error-message"></div>

        <label for="type">Competition For</label>
        <select id="type" name="type" required>
          <option value="writer">Writer</option>
          <option value="CoverDesigners">Cover Designers</option>
        </select>

        <label for="category">Category</label>
        <input type="text" id="category" maxlength="45" name="category" placeholder="Enter category" required />
        <div id="category_error" class="error-message"></div>

        <label for="first_prize">Prize Amount</label>
        <input type="number" id="first_prize" name="first_prize" placeholder="Enter first prize amount" required
          min="0" />
        <div id="first_prize_error" class="error-message"></div>

        <label for="second_prize">Second Prize Amount</label>
        <input type="number" id="second_prize" name="second_prize" placeholder="Enter second prize amount" required
          min="0" />
        <div id="second_prize_error" class="error-message"></div>

        <label for="third_prize">Third Prize Amount</label>
        <input type="number" id="third_prize" name="third_prize" placeholder="Enter third prize amount" required min="0"
          step="0.01" />
        <div id="third_prize_error" class="error-message"></div>

        <label for="start_date">Start Date</label>
        <input type="date" id="start_date" name="start_date" required />
        <div id="start_date_error" class="error-message"></div>

        <label for="end_date">End Date</label>
        <input type="date" id="end_date" name="end_date" required />
        <div id="end_date_error" class="error-message"></div>



        <h3>Add Competition Image</h3>
        <p>JPG or PNG, 2MB max</p>
        <input type="file" name="competition_image" accept="image/jpeg,image/png" />

        <button type="submit" class="submit-btn">Create Competition</button>
        <button type="button" class="cancel-btn"
          onclick="location.href='/Free-Write/public/Competition/'">Cancel</button>
      </form>
    </div>
  </main>
  <?php require_once "../app/views/layout/footer.php"; ?>

  <script>
    function countWords(str) {
      return str.trim().split(/\s+/).filter(word => word.length > 0).length;
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

      // Reset all error messages
      Object.values(errorMessages).forEach(elem => {
        if (elem) elem.style.display = 'none';
      });

      // Competition Name Validation
      const title = document.getElementById('title').value;
      if (/\d/.test(title)) {
        errorMessages.title.textContent = 'Competition name cannot contain numbers';
        errorMessages.title.style.display = 'block';
        isValid = false;
      }

      // Category Validation
      const category = document.getElementById('category').value;
      if (/\d/.test(category)) {
        errorMessages.category.textContent = 'Category cannot contain numbers';
        errorMessages.category.style.display = 'block';
        isValid = false;
      }

      // Description Validation
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

      // Rules Validation
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

      // Prize Validation
      const firstPrize = parseFloat(document.getElementById('first_prize').value);
      const secondPrize = parseFloat(document.getElementById('second_prize').value);
      const thirdPrize = parseFloat(document.getElementById('third_prize').value);

      if (isNaN(firstPrize) || isNaN(secondPrize) || isNaN(thirdPrize)) {
        errorMessages.firstPrize.textContent = 'All prize amounts must be valid numbers';
        errorMessages.firstPrize.style.display = 'block';
        isValid = false;
      } else if (firstPrize <= secondPrize || secondPrize <= thirdPrize) {
        errorMessages.firstPrize.textContent = 'First prize must be greater than second, and second prize must be greater than third';
        errorMessages.firstPrize.style.display = 'block';
        isValid = false;
      }

      // Date Validations
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

    // Real-time validation for text inputs
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

    // Real-time validation for prize inputs
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

    // Set minimum date for start date (today)
    const today = new Date();
    const todayFormatted = today.toISOString().split('T')[0];
    document.getElementById('start_date').setAttribute('min', todayFormatted);

    // Update minimum date for end date when start date changes
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
  </script>
</body>

</html>