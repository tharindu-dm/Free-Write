<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Processing</title>
    <style>
        main {
            display: flex;
            width: 100%;
            height: 100vh;
            padding: 2rem 3rem 2rem 3rem;
        }

        .container {
            display: flex;
            width: 100%;
            height: 80%;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .order-details {
            flex: 1;
            background-color: #f9f9f9;
            padding: 30px;
            border-right: 1px solid #e0e0e0;
        }

        .payment-details {
            flex: 1;
            padding: 30px;
        }

        .order-details h2,
        .payment-details h2 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffd700;
            padding-bottom: 10px;
        }

        .order-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .order-summary p {
            color: #666;
        }

        .order-summary p:nth-child(odd) {
            font-weight: bold;
            color: #333;
        }

        .card-details {
            display: grid;
            gap: 15px;
        }

        .card-type {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
        }

        .card-type label {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 1rem;
            border: 1px solid #707070;
            border-radius: 1rem;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.3);
        }

        .exp-cvv-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        button {
            background-color: #ffd700;
            color: #333;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffcc00;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #cardValidation {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9em;
        }

        #cardTypeDisplay {
            font-size: 1.1em;
            color: #333;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
                margin: 20px auto;
            }

            .order-details {
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
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

    //show($data);
    ?>


    <main>
        <div class="container">
            <div class="order-details">
                <h2>Order Information</h2>
                <div class="order-summary">
                    <p>Item:</p>
                    <p>&nbsp;<?= htmlspecialchars($bookDetails['title']) ?></p>
                    <p>Quantity:</p>
                    <p>&nbsp;<?= htmlspecialchars($quantity) ?></p>
                    <p>Unit Price:</p>
                    <p>LKR.&nbsp;<?= htmlspecialchars($bookDetails['prize']) ?></p>
                    <p>Total Price:</p>
                    <p>LKR.&nbsp;<?= htmlspecialchars($bookDetails['prize'] * $quantity) ?></p>
                </div>

                <p style="color: #666; font-style: italic;">
                    Secure payment for the best user experience.
                </p>
            </div>

            <div class="payment-details">
                <h2>Payment Information</h2>
                <form action="/Free-Write/public/Order/addOrder4Pub" method="POST">
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

                        <input type="text" required name="cardNumber" id="cardNumber" placeholder="Card Number" maxlength="16">
                        <input type="text" required name="cardName" id="cardName" placeholder="Cardholder Name" maxlength="26">

                        <div class="exp-cvv-container">
                            <input type="text" required name="expMonth" id="expMonth" placeholder="MM" maxlength="2" pattern="(0[1-9]|1[0-2])" title="Enter month as 2 digits (01-12)">

                            <input type="text" required name="expYear" id="expYear" placeholder="YYYY" maxlength="4" pattern="[2-9][0-9]{3}" title="Enter 4-digit year">

                            <input type="password" required name="cvv" id="cvv" placeholder="CVV" maxlength="4">
                        </div>


                        <div id="cardValidation"></div>

                        <input type="hidden" name="isbnID" value="<?= htmlspecialchars($bookDetails['isbnID']) ?>">
                        <input type="hidden" name="userID" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
                        <input type="hidden" name="totalPrice" value="<?= htmlspecialchars($bookDetails['prize'] * $quantity) ?>">
                        <input type="hidden" name="quantity" value="<?= htmlspecialchars($quantity) ?>">
                        <input type="hidden" name="bookTitle" value="<?= htmlspecialchars($bookDetails['title']) ?>">
                        <input type="hidden" name="bookPublisherID" value="<?= htmlspecialchars($bookDetails['publisherID']) ?>">
                        <button type="submit">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>