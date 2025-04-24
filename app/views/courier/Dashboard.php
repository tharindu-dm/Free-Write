<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freewrite - Courier Dashboard</title>
    <style>
        :root {
            --primary-color: #ffd700;
            --background-light: #f4f4f4;
            --text-dark: #333;
            --border-color: #e0e0e0;
            --yellow-highlight: #ffd700;
            --button-yellow: #ffd700;
            --section-border: #ffd700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: white;
            color: var(--text-dark);
        }

        .dashboard {
            display: flex;
            height: calc(100vh - 60px);
        }

        .sidebar {
            width: 250px;
            background-color: white;
            border-right: 1px solid var(--border-color);
            padding: 20px;
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-menu li {
            margin-bottom: 15px;
        }

        .sidebar-menu a,
        .user-nav-button {
            text-decoration: none;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 16px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active,
        .user-nav-button:hover,
        .user-nav-button.active {
            background-color: var(--yellow-highlight);
            color: var(--text-dark);
            font-weight: bold;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--section-border);
        }

        /* Enhanced Delivery Card Styles */
        .delivery-card {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .delivery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            border-color: var(--yellow-highlight);
        }

        .delivery-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .delivery-details h3 {
            font-size: 1.2em;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .delivery-details p {
            font-size: 0.9em;
            color: #555;
            line-height: 1.5;
        }

        .delivery-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .delivery-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-accept {
            background-color: var(--button-yellow);
            color: var(--text-dark);
            font-weight: 600;
        }

        .btn-accept:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
        }


        /* Updated Status Badge Styles */
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 16px;
            font-size: 0.8em;
            font-weight: 600;
            text-transform: capitalize;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            color: var(--text-dark);
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-top: 5px;
        }

        .status-pending {
            background: linear-gradient(135deg, #ffd54f, #ffca28);
            color: var(--text-dark);
        }

        .status-processing {
            background: linear-gradient(135deg, #2196f3, #1976d2);
            color: white;
        }

        .status-shipped {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #4caf50, #388e3c);
            color: white;
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-card .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: var(--text-dark);
        }

        .stat-card.highlighted {
            border-left: 4px solid var(--yellow-highlight);
        }

        .search-container {
            display: flex;
            margin-bottom: 20px;
        }

        .search-container input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px 0 0 5px;
        }

        .search-container button {
            padding: 10px 20px;
            background-color: var(--button-yellow);
            border: none;
            border-radius: 0 5px 5px 0;
            color: var(--text-dark);
            font-weight: bold;
            cursor: pointer;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: white;
            border-bottom: 1px solid var(--border-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .courier-profile {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 15px;
        }

        .courier-profile-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }

        .courier-profile-info h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .courier-profile-info p {
            font-size: 14px;
            color: #666;
        }

        .edit-profile-btn {
            background-color: var(--button-yellow);
            color: var(--text-dark);
            font-weight: bold;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 12px;
            transition: background-color 0.3s;
        }

        .edit-profile-btn:hover {
            background-color: #e6c200;
        }

        .page-title {
            border-bottom: 2px solid var(--yellow-highlight);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* New styles for view sections */
        .view-section {
            display: none;
        }

        .view-section.active {
            display: block;
        }

        .delivery-message {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--yellow-highlight);
        }

        .delivery-message h3 {
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .no-deliveries {
            text-align: center;
            padding: 30px;
            margin: 20px 0;
            background-color: #fff9e6;
            border: 2px dashed var(--yellow-highlight);
            border-radius: 10px;
        }

        .no-deliveries p {
            font-size: 20px;
            color: #555;
            font-weight: 500;
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
        case 'courier':
            require_once "../app/views/layout/header-courier.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>
    <div class="dashboard">
        <div class="sidebar">
            <div class="courier-profile">
                <img src="/api/placeholder/60/60" alt="Courier Profile" class="courier-profile-img">
                <div class="courier-profile-info">
                    <h3>Courier jathu</h3>
                    <p>Sri Lanka</p>
                    <button class="edit-profile-btn">Edit Profile</button>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><button class="user-nav-button active" data-view="dashboard">Dashboard</button></li>
                <li><button class="user-nav-button" data-view="new-deliveries">New Deliveries</button></li>
                <li><button class="user-nav-button" data-view="processing">Processing</button></li>
                <li><button class="user-nav-button" data-view="out4Delivery">Out for Delivery</button></li>
                <li><button class="user-nav-button" data-view="completed">Completed</button></li>
            </ul>
        </div>

        <div class="main-content">
            <!-- Dashboard Section -->
            <div id="dashboard" class="view-section active">
                <div class="section-title">
                    <h2>Delivery Overview</h2>
                    <span><?= date("F j, Y") ?></span>
                </div>

                <div class="stats-container">
                    <div class="stat-card highlighted" data-target-view="new-deliveries">
                        <h3>New Deliveries</h3>
                        <div class="stat-value">
                            <?php
                            $newCount = 0;
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                                    if ($order['status'] == 'pendingfromcourier') $newCount++;
                                }
                            }
                            echo $newCount;
                            ?>
                        </div>
                    </div>
                    <div class="stat-card highlighted" data-target-view="processing">
                        <h3>Processing</h3>
                        <div class="stat-value">
                            <?php
                            $processingCount = 0;
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                                    if ($order['status'] == 'collectingOrder') $processingCount++;
                                }
                            }
                            echo $processingCount;
                            ?>
                        </div>
                    </div>
                    <div class="stat-card highlighted" data-target-view="out4Delivery">
                        <h3>Out for Delivery</h3>
                        <div class="stat-value">
                            <?php
                            $shippedCount = 0;
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                                    if ($order['status'] == 'deliveryWithin1Day') $shippedCount++;
                                }
                            }
                            echo $shippedCount;
                            ?>
                        </div>
                    </div>
                    <div class="stat-card highlighted" data-target-view="completed">
                        <h3>Completed</h3>
                        <div class="stat-value">
                            <?php
                            $completedCount = 0;
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
                                    if ($order['status'] == 'completed') $completedCount++;
                                }
                            }
                            echo $completedCount;
                            ?>
                        </div>
                    </div>
                </div>


                <div class="section-title">
                    <h2>Recent Deliveries</h2>
                </div>

                <div class="search-container">
                    <input type="text" placeholder="Search by order ID, book title or customer name">
                    <button>Search</button>
                </div>

                <?php
                $recentDeliveries = false;
                if (!empty($orders)) {
                    // Sort orders by date (newest first)
                    usort($orders, function ($a, $b) {
                        return strtotime($b['orderDate']) - strtotime($a['orderDate']);
                    });

                    $count = 0;
                    foreach ($orders as $order) {
                        if ($count >= 5) break;
                        $recentDeliveries = true;
                        $count++;

                        $statusClass = 'status-pending'; // Default
                        if ($order['status'] == 'collectingOrder') $statusClass = 'status-processing';
                        else if ($order['status'] == 'out4Delivery' || $order['status'] == 'deliveryWithin1Day') $statusClass = 'status-shipped';
                        else if ($order['status'] == 'delivered' || $order['status'] == 'completed') $statusClass = 'status-completed';

                ?>
                        <div class="delivery-card">
                            <div class="delivery-details">
                                <h3>Order #<?= htmlspecialchars($order['orderID']) ?> - "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher: <?= htmlspecialchars($order['publisherName']) ?></p>
                                <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                <p>Delivery Assigned At: <?= htmlspecialchars($order['courierAssigned_at']) ?></p>
                                <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($order['status']) ?></span>
                            </div>
                            <div class="delivery-actions">

                                <?php if ($order['status'] == 'pendingfromcourier'): ?>
                                    <form action="/Free-Write/public/Courier/acceptOrder" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Accept</button>
                                    </form>
                                <?php elseif ($order['status'] == 'collectingOrder'): ?>
                                    <form action="/Free-Write/public/Courier/deliveryWithin1Day" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Deliver</button>
                                    </form>
                                <?php elseif ($order['status'] == 'deliveryWithin1Day'): ?>
                                    <form action="/Free-Write/public/Courier/completingOrder" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Complete</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php
                    }
                }

                if (!$recentDeliveries) {
                    ?>
                    <div class="no-deliveries">
                        <p>No deliveries available at the moment.</p>
                    </div>
                <?php
                }
                ?>

            </div>

            <div id="new-deliveries" class="view-section">
                <div class="section-title">
                    <h2>New Deliveries</h2>
                </div>

                <div class="delivery-message">
                    <h3>Hello, here are new deliveries</h3>
                    <p>This section shows all new delivery requests that are waiting for your acceptance.</p>
                </div>

                <div class="search-container">
                    <input type="text" placeholder="Search by order ID, book title or customer name">
                    <button>Search</button>
                </div>

                <?php
                $pendingDeliveries = false;
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if ($order['status'] == 'pendingfromcourier') {
                            $pendingDeliveries = true;
                ?>
                            <div class="delivery-card">
                                <div class="delivery-details">
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> - "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher: <?= htmlspecialchars($order['publisherName']) ?></p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                    <p>Courier Assigned At: <?= htmlspecialchars($order['courierAssigned_at']) ?></p>
                                    <span class="status-badge status-pending"><?= htmlspecialchars($order['status']) ?></span>
                                </div>
                                <div class="delivery-actions">
                                    <form action="/Free-Write/public/Courier/acceptOrder" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Accept</button>
                                    </form>
                                </div>
                            </div>

                    <?php
                        }
                    }
                }

                if (!$pendingDeliveries) {
                    ?>
                    <div class="no-deliveries">
                        <p>No new deliveries available at the moment.</p>
                    </div>
                <?php
                }
                ?>

            </div>

            <div id="processing" class="view-section">
                <div class="section-title">
                    <h2>Processing Orders</h2>
                </div>

                <div class="delivery-message">
                    <h3>Orders in Processing</h3>
                    <p>These orders have been accepted and are being collected from the publisher for delivery.</p>
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Search by order ID, book title or customer name">
                    <button>Search</button>
                </div>

                <?php
                $collectingDeliveries = false;
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if ($order['status'] == 'collectingOrder') {
                            $collectingDeliveries = true;
                ?>
                            <div class="delivery-card">
                                <div class="delivery-details">
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> - "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher: <?= htmlspecialchars($order['publisherName']) ?></p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                    <p>Courier Assigned At: <?= htmlspecialchars($order['courierAssigned_at']) ?></p>
                                    <span class="status-badge status-processing"><?= htmlspecialchars($order['status']) ?></span>
                                </div>
                                <div class="delivery-actions">
                                    <form action="/Free-Write/public/Courier/deliveryWithin1Day" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Deliver</button>
                                    </form>
                                </div>
                            </div>

                    <?php
                        }
                    }
                }

                if (!$collectingDeliveries) {
                    ?>
                    <div class="no-deliveries">
                        <p>No package arrives at our courier local warehouse right now.</p>
                    </div>
                <?php
                }
                ?>

            </div>

            <div id="out4Delivery" class="view-section">
                <div class="section-title">
                    <h2>Out for Delivery</h2>
                </div>

                <div class="delivery-message">
                    <h3>Orders Out for Delivery</h3>
                    <p>These orders are currently being delivered to customers.</p>
                </div>

                <div class="search-container">
                    <input type="text" placeholder="Search by order ID, book title or customer name">
                    <button>Search</button>
                </div>

                <?php
                $completingOrder = false;
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if ($order['status'] == 'deliveryWithin1Day') {
                            $completingOrder = true;
                ?>
                            <div class="delivery-card">
                                <div class="delivery-details">
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> - "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher: <?= htmlspecialchars($order['publisherName']) ?></p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                    <p>Courier Assigned At: <?= htmlspecialchars($order['courierAssigned_at']) ?></p>
                                    <span class="status-badge status-shipped"><?= htmlspecialchars($order['status']) ?></span>
                                </div>
                                <div class="delivery-actions">
                                    <form action="/Free-Write/public/Courier/completingOrder" method="POST">
                                        <input type="hidden" name="orderID" value="<?= htmlspecialchars($order['orderID']) ?>">
                                        <button type="submit" class="btn-accept">Complete</button>
                                    </form>
                                </div>
                            </div>

                    <?php
                        }
                    }
                }

                if (!$completingOrder) {
                    ?>
                    <div class="no-deliveries">
                        <p>No completed deliveries at the moment.</p>
                    </div>
                <?php
                }
                ?>
            </div>

            <div id="completed" class="view-section">
                <div class="section-title">
                    <h2>Completed Deliveries</h2>
                </div>

                <div class="delivery-message">
                    <h3>Completed Orders</h3>
                    <p>This section shows all orders that have been successfully delivered to customers.</p>
                </div>

                <div class="search-container">
                    <input type="text" placeholder="Search by order ID, book title or customer name">
                    <button>Search</button>
                </div>

                <?php
                $completedOrders = false;
                if (!empty($orders)) {
                    foreach ($orders as $order) {
                        if ($order['status'] == 'completed') {
                            $completedOrders = true;
                ?>
                            <div class="delivery-card">
                                <div class="delivery-details">
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> - "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher: <?= htmlspecialchars($order['publisherName']) ?></p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity: <?= htmlspecialchars($order['quantity']) ?></p>
                                    <p>Courier Assigned At: <?= htmlspecialchars($order['courierAssigned_at']) ?></p>
                                    <span class="status-badge status-completed"><?= htmlspecialchars($order['status']) ?></span>
                                </div>
                                <div class="delivery-actions">
                                    <button class="btn-details">Details</button>
                                </div>
                            </div>

                    <?php
                        }
                    }
                }

                if (!$completedOrders) {
                    ?>
                    <div class="no-deliveries">
                        <p>No completed orders</p>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.user-nav-button').forEach(button => {
            button.addEventListener('click', function() {
                // Hide all sections
                document.querySelectorAll('.view-section').forEach(section => {
                    section.classList.remove('active');
                });
                // Show the clicked section
                const sectionId = this.getAttribute('data-view');
                document.getElementById(sectionId).classList.add('active');

                // Update the active class for the navigation button
                document.querySelectorAll('.user-nav-button').forEach(btn => {
                    btn.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>

</body>

</html>