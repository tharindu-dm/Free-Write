<!-- Orders Section -->
<div id="orders" class="view-section">
    <h2 class="orders-title">My Orders</h2>

    <?php if (!empty($orders)): ?>
        <div class="table-responsive">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Book Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr class="order-row">
                            <td class="order-id"><?= htmlspecialchars($order['orderID']); ?></td>
                            <td class="order-id"><?= htmlspecialchars($order['bookTitle']); ?></td>
                            <td class="order-date"><?= htmlspecialchars($order['quantity']); ?></td>
                            <td class="order-date"><?= htmlspecialchars($order['orderDate']); ?></td>
                            <td class="order-total">$<?= number_format($order['totalPrice'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="no-orders">
            <div class="empty-state">
                <i class="empty-icon">📦</i>
                <p>No orders yet.</p>
                <a href="shop.php" class="btn btn-shop">Start Shopping</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .orders-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 25px;
        color: #1a1a1a;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 12px;
    }

    .table-responsive {
        overflow-x: 100vh;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
    }

    .orders-table thead {
        background-color: #fcba03;
        color: #1a1a1a;
    }

    .orders-table th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        font-size: 15px;
    }

    .orders-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease;
    }

    .orders-table tbody tr:last-child {
        border-bottom: none;
    }

    .orders-table tbody tr:hover {
        background-color: #fffbf0;
    }

    .orders-table td {
        padding: 16px;
        vertical-align: middle;
    }

    .order-id {
        font-weight: 600;
        color: #1a1a1a;
    }

    .order-date {
        color: #555;
    }

    .order-total {
        font-weight: 600;
        color: #1a1a1a;
    }

    .order-actions {
        text-align: center;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background-color: #ff4b4b;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #e53e3e;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .no-orders {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 40px 20px;
        text-align: center;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
        display: block;
    }

    .empty-state p {
        color: #555;
        font-size: 18px;
        margin-bottom: 24px;
    }

    .btn-shop {
        background-color: #fcba03;
        color: #1a1a1a;
        padding: 10px 24px;
        font-size: 16px;
    }

    .btn-shop:hover {
        background-color: #e5aa00;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 768px) {

        .orders-table th,
        .orders-table td {
            padding: 12px 10px;
        }

        .orders-title {
            font-size: 24px;
        }
    }
</style>