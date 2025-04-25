<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Processing</title>
    <link rel="stylesheet" href="/Free-Write/public/css/paymentPage.css">
</head>

<body>

    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <div class="container">
            <div class="order-details">
                <h2>Order Information</h2>
                <div class="order-summary">
                    <p>Item:</p>
                    <p>&nbsp;<?= htmlspecialchars($data['orderInfo']['Item']) ?></p>
                    <p>Quantity:</p>
                    <p>&nbsp;<?= htmlspecialchars($data['orderInfo']['Quantity']) ?></p>
                    <p>Unit Price:</p>
                    <p>LKR.&nbsp;<?= number_format((float) $data['orderInfo']['Price'], 2) ?></p>

                    <p>Total Price:</p>
                    <p>LKR.&nbsp;<?= number_format((float) $data['orderInfo']['Total'], 2) ?></p>

                </div>
                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>

            </div>

            <div class="payment-details">
                <form action="/Free-Write/public/Payment/buy_<?= htmlspecialchars($data['type']) ?>" method="post">
                    <?php if ($type === 'PublisherBook'): ?>
                        <!-- Shipping Details Section -->
                        <div class="shipping-details">
                            <h2>Shipping Information</h2>
                            <input type="text" required name="shipping_address" placeholder="Shipping Address"
                                maxlength="200">
                            <input type="tel" required name="phone_number" placeholder="Phone Number"
                                pattern="[0-9+\-\s()]+" title="Enter a valid phone number">
                        </div>
                    <?php endif; ?>

                    <h2>Payment Information</h2>
                    <div class="card-details">
                        <div class="card-type">
                            <label>
                                <input type="radio" required name="cardType" value="credit"> Credit&nbsp;Card
                            </label>
                            <label>
                                <input type="radio" required name="cardType" value="debit"> Debit&nbsp;Card
                            </label>
                        </div>
                        <div id="cardTypeDisplay"></div>
                        <input type="hidden" name="cardHost" id="cardHost" value="">

                        <input type="text" required name="cardNumber" id="cardNumber" placeholder="Card Number"
                            maxlength="16">
                        <input type="text" required name="cardName" id="cardName" placeholder="Cardholder Name"
                            maxlength="26">

                        <div class="exp-cvv-container">
                            <select required name="expMonth" id="expMonth">
                                <option value="">Month</option>
                                <!-- Months will be populated dynamically using JS -->
                            </select>
                            <select required name="expYear" id="expYear">
                                <option value="">Year</option>
                                <!-- Years will be populated dynamically using JS upto 10 years form now-->
                            </select>
                            <input type="password" required name="cvv" id="cvv" placeholder="CVV" maxlength="4">
                        </div>

                        <!-- <label for="saveCard" style="display: flex; align-items: center;">
                            <input type="checkbox" name="saveCard" value="yes">&nbsp;Save Card for future payments
                        </label>-->
                        <input type="hidden" name="itemID" value="<?= htmlspecialchars($itemID) ?>">
                        <input type="hidden" name="bookID" value="<?= htmlspecialchars($bookID) ?>">
                        <input type="hidden" name="totalPrice" value="<?= htmlspecialchars($orderInfo['Total']) ?>">
                        <input type="hidden" name="quantity" value="<?= htmlspecialchars($orderInfo['Quantity']) ?>">

                        <div id="cardValidation"></div>
                        <button type="submit">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="\Free-Write\public\js\paymentPage.js"></script>
</body>

</html>