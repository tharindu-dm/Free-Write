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

    .order-search-container {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .order-search-bar {
      flex: 1;
      display: flex;
      align-items: center;
      background-color: #FCFAF5;
      border: 2px solid #FFD700;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .order-search-bar:focus-within {
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    .order-search-bar input {
      width: 100%;
      border: none;
      background: none;
      font-size: 1rem;
      color: #1C160C;
      outline: none;
    }

    .order-search-bar input::placeholder {
      color: #c47c15;
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
      border-bottom: 1px solid #FFD700;
    }

    .order-table th {
      background-color: #FCFAF5;
      font-weight: 600;
      color: #1C160C;
    }

    .order-table tr:last-child td {
      border-bottom: none;
    }

    /* .status-dropdown {
      width: 100%;
      padding: 0.5rem;
      border: 2px solid #FFD700;
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
    } */

    .order-action-button {
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

    .order-action-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-action-button:disabled {
      background-color: #FFD700;
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

      .order-search-container {
        flex-direction: column;
      }

      .order-table {
        display: block;
        overflow-x: auto;
      }

      .order-action-button {
        width: 100%;
      }
    }

    .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stat-card h3 {
            color: #666;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
            color: #333;
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
   
   <div class="container">
        <div class="stats-grid">
        <a href="/Free-Write/public/Publisher/newOrder"><div class="stat-card">
                <h3>New Orders</h3>
                <div class="number">12</div>
            </div></a>
            <div class="stat-card">
                <h3>Processing</h3>
                <div class="number">8</div>
            </div>
            <div class="stat-card">
                <h3>Shipped</h3>
                <div class="number">45</div>
            </div>
            <div class="stat-card">
                <h3>Completed</h3>
                <div class="number">156</div>
            </div>
        </div>


  <main class="main-content">
    <h1>Orders</h1>

    <div class="order-search-container">
      <div class="order-search-bar">
        <input type="text" placeholder="order-Search by book title or customer name">
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
        <td><a href="/Free-Write/public/Publisher/orderDetail">Designing Data-Intensive Applications</a></td></a>
          <td>2024-10-20</td>
          <td>Jane Smith</td>
          <td>1234 Main St, Colombo</td>
          <td>
            shipped
          </td>
          <td>
            <button class="order-action-button">Proceed</button>
          </td>
        </tr>
        <tr>
          <td><a href="/Free-Write/public/Publisher/orderDetail">Clean Code</a></td>
          <td>2024-10-21</td>
          <td>John Doe</td>
          <td>5678 Market St, Galle</td>
          <td>
            pending
          </td>
          <td>
            <button class="order-action-button">Proceed</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</body>

</html>