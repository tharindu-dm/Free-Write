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
                <h2>Advertisment Information</h2>
                <div class="order-summary">
                    <p>advertisement Type:</p>
                    <p>&nbsp;<?= htmlspecialchars($adDetails['advertisementType']) ?></p>
                    <p>Days:</p>
                    <p>&nbsp;<?= htmlspecialchars($adDetails['days']) ?></p>
                    <p>Unit Price:</p>
                    <p>LKR 100</p>

                    <p>Total Price:</p>
                    <p>LKR.&nbsp;<?= number_format((float) $adDetails['total'], 2) ?></p>

                </div>
                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>

            </div>

            <div class="payment-details">
                <form action="/Free-Write/public/Payment/pay4Ad" method="post">


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
                        
                        <input type="hidden" name="advertisementType" value="<?= htmlspecialchars($adDetails['advertisementType'] ?? '') ?>">
                        <input type="hidden" name="start_date" value="<?= htmlspecialchars($adDetails['startDate'] ?? '') ?>">
                        <input type="hidden" name="end_date" value="<?= htmlspecialchars($adDetails['endDate'] ?? '') ?>">
                        <input type="hidden" name="contact_email" value="<?= htmlspecialchars($adDetails['contactEmail'] ?? '') ?>">
                        <input type="hidden" name="adImage" value="<?= htmlspecialchars($adDetails['adImage'] ?? '') ?>">
                        <input type="hidden" name="adID" value="<?= htmlspecialchars($adID ?? '') ?>">

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