<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F0E5;
            color: #1C160C;
            line-height: 1.6;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 20px;
        }

        .overview-section {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats {
            display: flex;
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #8C805E;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        .order-list {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .order-card {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #F5F0E5;
            border-radius: 8px;
            position: relative;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .order-id {
            font-weight: 600;
        }

        .order-time {
            color: #8C805E;
            font-size: 0.9rem;
        }

        .order-content {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .order-items {
            flex: 2;
        }

        .customer-info {
            flex: 1;
        }

        .order-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #E5E5E5;
        }

        .courier-select {
            padding: 0.5rem;
            border: 1px solid #8C805E;
            border-radius: 4px;
            background-color: white;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .accept-btn {
            background-color: #FFD052;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .reject-btn {
            background-color: #8C805E;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .order-preview {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
            width: 300px;
        }

        .order-card:hover .order-preview {
            display: block;
        }

        .processing-time {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background-color: #FFD052;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #FFD052;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .order-content {
                flex-direction: column;
                gap: 1rem;
            }

            .stats {
                flex-direction: column;
                gap: 1rem;
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
        case 'mod':
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
        <section class="overview-section">
            <h1>New Orders</h1>
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Pending Orders</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">25</div>
                    <div class="stat-label">Today's Orders</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">2.5h</div>
                    <div class="stat-label">Avg. Processing</div>
                </div>
            </div>
        </section>

        <section class="order-list">
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #12345</span>
                    <span class="order-time">2 minutes ago</span>
                </div>
                <div class="order-content">
                    <div class="order-items">
                        <h3>Order Items</h3>
                        <p>The Hidden Path - 1x</p>
                        <p>Beyond the Horizon - 1x</p>
                        <p class="processing-time">Est. Processing: 2-3 days</p>
                    </div>
                    <div class="customer-info">
                        <h3>Customer</h3>
                        <p>John Doe</p>
                        <p>john.doe@email.com</p>
                        <p>(555) 123-4567</p>
                    </div>
                </div>
                <div class="order-actions">
                    <select class="courier-select">
                        <option value="">Select Courier</option>
                        <option value="express">Kumar </option>
                        <option value="standard">Eliya</option>
                    </select>
                    <div class="action-buttons">
                        <button class="accept-btn">Accept Order</button>
                        <button class="reject-btn">Reject Order</button>
                    </div>
                </div>
                <div class="order-preview">
                    <h4>Quick Preview</h4>
                    <p><strong>Total Amount:</strong> $44.98</p>
                    <p><strong>Shipping Address:</strong></p>
                    <p>123 Main Street, Apt 4B</p>
                    <p>New York, NY 10001</p>
                </div>
            </div>

            <section class="order-list">
            <div class="order-card">
                <div class="order-header">
                    <span class="order-id">Order #12345</span>
                    <span class="order-time">2 minutes ago</span>
                </div>
                <div class="order-content">
                    <div class="order-items">
                        <h3>Order Items</h3>
                        <p>The Hidden Path - 1x</p>
                        <p>Beyond the Horizon - 1x</p>
                        <p class="processing-time">Est. Processing: 2-3 days</p>
                    </div>
                    <div class="customer-info">
                        <h3>Customer</h3>
                        <p>John Doe</p>
                        <p>john.doe@email.com</p>
                        <p>(555) 123-4567</p>
                    </div>
                </div>
                <div class="order-actions">
                    <select class="courier-select">
                        <option value="">Select Courier</option>
                        <option value="express">Kumar </option>
                        <option value="standard">Eliya</option>
                    </select>
                    <div class="action-buttons">
                        <button class="accept-btn">Accept Order</button>
                        <button class="reject-btn">Reject Order</button>
                    </div>
                </div>
                <div class="order-preview">
                    <h4>Quick Preview</h4>
                    <p><strong>Total Amount:</strong> $44.98</p>
                    <p><strong>Shipping Address:</strong></p>
                    <p>123 Main Street, Apt 4B</p>
                    <p>New York, NY 10001</p>
                </div>
            </div>

            <!-- Additional order cards would follow the same pattern -->
            <div class="order-card">
                <!-- Similar structure repeated -->
            </div>
        </section>

        <!-- Example notification -->
        <div class="notification">
            New order received! Order #12346
        </div>
    </main>
</body>
</html>