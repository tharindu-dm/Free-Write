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

    .stats-container {
      max-width: 1200px;
      width: 90%;
      margin: 1rem auto;
      padding: 1rem;
    }

    .stats-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      width: 90%;
      margin: 2rem auto 1rem auto;
      padding: 0 1rem;
    }

    .view-stats-button {
      padding: 0.75rem 1.5rem;
      background-color: #FFD052;
      color: #1C160C;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      text-decoration: none;
      display: inline-block;
    }

    .view-stats-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: #FFFFFF;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
      border: 2px solid #FFD700;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-card h3 {
      color: #1C160C;
      font-size: 1.1rem;
      margin-bottom: 0.75rem;
      font-weight: 600;
    }

    .stat-card .number {
      font-size: 2rem;
      font-weight: bold;
      color: #FFD052;
    }

    .courier-select {
      width: 100%;
      padding: 0.5rem;
      border: 1px solid #FFD700;
      border-radius: 8px;
      background-color: #FCFAF5;
      color: #1C160C;
      font-size: 0.875rem;
      cursor: pointer;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .courier-select:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    .courier-select optgroup {
      font-weight: 600;
    }

    .courier-select option {
      padding: 8px;
    }


    @media (max-width: 768px) {
      .main-content {
        padding: 1rem;
        width: 95%;
        margin: 1rem auto;
      }

      .stats-container {
        width: 95%;
        padding: 0.5rem;
      }

      .stats-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
      }

      .view-stats-button {
        width: 100%;
        text-align: center;
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

      .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
    }
  </style>
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php";
  ?>

  <div class="stats-header">
    <h2 style="color: #1C160C; font-size: 1.5rem; font-weight: 600;">Statistics Overview</h2>
    <a href="/Free-Write/public/Order/viewStats" class="view-stats-button">View Statistics</a>
  </div>

  <div class="stats-container">
    <div class="stats-grid">
      <a href="/Free-Write/public/Order/">
        <div class="stat-card">
          <h3>All Orders</h3>
          <div class="number">12</div>
        </div>
      </a>
      <a href="/Free-Write/public/Order/newOrder">
        <div class="stat-card">
          <h3>New Orders</h3>
          <div class="number">12</div>
        </div>
      </a>
      <a href="/Free-Write/public/Order/processedOrder">
        <div class="stat-card">
          <h3>Processing</h3>
          <div class="number">8</div>
        </div>
      </a>
      <div class="stat-card">
        <h3>Shipped</h3>
        <div class="number">45</div>
      </div>
      <div class="stat-card">
        <h3>Completed</h3>
        <div class="number">156</div>
      </div>
    </div>
  </div>

  <main class="main-content">
    <h1>Orders</h1>

    <div class="order-search-container">
      <div class="order-search-bar">
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
          <th>Status</th>
          <th>Courier</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data['orders'])): ?>
          <?php foreach ($data['orders'] as $order): ?>
            <?php
            $userDetailsTable = new UserDetails();
            $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
            ?>
            <tr>
              <td><a
                  href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
              </td>
              <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
              <td>
                <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . '  ' . $userDetails['lastName']) : 'N/A'; ?>
              </td>
              <td>Pending</td>
              <td>
                <form action="/Free-Write/public/Order/proceedingOrder" method="POST" class="proceed-form">
                  <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID'] ?? '') ?>">
                  <select name="courier" class="courier-select">
                    <option value="">Select Courier</option>
                    <option value="systemCourier">System Courier</option>
                    <optgroup label="My Own Couriers">
                      <option value="local1">Local Delivery Service</option>
                      <option value="personal">Personal Delivery</option>
                      <option value="custom">Custom Courier</option>
                    </optgroup>
                  </select>
              </td>
              <td>
                <button type="submit" class="order-action-button">Proceed</button>
                </form>
              </td>



            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" style="text-align: center;">No Orders found</td>
          </tr>
        <?php endif; ?>
      </tbody>

    </table>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>