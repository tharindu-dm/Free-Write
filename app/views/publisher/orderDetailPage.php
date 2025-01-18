<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
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

        .order-overview {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            display: inline-block;
            background-color: #FFD052;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #1C160C;
        }

        .order-section {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #FFD052;
        }

        .order-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #F5F0E5;
            border-radius: 8px;
        }

        .order-item img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .timeline-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #F5F0E5;
            border-radius: 8px;
        }

        .timeline-date {
            color: #8C805E;
            font-size: 0.9rem;
        }

        .courier-option {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #F5F0E5;
            border-radius: 8px;
            cursor: pointer;
        }

        .courier-option.selected {
            background-color: #FFD052;
        }

        .customer-note {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #F5F0E5;
            border-radius: 8px;
        }

        .note-timestamp {
            color: #8C805E;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }

            .order-item {
                flex-direction: column;
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
        <section class="order-overview">
            <h1>Order #12345</h1>
            <p>Placed on November 28, 2024</p>
            <div class="status-badge">Processing</div>
        </section>

        <section class="order-section">
            <h2>Order Items</h2>
            <div class="order-item">
                <img src="/api/placeholder/100/150" alt="The Hidden Path">
                <div>
                    <h3>The Hidden Path</h3>
                    <p>by Sarah Johnson</p>
                    <p>Quantity: 1</p>
                    <p>$24.99</p>
                </div>
            </div>
            <div class="order-item">
                <img src="/api/placeholder/100/150" alt="Beyond the Horizon">
                <div>
                    <h3>Beyond the Horizon</h3>
                    <p>by Michael Chen</p>
                    <p>Quantity: 1</p>
                    <p>$19.99</p>
                </div>
            </div>
        </section>

        <section class="order-section">
            <h2>Customer Details</h2>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john.doe@email.com</p>
            <p><strong>Phone:</strong> (555) 123-4567</p>
        </section>

        <section class="order-section">
            <h2>Shipping Address</h2>
            <p>123 Main Street</p>
            <p>Apt 4B</p>
            <p>New York, NY 10001</p>
            <p>United States</p>
        </section>

        <section class="order-section">
            <h2>Payment Information</h2>
            <p><strong>Method:</strong> Credit Card</p>
            <p><strong>Status:</strong> Paid</p>
            <p><strong>Subtotal:</strong> $44.98</p>
            <p><strong>Shipping:</strong> $5.99</p>
            <p><strong>Total:</strong> $50.97</p>
        </section>

        <section class="order-section">
            <h2>Order Timeline</h2>
            <div class="timeline-item">
                <div class="timeline-date">Nov 28, 2024 - 10:30 AM</div>
                <div>
                    <h4>Order Created</h4>
                    <p>Order placed successfully</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">Nov 28, 2024 - 10:35 AM</div>
                <div>
                    <h4>Payment Verified</h4>
                    <p>Payment confirmed</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">Nov 28, 2024 - 11:00 AM</div>
                <div>
                    <h4>Processing</h4>
                    <p>Order is being processed</p>
                </div>
            </div>
        </section>

        <section class="order-section">
            <h2>Courier Assignment</h2>
            <div class="courier-option selected">
                <h4>Eliya</h4>
                <p>Colombo</p>
                <p>$5.99</p>
            </div>
            <!-- <div class="courier-option">
                <h4>Standard Delivery</h4>
                <p>5-7 business days</p>
                <p>$3.99</p>
            </div> -->
        </section>

        <section class="order-section">
            <h2>Customer Notes</h2>
            <div class="customer-note">
                <p>Please leave package at the front desk</p>
                <p class="note-timestamp">Added on Nov 28, 2024 - 10:30 AM</p>
            </div>
        </section>
    </main>
</body>
</html>