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
      color: #8C805E;
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
      border: 2px solid #E9DFCE;
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
      background-color: #8C805E;
      color: white;
    }

    .cancel-btn:hover {
      background-color: #7A6F50;
    }

    .optional-section {
      padding: 1.5rem;
      border: 2px dashed #E9DFCE;
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
      color: #8C805E;
      margin-bottom: 1rem;
    }

    .optional-section button {
      background-color: #FFFFFF;
      border: 2px solid #E9DFCE;
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

    footer {
      margin-top: auto;
      text-align: center;
      padding: 1.5rem;
      background-color: #FFFFFF;
      color: #8C805E;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }


    @media (max-width: 768px) {
      header {
        flex-direction: column;
        padding: 1rem;
      }

      .nav-container {
        margin: 1rem 0 0 0;
      }



      .form-container {
        margin: 1rem;
        padding: 1rem;
      }

      button {
        width: 100%;
        margin: 0.5rem 0;
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
  <main>
    <div class="form-container">
      <h1>Create a New Competition</h1>
      <h4>Set up the details for your competition</h4>
      <form>
        <label>Competition Name</label>
        <input type="text" placeholder="Enter competition name" required />
        <label>Competition Description</label>
        <textarea placeholder="Describe your competition" required></textarea>
        <label>Competition Category</label>
        <select required>
          <option value="">Select a category</option>
          <option value="writing">Writing</option>
          <option value="poetry">Poetry</option>
          <option value="fiction">Fiction</option>
          <option value="non-fiction">Non-fiction</option>
        </select>
        <label>Prize Amount</label>
        <input type="number" placeholder="Enter prize amount" required min="0" step="0.01" />
        <div class="optional-section">
          <h3>Add Competition Image</h3>
          <p>JPG or PNG, 2MB max</p>
          <button type="button">Upload Image</button>
        </div>
        <button type="submit" class="submit-btn">Create Competition</button>
        <button type="button" class="cancel-btn">Cancel</button>
      </form>
    </div>
  </main>
  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>