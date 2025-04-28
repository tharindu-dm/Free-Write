<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freewrite - Courier Dashboard</title>
    <style>
        :root {
            --gold: #ffd700;
            --black: #1a1a1a;
            --white: #ffffff;
            --gray: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.1);
            --gold-light: rgba(255, 215, 0, 0.05);
        }

        .dashboard {
            display: flex;
            height: 70vh;
            background: var(--white);
        }

        .sidebar {
            width: 250px;
            background: var(--white);
            border-right: 1px solid var(--gray);
            padding: 1.5rem;
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 1.5rem;
        }

        .sidebar-menu li {
            margin-bottom: 0.75rem;
        }

        .sidebar-menu a,
        .user-nav-button {
            text-decoration: none;
            color: var(--black);
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active,
        .user-nav-button:hover,
        .user-nav-button.active {
            background: var(--gold-light);
            color: var(--black);
            border: var(--gold) solid 1px;
            font-weight: 600;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            overflow-y: auto;
            background: var(--gold-light);
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gold);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--black);
        }

        .delivery-card {
            background: var(--white);
            border: var(--gold) solid 1px;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            box-shadow: 0 4px 12px var(--shadow);
            transition: all 0.3s ease;
        }

        .delivery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px var(--shadow);
            background: var(--gold-light);
        }

        .delivery-details h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 0.5rem;
        }

        .delivery-details p {
            font-size: 0.875rem;
            color: var(--black);
            line-height: 1.6;
            opacity: 0.8;
        }

        .delivery-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .delivery-actions button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-accept {
            background: var(--gold);
            color: var(--black);
        }

        .btn-accept:hover {
            background: #e6c200;
            transform: translateY(-2px);
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
            background: var(--gray);
            color: var(--black);
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-top: 0.5rem;
        }

        .status-pending {
            background: var(--gold);
            color: var(--black);
        }

        .status-processing {
            background: var(--gray);
            color: var(--black);
        }

        .status-shipped {
            background: var(--gold-light);
            border: var(--gold) solid 1px;
            color: var(--black);
        }

        .status-completed {
            background: var(--white);
            border: var(--gold) solid 1px;
            color: var(--black);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 2px 8px var(--shadow);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: var(--gold-light);
        }

        .stat-card h3 {
            font-size: 0.875rem;
            color: var(--black);
            margin-bottom: 0.75rem;
            opacity: 0.7;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--black);
        }

        .stat-card.highlighted {
            border-left: 4px solid var(--gold);
        }

        .search-container {
            display: flex;
            margin-bottom: 1.5rem;
        }

        .search-container input {
            flex-grow: 1;
            padding: 0.75rem;
            border: var(--gold) solid 1px;
            border-radius: 1rem 0 0 1rem;
            background: var(--white);
            font-size: 0.875rem;
        }

        .search-container button {
            padding: 0.75rem 1.5rem;
            background: var(--gold);
            border: none;
            border-radius: 0 1rem 1rem 0;
            color: var(--black);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-container button:hover {
            background: #e6c200;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background: var(--white);
            border-bottom: 1px solid var(--gray);
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            margin-right: 0.75rem;
            border: var(--gold) solid 1px;
        }

        .courier-profile {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--gray);
            margin-bottom: 1rem;
        }

        .courier-profile-img {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            margin-right: 1rem;
            object-fit: cover;
            border: var(--gold) solid 1px;
        }

        .courier-profile-info h3 {
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
            color: var(--black);
        }

        .courier-profile-info p {
            font-size: 0.875rem;
            color: var(--black);
            opacity: 0.7;
        }

        .edit-profile-btn {
            background: var(--gold);
            color: var(--black);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            margin-top: 0.75rem;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }

        .edit-profile-btn:hover {
            background: #e6c200;
        }

        .page-title {
            border-bottom: 2px solid var(--gold);
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: var(--black);
        }

        .view-section {
            display: none;
        }

        .view-section.active {
            display: block;
        }

        .delivery-message {
            background: var(--gold-light);
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--gold);
        }

        .delivery-message h3 {
            margin-bottom: 0.75rem;
            color: var(--black);
            font-size: 1.25rem;
        }

        .no-deliveries {
            text-align: center;
            padding: 2rem;
            margin: 1.5rem 0;
            background: var(--gold-light);
            border: var(--gold) solid 1px;
            border-radius: 1rem;
            font-size: 1.25rem;
            color: var(--black);
            font-weight: 500;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    ?>

    <div class="dashboard">
        <div class="sidebar">
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
                                    if ($order['status'] == 'pendingfromcourier')
                                        $newCount++;
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
                                    if ($order['status'] == 'collectingOrder')
                                        $processingCount++;
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
                                    if ($order['status'] == 'deliveryWithin1Day')
                                        $shippedCount++;
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
                                    if ($order['status'] == 'completed')
                                        $completedCount++;
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
                        if ($count >= 5)
                            break;
                        $recentDeliveries = true;
                        $count++;

                        $statusClass = 'status-pending'; // Default
                        if ($order['status'] == 'collectingOrder')
                            $statusClass = 'status-processing';
                        else if ($order['status'] == 'out4Delivery' || $order['status'] == 'deliveryWithin1Day')
                            $statusClass = 'status-shipped';
                        else if ($order['status'] == 'delivered' || $order['status'] == 'completed')
                            $statusClass = 'status-completed';

                        ?>
                        <div class="delivery-card">
                            <div class="delivery-details">
                                <h3>Order #<?= htmlspecialchars($order['orderID']) ?> -
                                    "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher:
                                    <?= htmlspecialchars($order['publisherName']) ?>
                                </p>
                                <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity:
                                    <?= htmlspecialchars($order['quantity']) ?>
                                </p>
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
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> -
                                        "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher:
                                        <?= htmlspecialchars($order['publisherName']) ?>
                                    </p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity:
                                        <?= htmlspecialchars($order['quantity']) ?>
                                    </p>
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
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> -
                                        "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher:
                                        <?= htmlspecialchars($order['publisherName']) ?>
                                    </p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity:
                                        <?= htmlspecialchars($order['quantity']) ?>
                                    </p>
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
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> -
                                        "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher:
                                        <?= htmlspecialchars($order['publisherName']) ?>
                                    </p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity:
                                        <?= htmlspecialchars($order['quantity']) ?>
                                    </p>
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
                                    <h3>Order #<?= htmlspecialchars($order['orderID']) ?> -
                                        "<?= htmlspecialchars($order['bookTitle']) ?>"</h3>
                                    <p>Customer: <?= htmlspecialchars($order['customerName']) ?> | Publisher:
                                        <?= htmlspecialchars($order['publisherName']) ?>
                                    </p>
                                    <p>Phone No: <?= htmlspecialchars($order['phoneNo']) ?></p>
                                    <p>Delivery Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>Collection Address: <?= htmlspecialchars($order['deliveryAddress']) ?></p>
                                    <p>ISBN ID: <?= htmlspecialchars($order['isbnID']) ?> | Quantity:
                                        <?= htmlspecialchars($order['quantity']) ?>
                                    </p>
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

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script>
        document.querySelectorAll('.user-nav-button').forEach(button => {
            button.addEventListener('click', function () {
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