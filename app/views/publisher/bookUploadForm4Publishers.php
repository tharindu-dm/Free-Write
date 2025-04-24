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
      width: 90%;
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
    select,
    textarea {
      width: 100%;
      padding: 1rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
      background-color: #FCFAF5;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
      min-height: 100px;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
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

    .submit-button:hover {
      background-color: #E0B94A;
    }

    .form-field input[type="file"] {
      padding: 0.8rem;
      background-color: #FCFAF5;
      border: 2px solid #FFD700;
      border-radius: 8px;
      width: 100%;
    }

    .description {
      color: #c47c15;
      font-size: 0.9rem;
      margin-top: 0.5rem;
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

    <form action="/Free-Write/public/Publisher/BookUpload" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      <div class="form-field">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter title" required>
      </div>

      <div class="form-group">
        <div class="form-field">
          <label for="author">Author</label>
          <input type="text" id="author" name="author_name" placeholder="Enter author" required>
        </div>
        <div class="form-field">
          <label for="contributor">Contributor</label>
          <input type="text" id="contributor" name="contributor_name" placeholder="Enter contributor">
        </div>
      </div>

      <div class="form-field">
        <label for="synopsis">Synopsis of the Book</label>
        <textarea id="synopsis" name="synopsis" placeholder="Enter the synopsis of the book" maxlength="1000" required></textarea>
        <p class="description">Max 1000 characters</p>
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

      <div class="form-field">
        <label for="prize">Prize</label>
        <input type="text" id="prize" name="prize" placeholder="Enter the prize of the book (e.g., 19.99)" required pattern="\d+(\.\d{1,2})?" title="Enter a valid price (e.g., 19.99)">
      </div>

      <div class="form-group">
        <div class="form-field">
          <label for="publication-year">Publication Year</label>
          <input type="number" id="publication-year" name="publication_year" placeholder="Enter publication year" min="1500" max="<?= date('Y') ?>" required>
        </div>
        <div class="form-field">
          <label for="isbn">ISBN</label>
          <input type="text" id="isbn" name="isbnID" placeholder="Enter ISBN" required >
           <!-- pattern="\d{10}|\d{13}" title="ISBN must be 10 or 13 digits" -->
        </div>
      </div>

      <div class="form-field">
        <label for="bookCover">Book Cover Image</label>
        <input type="file" id="bookCover" name="bookCover" accept="image/jpeg,image/png" required>
        <p class="description">JPG or PNG, 2MB max</p>
      </div>

      <button type="submit" class="submit-button">Submit</button>
    </form>
  </div>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>
  <script>
    function validateForm() {
      const prize = document.getElementById('prize').value;
      const publicationYear = document.getElementById('publication-year').value;
      const isbn = document.getElementById('isbn').value;
      const bookCover = document.getElementById('bookCover').files[0];

      // Validate prize format
      const prizeRegex = /^\d+(\.\d{1,2})?$/;
      if (!prizeRegex.test(prize)) {
        alert('Please enter a valid prize (e.g., 19.99)');
        return false;
      }

      // Validate publication year
      const currentYear = new Date().getFullYear();
      if (publicationYear < 1500 || publicationYear > currentYear) {
        alert(`Publication year must be between 1500 and ${currentYear}`);
        return false;
      }

      // Validate ISBN (10 or 13 digits)
      // const isbnRegex = /^\d{10}$|^\d{13}$/;
      // if (!isbnRegex.test(isbn)) {
      //   alert('ISBN must be 10 or 13 digits');
      //   return false;
      // }

      // Validate file
      if (bookCover) {
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxFileSize = 2 * 1024 * 1024; // 2MB
        if (!allowedTypes.includes(bookCover.type)) {
          alert('Only JPG or PNG files are allowed');
          return false;
        }
        if (bookCover.size > maxFileSize) {
          alert('File size exceeds 2MB limit');
          return false;
        }
      }

      return true;
    }
  </script>
</body>

</html>