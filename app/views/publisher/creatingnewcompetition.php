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

  <?php
  if (isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
  } else {
    $userType = 'guest';
  }
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


      <form action="/Free-Write/public/Competition/CreateCompetition" method="POST" onsubmit="return validateForm()">
    <input type="hidden" name="compID" value="<?= htmlspecialchars($competitionDetails['competitionID']) ?>">
    
    <label for="title">Competition Name</label>
<<<<<<< HEAD
    <input type="text" maxlength="45" id="title" name="title" placeholder="Enter competition name" required />
    <div id="title_error" class="error-message"></div>
    
    <label for="description">Competition Description</label>
    <textarea id="description" maxlength="255" name="description" placeholder="Describe your competition" required></textarea>
    <div id="description_error" class="error-message"></div>
    
    <label for="rules">Rules</label>
    <input type="text" id="rules" maxlength="25" name="rules" placeholder="Enter competition rules" required />
    <div id="rules_error" class="error-message"></div>
    
    <label for="category">Category</label>
    <input type="text" id="category" maxlength="45" name="category" placeholder="Enter category" required />
=======
    <input type="text" id="title" name="title" placeholder="Enter competition name" required />
    <div id="title_error" class="error-message"></div>
    
    <label for="description">Competition Description</label>
    <textarea id="description" name="description" placeholder="Describe your competition" required></textarea>
    <div id="description_error" class="error-message"></div>
    
    <label for="rules">Rules</label>
    <input type="text" id="rules" name="rules" placeholder="Enter competition rules" required />
    <div id="rules_error" class="error-message"></div>
    
    <label for="category">Category</label>
    <input type="text" id="category" name="category" placeholder="Enter category" required />
>>>>>>> 7a59bea (navigation changes , and competition CRUD based on publisherID, create for adding books)
    <div id="category_error" class="error-message"></div>
    
    <label for="prizes">Prize Amount</label>
    <input type="number" id="prizes" name="prizes" placeholder="Enter prize amount" required min="0" step="0.01" />
    
    <label for="start_date">Start Date</label>
    <input type="date" id="start_date" name="start_date" required />
    <div id="start_date_error" class="error-message"></div>
    
    <label for="end_date">End Date</label>
    <input type="date" id="end_date" name="end_date" required />
    <div id="end_date_error" class="error-message"></div>
    
    <!-- <div class="optional-section">
        <h3>Add Competition Image</h3>
        <p>JPG or PNG, 2MB max</p>
        <input type="file" name="competition_image" accept="image/jpeg,image/png" />
    </div> -->
    
    <button type="submit" class="submit-btn">Create Competition</button>
    <button type="button" class="cancel-btn" onclick="location.href='/Free-Write/public/Competition/'">Cancel</button>
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
    if (countWords(description) < 5) {
        errorMessages.description.textContent = 'Description must be at least 10 words';
        errorMessages.description.style.display = 'block';
        isValid = false;
    }

    // Rules Validation
    const rules = document.getElementById('rules').value;
    if (countWords(rules) < 5) {
        errorMessages.rules.textContent = 'Rules must be at least 10 words';
        errorMessages.rules.style.display = 'block';
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
document.getElementById('title').addEventListener('input', function() {
    const errorElem = document.getElementById('title_error');
    if (/\d/.test(this.value)) {
        errorElem.textContent = 'Competition name cannot contain numbers';
        errorElem.style.display = 'block';
    } else {
        errorElem.style.display = 'none';
    }
});

document.getElementById('category').addEventListener('input', function() {
    const errorElem = document.getElementById('category_error');
    if (/\d/.test(this.value)) {
        errorElem.textContent = 'Category cannot contain numbers';
        errorElem.style.display = 'block';
    } else {
        errorElem.style.display = 'none';
    }
});

document.getElementById('description').addEventListener('input', function() {
    const errorElem = document.getElementById('description_error');
    if (countWords(this.value) < 5) {
        errorElem.textContent = 'Description must be at least 10 words';
        errorElem.style.display = 'block';
    } else {
        errorElem.style.display = 'none';
    }
});

document.getElementById('rules').addEventListener('input', function() {
    const errorElem = document.getElementById('rules_error');
    if (countWords(this.value) < 5) {
        errorElem.textContent = 'Rules must be at least 10 words';
        errorElem.style.display = 'block';
    } else {
        errorElem.style.display = 'none';
    }
});

// Set minimum date for start date (today)
const today = new Date();
const todayFormatted = today.toISOString().split('T')[0];
document.getElementById('start_date').setAttribute('min', todayFormatted);

// Update minimum date for end date when start date changes
document.getElementById('start_date').addEventListener('change', function() {
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
