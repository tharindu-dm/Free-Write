<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Payment - Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/InstitutePayment.css">
</head>

<body>
    <div class="payment-container">
        <h1>Complete Your Payment</h1>
        <p>Please enter your payment details to proceed.</p>

        <form action="/Free-Write/public/Institute/payment" method="POST" class="payment-form" id="paymentForm">
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" required maxlength="16" pattern="\d{16}"
                    placeholder="1234 5678 9012 3456">
            </div>

            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" id="expiryDate" name="expiryDate" required placeholder="MM/YY" pattern="\d{2}/\d{2}">
            </div>

            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required maxlength="3" pattern="\d{3}" placeholder="123">
            </div>

            <div class="form-group">
                <label for="cardHolderName">Cardholder Name</label>
                <input type="text" id="cardHolderName" name="cardHolderName" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-pay">Pay Now</button>
            </div>
        </form>
    </div>

    <script src="/Free-Write/public/js/InstitutePayment.js"></script>
</body>

</html>
