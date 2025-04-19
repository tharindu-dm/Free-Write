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
                <h2>Donation Information</h2>
                <div class="order-summary">
                    <p>Writer</p>
                    <p>&nbsp;<?= htmlspecialchars($donationInfo['writerName']) ?></p>
                    <p>From:</p>
                    <p>&nbsp;<?= htmlspecialchars($donationInfo['userName']) ?></p>
                </div>
                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>
            </div>

            <div class="payment-details">
                <h2>Payment Information</h2>
                <form action="/Free-Write/public/Payment/donateWriter" method="post">
                <div class="order-summary">
                    <p>Donation Information (LKR)</p>
                   <select name="donateAmount">
                    <option value="100" selected aria-required="true">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                    <option value="2000">2000</option>
                   </select>
                   
                </div>
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
                        <input type="hidden" name="writerID" value="<?php echo $_GET['user'] ?>">
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