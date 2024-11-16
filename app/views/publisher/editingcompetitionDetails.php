<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Competition</title>
  <style>
    .form-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      font-size: 2rem;
      margin-bottom: 2rem;
      color: #1C160C;
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
      box-shadow: 0 0 0 3px rgba(1, 152, 99, 0.2);
    }

    input[type="file"] {
      padding: 0.8rem;
      background-color: #FCFAF5;
      border: 2px dashed #E9DFCE;
      cursor: pointer;
    }

    input[type="file"]:hover {
      border-color: #FFD052;
    }

    #date-picker {
      background-color: #FCFAF5;
      cursor: pointer;
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

    .save-btn {
      background-color: #FFD052;
      color: white;
    }

    .save-btn:hover {
      background-color: #E0B94A;
    }

    .stop-btn {
      background-color: #8C805E;
      color: white;
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

    .stop-btn:hover {
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

      nav {
        gap: 1rem;
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

  <div class="form-container">
    <h2>Edit Competition</h2>
    <form>
      <label for="competition-name">Competition Name</label>
      <input id="competition-name" type="text" placeholder="Enter new competition name" />

      <label for="prize-amount">Prize Amount</label>
      <input id="prize-amount" type="text" placeholder="Enter new prize amount" />

      <div class="optional-section">
        <h3>Change Competition Image</h3>
        <p>JPG or PNG, 2MB max</p>
        <button type="button">Upload Image</button>
      </div>

      <label for="date-picker">Select Competition Dates (Calendar option to be added)</label>
      <input id="date-picker" type="text" placeholder="Pick dates" readonly />

      <button type="button" class="save-btn">Save Changes</button>
      <button type="button" class="stop-btn">Stop Competition</button>
    </form>
  </div>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>