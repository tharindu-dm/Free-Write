<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Publisher Dashboard - Manage Orders">
  <title>Publisher Dashboard - Orders</title>
  <style>
    .main-content {
      max-width: 1200px;
      width: 90%;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .main-content h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1C160C;
      margin-bottom: 1.5rem;
    }

    .search-container {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .search-bar {
      flex: 1;
      display: flex;
      align-items: center;
      background-color: #FCFAF5;
      border: 2px solid #E9DFCE;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .search-bar:focus-within {
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    .search-bar input {
      width: 100%;
      border: none;
      background: none;
      font-size: 1rem;
      color: #1C160C;
      outline: none;
    }

    .search-bar input::placeholder {
      color: #8C805E;
    }

    .filter-button {
      padding: 0.75rem 1.5rem;
      background-color: #FFD052;
      color: #1C160C;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .filter-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    .order-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin-top: 1rem;
    }

    .order-table th,
    .order-table td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #E9DFCE;
    }

    .order-table th {
      background-color: #FCFAF5;
      font-weight: 600;
      color: #1C160C;
    }

    .order-table tr:last-child td {
      border-bottom: none;
    }

    .status-dropdown {
      width: 100%;
      padding: 0.5rem;
      border: 2px solid #E9DFCE;
      border-radius: 8px;
      background-color: #FCFAF5;
      font-size: 1rem;
      color: #1C160C;
      cursor: pointer;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .status-dropdown:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    .action-button {
      padding: 0.5rem 1rem;
      background-color: #FFD052;
      color: #1C160C;
      border: none;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .action-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .action-button:disabled {
      background-color: #E9DFCE;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 1rem;
        width: 95%;
        margin: 1rem auto;
      }

      .search-container {
        flex-direction: column;
      }

      .order-table {
        display: block;
        overflow-x: auto;
      }

      .action-button {
        width: 100%;
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

  <main class="main-content">
    <h1>Orders</h1>

    <div class="search-container">
      <div class="search-bar">
        <input type="text" placeholder="Search by book title or customer name">
      </div>
      <button class="filter-button">Filter</button>
    </div>

    <table class="order-table">
      <thead>
        <tr>
          <th>Book Title</th>
          <th>Order Date</th>
          <th>Customer</th>
          <th>Address</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Designing Data-Intensive Applications</td>
          <td>2024-10-20</td>
          <td>Jane Smith</td>
          <td>1234 Main St, Colombo</td>
          <td>
            <select class="status-dropdown">
              <option value="pending">Pending</option>
              <option value="ready">Ready for Courier</option>
              <option value="shipped">Shipped</option>
            </select>
          </td>
          <td>
            <button class="action-button">Proceed</button>
          </td>
        </tr>
        <tr>
          <td>Clean Code</td>
          <td>2024-10-21</td>
          <td>John Doe</td>
          <td>5678 Market St, Galle</td>
          <td>
            <select class="status-dropdown">
              <option value="pending">Pending</option>
              <option value="ready">Ready for Courier</option>
              <option value="shipped">Shipped</option>
            </select>
          </td>
          <td>
            <button class="action-button">Proceed</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</body>

</html>