<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Processing</title>
    <link rel="stylesheet" href="/Free-Write/public/css/paymentPage.css">
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
    $URL = splitURL();
    //$itemID = $URL[2];
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
                    <p>LKR.&nbsp;<?= htmlspecialchars($data['orderInfo']['Price']) ?></p>
                    <p>Total Price:</p>
                    <p>LKR.&nbsp;<?= htmlspecialchars($data['orderInfo']['Total']) ?></p>
                </div>
                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>
            </div>

            <div class="payment-details">
                <h2>Payment Information</h2>
                <form action="/Free-Write/public/Payment/buy_<?= htmlspecialchars($data['type']) ?>" method="post">
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