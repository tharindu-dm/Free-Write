<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Processing</title>
    <link rel="stylesheet" href="/Free-Write/public/css/paymentPage.css">
</head>

<body>

    <?php require_once "../app/views/layout/headerSelector.php";
    ?>

    <main>
        <div class="container">
            <div class="order-details">
                <h2>Order Information</h2>
                <div class="order-summary">
                    <p>Item:</p>
                    <p>&nbsp;<?= ($data['orderInfo']['Item']) ?></p>
                    <p>Quantity:</p>
                    <p>&nbsp;<?= ($data['orderInfo']['Quantity']) ?></p>
                    <p>Unit Price:</p>
                    <p>LKR.&nbsp;<?= number_format((float) $data['orderInfo']['Price'], 2) ?></p>

                    <p>Total Price:</p>
                    <p>LKR.&nbsp;<?= number_format((float) $data['orderInfo']['Total'], 2) ?></p>
                </div>

                <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />

                <?php if (isset($instDetails)): ?>
                    <div class="order-summary">
                        <p>Institute Name:</p>
                        <p>&nbsp;<?= ($data['instDetails']['name']) ?></p>
                        <p>New Institute Email:</p>
                        <p>&nbsp;<?= ($data['instDetails']['username']) ?></p>
                    </div>
                <?php endif; ?>
                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>
            </div>

            <div class="payment-details">
                <form action="/Free-Write/public/Payment/buy_<?= ($data['type']) ?>" method="post">
                    <?php if ($type === 'PublisherBook'): ?>
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
                            </select>
                            <select required name="expYear" id="expYear">
                                <option value="">Year</option>
                            </select>
                            <input type="password" required name="cvv" id="cvv" placeholder="CVV" maxlength="4">
                        </div>

                        <input type="hidden" name="itemID" value="<?= ($itemID) ?>">
                        <input type="hidden" name="bookID" value="<?= ($bookID) ?>">
                        <input type="hidden" name="totalPrice" value="<?= ($orderInfo['Total']) ?>">
                        <input type="hidden" name="quantity" value="<?= ($orderInfo['Quantity']) ?>">

                        <?php if (isset($orderInfo['subID'])): ?>
                            <input type="hidden" name="subID" value="<?= ($orderInfo['subID']) ?>">
                        <?php endif; ?>

                        <?php if (isset($instDetails)): ?>
                            <input type="hidden" name="username" value="<?= ($data['instDetails']['username']) ?>">

                            <input type="hidden" name="name" value="<?= ($data['instDetails']['name']) ?>">

                            <input type="hidden" name="password" value="<?= ($data['instDetails']['password']) ?>">

                            <input type="hidden" name="subStartDate" value="<?= ($data['instDetails']['subStartDate']) ?>">

                            <input type="hidden" name="creator" value="<?= ($data['instDetails']['creator']) ?>">
                        <?php endif; ?>

                        <div id="cardValidation"></div>
                        <button
                            type="submit"><?= ($type == 'premium_user' || $type == 'institute') ? 'Subscribe' : 'Pay Now'; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script src="\Free-Write\public\js\paymentPage.js"></script>
</body>

</html>