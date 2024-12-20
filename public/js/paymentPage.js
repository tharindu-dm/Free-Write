// Populate months and years
const monthSelect = document.getElementById('expMonth');
const yearSelect = document.getElementById('expYear');

for (let i = 1; i <= 12; i++) { //filling the month <select> with 1-12
    const month = i.toString().padStart(2, '0');
    monthSelect.innerHTML += `<option value="${month}">${month}</option>`;
}

const currentYear = new Date().getFullYear();
for (let i = currentYear; i <= currentYear + 10; i++) {
    yearSelect.innerHTML += `<option value="${i}">${i}</option>`;
}

function validateCard() {
    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, ''); // Remove spaces

    const cardValidation = document.getElementById('cardValidation');
    const cardTypeDisplay = document.getElementById('cardTypeDisplay');
    const cardHost = document.getElementById('cardHost');
    const expMonth = document.getElementById('expMonth').value;
    const expYear = document.getElementById('expYear').value;

    // Card type identification
    let cardType = '';
    if (/^4/.test(cardNumber)) cardType = 'Visa';
    else if (/^5[1-5]/.test(cardNumber)) cardType = 'Mastercard';
    else if (/^3[47]/.test(cardNumber)) cardType = 'Amex';

    // Display the card type
    cardTypeDisplay.textContent = cardType ? `Card Type: ${cardType}` : '';
    cardHost.value = cardType;

    // Validation logic
    let isValid = true;
    let message = '';

    // Card number length validation
    if (cardType === 'Visa' && cardNumber.length !== 16) {
        isValid = false;
        message = 'Invalid Visa card number';
    } else if (cardType === 'Mastercard' && cardNumber.length !== 16) {
        isValid = false;
        message = 'Invalid Mastercard number';
    } else if (cardType === 'Amex' && cardNumber.length !== 15) {
        isValid = false;
        message = 'Invalid Amex card number';
    }

    // Expiry date validation
    const currentDate = new Date();
    const expDate = new Date(expYear, expMonth - 1);
    if (expDate <= currentDate) {
        isValid = false;
        message = 'Card has expired';
    }

    cardValidation.innerHTML = message;
    cardValidation.style.color = isValid ? 'green' : 'red';

    return isValid;
}

// Add event listeners for validation
document.getElementById('cardNumber').addEventListener('input', validateCard);
document.getElementById('expMonth').addEventListener('change', validateCard);
document.getElementById('expYear').addEventListener('change', validateCard);

