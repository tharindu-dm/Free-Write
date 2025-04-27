<!-- My Shopping Cart Section -->
<div id="my-cart" class="view-section">
    <h2>My Shopping Cart</h2>

    <?php if (!empty($cartItems)): ?>
        <div class="table-responsive">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr class="cart-row">
                            <td><?= htmlspecialchars($item['bookID']) ?></td>
                            <td><?= htmlspecialchars($item['bookTitle'] ?? 'Book Title') ?></td>
                            <td>
                                <div class="quantity-control">
                                    <button class="quantity-btn minus"
                                        data-cart-id="<?= htmlspecialchars($item['cartID']) ?>">-</button>
                                    <span class="quantity"><?= htmlspecialchars($item['quantity']) ?></span>
                                    <button class="quantity-btn plus"
                                        data-cart-id="<?= htmlspecialchars($item['cartID']) ?>">+</button>
                                </div>
                            </td>
                            <td>LKR <?= number_format($item['price'] ?? 0, 2) ?></td>
                            <td>LKR <?= number_format(($item['price'] ?? 0) * $item['quantity'], 2) ?></td>
                            <td>
                                <form method="post" action="/Free-Write/public/Cart/RemoveFromCart">
                                    <input type="hidden" name="cartID" value="<?= htmlspecialchars($item['cartID']) ?>">
                                    <button type="submit" class="remove-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Remove
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="/Free-Write/public/Publisher/paymentPage/<?= htmlspecialchars($item['bookID']) ?>/<?= htmlspecialchars($item['quantity']) ?>"
                                    class="checkout-btn-small">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                    </svg>Checkout</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="empty-cart-icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <p>Your cart is empty</p>
                <a href="/Free-Write/public/Publisher" class="btn btn-shop">Start Shopping</a>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Quantity adjustment functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function () {
                const cartId = this.getAttribute('data-cart-id');
                const isPlus = this.classList.contains('plus');
                const currentQuantity = parseInt(this.parentElement.querySelector('.quantity').textContent);
                if (!isPlus && currentQuantity <= 1) {
                    alert("Quantity cannot be less than 1");
                    return;
                }
                // Send AJAX request to update quantity
                if (confirm("Are you sure you want to update the quantity?")) {
                    fetch('/Free-Write/public/Cart/UpdateQuantity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `cartID=${cartId}&action=${isPlus ? 'increase' : 'decrease'}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Refresh the page to show updated cart
                                window.location.reload();
                            } else {
                                alert(data.message || 'Failed to update quantity');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the cart');
                        });
                }
            });
        });
    </script>
    <style>
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .checkout-btn-small {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: #ffd700;
            color: #1a1a1a;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            margin-left: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.2s;
        }

        .checkout-btn-small:hover {
            background-color: #fcba03;
            transform: translateY(-2px);
        }

        .checkout-btn-small svg {
            width: 16px;
            height: 16px;
        }


        .cart-table thead {
            background-color: #ffd700;
            color: #1a1a1a;
        }

        .cart-table th,
        .cart-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-table th {
            font-weight: 600;
            font-size: 15px;
        }

        .cart-row:hover {
            background-color: #fffbf0;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: #f0f0f0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .quantity-btn:hover {
            background-color: #e0e0e0;
        }

        .quantity {
            margin: 0 10px;
            font-weight: 500;
        }

        .remove-btn {
            background-color: #ff4b4b;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.2s;
        }

        .remove-btn:hover {
            background-color: #e53e3e;
        }

        .remove-btn svg {
            width: 16px;
            height: 16px;
        }

        .checkout-btn,
        .continue-shopping-btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .checkout-btn {
            background-color: #ffd700;
            color: #1a1a1a;
        }

        .checkout-btn:hover {
            background-color: #fcba03;
            transform: translateY(-2px);
        }

        .continue-shopping-btn {
            background-color: #f0f0f0;
            color: #1a1a1a;
        }

        .continue-shopping-btn:hover {
            background-color: #e0e0e0;
        }

        .empty-cart {
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

        .empty-cart-icon {
            width: 64px;
            height: 64px;
            color: #888;
            margin-bottom: 16px;
        }

        .empty-state p {
            color: #555;
            font-size: 18px;
            margin-bottom: 24px;
        }

        .btn-shop {
            background-color: #ffd700;
            color: #1a1a1a;
            padding: 10px 24px;
            font-size: 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-shop:hover {
            background-color: #fcba03;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {

            .cart-table th,
            .cart-table td {
                padding: 12px 10px;
            }



            .checkout-btn,
            .continue-shopping-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</div>