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
      transition: transform 0.2s, box-shadow 0.3s;
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
      min-width: 100px;
      /* Added to prevent content wrapping */
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

    /* Statistics Styles */
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

    /* Active stat card */
    .stat-card.active {
      border: 2px solid #c47c15;
      background-color: #FCFAF5;
    }

    /* Order views */
    .order-view {
      display: none;
    }

    .order-view.active {
      display: block;
    }

    /* Status Badge Styles */
    .status-badge {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 16px;
      font-size: 0.8em;
      font-weight: 600;
      text-transform: capitalize;
      background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
      color: #1C160C;
      max-width: 150px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      margin-top: 5px;
    }

    .status-pending {
      background: linear-gradient(135deg, #ffd54f, #ffca28);
      color: #1C160C;
    }

    .status-in-preparation {
      background: linear-gradient(135deg, #2196f3, #1976d2);
      color: white;
    }

    .status-out-for-delivery {
      background: linear-gradient(135deg, #ff9800, #f57c00);
      color: white;
    }

    .status-completed {
      background: linear-gradient(135deg, #4caf50, #388e3c);
      color: white;
    }

    /* Empty state styling */
    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #1C160C;
      font-size: 1rem;
    }

    .empty-state a {
      color: #FFD052;
      text-decoration: none;
      font-weight: 600;
    }

    .empty-state a:hover {
      text-decoration: underline;
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
  //show($data);
  ?>

  <!-- Statistics Header with View Button -->
  <div class="stats-header">
    <h2 style="color: #1C160C; font-size: 1.5rem; font-weight: 600;">Statistics Overview</h2>
    <a href="/Free-Write/public/Order/viewStats" class="view-stats-button" aria-label="View detailed statistics">View
      Statistics</a>
  </div>

  <!-- Statistics Cards -->
  <div class="stats-container">
    <div class="stats-grid">
      <div class="stat-card active" data-view="all-orders">
        <h3>All Orders</h3>
        <div class="number">
          <?php
          $allCount = isset($data['orders']) ? count($data['orders']) : 0;
          echo $allCount;
          ?>
        </div>
      </div>
      <div class="stat-card" data-view="new-orders">
        <h3>New Orders</h3>
        <div class="number">
          <?php
          $newCount = 0;
          if (isset($data['orders']) && !empty($data['orders'])) {
            foreach ($data['orders'] as $order) {
              if ($order['status'] == 'Pending')
                $newCount++;
            }
          }
          echo $newCount;
          ?>
        </div>
      </div>
      <div class="stat-card" data-view="processing-orders">
        <h3>In Preparation</h3>
        <div class="number">
          <?php
          $processingCount = 0;
          if (isset($data['orders']) && !empty($data['orders'])) {
            foreach ($data['orders'] as $order) {
              if ($order['status'] == 'collectingOrder')
                $processingCount++;
            }
          }
          echo $processingCount;
          ?>
        </div>
      </div>
      <div class="stat-card" data-view="shipped-orders">
        <h3>Out for Delivery</h3>
        <div class="number">
          <?php
          $shippedCount = 0;
          if (isset($data['orders']) && !empty($data['orders'])) {
            foreach ($data['orders'] as $order) {
              if ($order['status'] == 'deliveryWithin1Day')
                $shippedCount++;
            }
          }
          echo $shippedCount;
          ?>
        </div>
      </div>
      <div class="stat-card" data-view="completed-orders">
        <h3>Completed</h3>
        <div class="number">
          <?php
          $completedCount = 0;
          if (isset($data['orders']) && !empty($data['orders'])) {
            foreach ($data['orders'] as $order) {
              if ($order['status'] == 'delivered')
                $completedCount++;
            }
          }
          echo $completedCount;
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <!-- All Orders View -->
    <div id="all-orders" class="order-view active">
      <h1>All Orders</h1>
      <div class="order-search-container">
        <div class="order-search-bar">
          <input type="text" placeholder="Search by book title or customer name"
            aria-label="Search orders by book title or customer name">
        </div>
        <button class="filter-button" aria-label="Filter orders">Filter</button>
      </div>

      <table class="order-table">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
            <?php foreach ($data['orders'] as $order): ?>
              <?php
              $userDetailsTable = new UserDetails();
              $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
              $statusDisplay = '';
              $statusClass = '';
              switch ($order['status']) {
                case 'Pending':
                  $statusDisplay = 'Pending';
                  $statusClass = 'status-pending';
                  break;
                case 'collectingOrder':
                  $statusDisplay = 'In Preparation';
                  $statusClass = 'status-in-preparation';
                  break;
                case 'deliveryWithin1Day':
                  $statusDisplay = 'Out for Delivery';
                  $statusClass = 'status-out-for-delivery';
                  break;
                case 'delivered':
                  $statusDisplay = 'Completed';
                  $statusClass = 'status-completed';
                  break;
                default:
                  $statusDisplay = $order['status'];
                  $statusClass = '';
              }
              ?>
              <tr>
                <td><a
                    href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
                </td>
                <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
                <td>
                  <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . ' ' . $userDetails['lastName']) : 'N/A'; ?>
                </td>
                <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusDisplay) ?></span></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-state">No orders found. </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- New Orders View -->
    <div id="new-orders" class="order-view">
      <h1>New Orders</h1>
      <div class="order-search-container">
        <div class="order-search-bar">
          <input type="text" placeholder="Search by book title or customer name"
            aria-label="Search new orders by book title or customer name">
        </div>
        <button class="filter-button" aria-label="Filter new orders">Filter</button>
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
          <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
            <?php
            $newOrdersFound = false;
            foreach ($data['orders'] as $order):
              if ($order['status'] == 'Pending'):
                $newOrdersFound = true;
                $userDetailsTable = new UserDetails();
                $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
                $statusDisplay = 'Pending';
                $statusClass = 'status-pending';
                ?>
                <tr>
                  <td><a
                      href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
                  </td>
                  <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
                  <td>
                    <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . ' ' . $userDetails['lastName']) : 'N/A'; ?>
                  </td>
                  <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusDisplay) ?></span></td>
                  <td>
                    <form action="/Free-Write/public/Order/proceedingOrder" method="POST" class="proceed-form">
                      <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID'] ?? '') ?>">
                      <select name="courier" class="courier-select" required aria-label="Select a courier for the order">
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
                    <button type="submit" class="order-action-button" aria-label="Proceed with order">Proceed</button>
                    </form>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$newOrdersFound): ?>
              <tr>
                <td colspan="6" class="empty-state">No new orders found. <a href="/Free-Write/public/Order/create">Create a
                    new order</a>.</td>
              </tr>
            <?php endif; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="empty-state">No new orders found. <a href="/Free-Write/public/Order/create">Create a
                  new order</a>.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- In Preparation Orders View -->
    <div id="processing-orders" class="order-view">
      <h1>In Preparation Orders</h1>
      <div class="order-search-container">
        <div class="order-search-bar">
          <input type="text" placeholder="Search by book title or customer name"
            aria-label="Search in preparation orders by book title or customer name">
        </div>
        <button class="filter-button" aria-label="Filter in preparation orders">Filter</button>
      </div>

      <table class="order-table">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
            <?php
            $processingOrdersFound = false;
            foreach ($data['orders'] as $order):
              if ($order['status'] == 'collectingOrder'):
                $processingOrdersFound = true;
                $userDetailsTable = new UserDetails();
                $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
                $statusDisplay = 'In Preparation';
                $statusClass = 'status-in-preparation';
                ?>
                <tr>
                  <td><a
                      href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
                  </td>
                  <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
                  <td>
                    <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . ' ' . $userDetails['lastName']) : 'N/A'; ?>
                  </td>
                  <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusDisplay) ?></span></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$processingOrdersFound): ?>
              <tr>
                <td colspan="4" class="empty-state">No orders in preparation.</td>
              </tr>
            <?php endif; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-state">No orders in preparation.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Out for Delivery Orders View -->
    <div id="shipped-orders" class="order-view">
      <h1>Out for Delivery Orders</h1>
      <div class="order-search-container">
        <div class="order-search-bar">
          <input type="text" placeholder="Search by book title or customer name"
            aria-label="Search out for delivery orders by book title or customer name">
        </div>
        <button class="filter-button" aria-label="Filter out for delivery orders">Filter</button>
      </div>

      <table class="order-table">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
            <?php
            $shippedOrdersFound = false;
            foreach ($data['orders'] as $order):
              if ($order['status'] == 'deliveryWithin1Day'):
                $shippedOrdersFound = true;
                $userDetailsTable = new UserDetails();
                $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
                $statusDisplay = 'Out for Delivery';
                $statusClass = 'status-out-for-delivery';
                ?>
                <tr>
                  <td><a
                      href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
                  </td>
                  <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
                  <td>
                    <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . ' ' . $userDetails['lastName']) : 'N/A'; ?>
                  </td>
                  <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusDisplay) ?></span></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$shippedOrdersFound): ?>
              <tr>
                <td colspan="4" class="empty-state">No orders out for delivery.</td>
              </tr>
            <?php endif; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-state">No orders out for delivery.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Completed Orders View -->
    <div id="completed-orders" class="order-view">
      <h1>Completed Orders</h1>
      <div class="order-search-container">
        <div class="order-search-bar">
          <input type="text" placeholder="Search by book title or customer name"
            aria-label="Search completed orders by book title or customer name">
        </div>
        <button class="filter-button" aria-label="Filter completed orders">Filter</button>
      </div>

      <table class="order-table">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Order Date</th>
            <th>Customer</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($data['orders']) && !empty($data['orders'])): ?>
            <?php
            $completedOrdersFound = false;
            foreach ($data['orders'] as $order):
              if ($order['status'] == 'delivered'):
                $completedOrdersFound = true;
                $userDetailsTable = new UserDetails();
                $userDetails = $userDetailsTable->first(['user' => $order['customer_userID']]);
                $statusDisplay = 'Completed';
                $statusClass = 'status-completed';
                ?>
                <tr>
                  <td><a
                      href="/Free-Write/public/Order/orderDetail/<?= htmlspecialchars($order['orderID']) ?>"><?= htmlspecialchars($order['bookTitle'] ?? ''); ?></a>
                  </td>
                  <td><?= htmlspecialchars($order['orderDate'] ?? ''); ?></td>
                  <td>
                    <?= $userDetails ? htmlspecialchars($userDetails['firstName'] . ' ' . $userDetails['lastName']) : 'N/A'; ?>
                  </td>
                  <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusDisplay) ?></span></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$completedOrdersFound): ?>
              <tr>
                <td colspan="4" class="empty-state">No completed orders found.</td>
              </tr>
            <?php endif; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="empty-state">No completed orders found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

  <script>
    // Stat Card View Switching
    document.querySelectorAll('.stat-card').forEach(card => {
      card.addEventListener('click', function () {
        // Hide all views
        document.querySelectorAll('.order-view').forEach(view => {
          view.classList.remove('active');
        });

        // Show the clicked view
        const viewId = this.getAttribute('data-view');
        document.getElementById(viewId).classList.add('active');

        // Update the active class for the stat card
        document.querySelectorAll('.stat-card').forEach(c => {
          c.classList.remove('active');
        });
        this.classList.add('active');
      });
    });

    // Form Validation for Proceed Button
    document.querySelectorAll('.proceed-form').forEach(form => {
      const select = form.querySelector('.courier-select');
      const button = form.querySelector('.order-action-button');

      select.addEventListener('change', function () {
        button.disabled = this.value === '';
      });
    });

    // Search Functionality
    document.querySelectorAll('.order-search-bar input').forEach(searchInput => {
      searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const table = this.closest('.order-view').querySelector('.order-table tbody');
        const rows = table.querySelectorAll('tr');

        rows.forEach(row => {
          const bookTitle = row.cells[0].textContent.toLowerCase();
          const customer = row.cells[2].textContent.toLowerCase();
          const isMatch = bookTitle.includes(searchTerm) || customer.includes(searchTerm);
          row.style.display = isMatch ? '' : 'none';
        });
      });
    });
  </script>
  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>