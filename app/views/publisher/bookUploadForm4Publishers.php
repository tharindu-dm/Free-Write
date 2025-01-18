<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Add a new book on Free Write">
  <title>Add a New Book - Free Write</title>
  <style>
    .form-container {
      max-width: 800px;
      width: 60%;
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

    .form-group {
      display: flex;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .form-field {
      flex: 1;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #1C160C;
    }

    input,
    select {
      width: 100%;
      padding: 1rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
      background-color: #FCFAF5;
    }

    input:focus,
    select:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
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

    button {
      padding: 1rem 1.5rem;
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

    .submit-button {
      width: 100%;
      background-color: #FFD052;
      color: #1C160C;
      margin-top: 1rem;
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

    .submit-button:hover {
      background-color: #E0B94A;
    }

    .optional-section button {
      background-color: #FFFFFF;
      border: 2px solid #FFD700;
      color: #1C160C;
    }

    footer {
      margin-top: auto;
      text-align: center;
      padding: 1.5rem;
      background-color: #FFFFFF;
      color: #c47c15;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {

      .form-container {
        margin: 1rem;
        padding: 1rem;
      }

      .form-group {
        flex-direction: column;
        gap: 0;
      }
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
  ?>

  <div class="form-container">
    <h1>Add a New Book</h1>
    <h4>Enter the details for your book</h4>

    <form action="/Free-Write/public/PublisherBooks/BookUpload" method="POST" onsubmit="return validateForm()">
      <div class="form-field">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter title" required>
      </div>

      <div class="form-group">
        <div class="form-field">
          <label for="author_name">Author</label>
          <input type="text" id="author_name" name="author_name" placeholder="Enter author" required>
        </div>
        <div class="form-field">
          <label for="contributor_name">Contributor</label>
          <input type="text" id="contributor_name" name="contributor_name" placeholder="Enter contributor">
        </div>
      </div>

      <div class="form-field">
        <label for="genre">Genre</label>
        <select id="genre" name="genre" required>
          <option value="">Select genre</option>
          <option value="fiction">Fiction</option>
          <option value="non-fiction">Non-fiction</option>
          <option value="biography">Biography</option>
        </select>
      </div>

      <div class="form-group">
        <div class="form-field">
          <label for="publication_year">Publication Year</label>
          <input type="number" id="publication_year" name="publication_year" placeholder="Enter publication year" required>
        </div>
        <div class="form-field">
          <label for="isbnID">ISBN</label>
          <input type="text" id="isbnID" name="isbnID" placeholder="Enter ISBN" required>
        </div>
      </div>

      <div class="optional-section">
        <h3>Add Author Profile</h3>
        <p>If the author is in our platform, please add their profile link.</p>
        <button type="button">Add Link</button>
      </div>

      <div class="optional-section">
        <h3>Add Cover Image</h3>
        <p>JPG or PNG, 2MB max</p>
        <button type="button">Upload Image</button>
      </div>

      <button type="submit" class="submit-button">Submit</button>
    </form>
  </div>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>