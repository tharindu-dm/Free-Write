document.addEventListener("DOMContentLoaded", function () {
  //Validations for Edit Book
  const form = document.querySelector("form");
  const titleInput = document.getElementById("title");
  const synopsisInput = document.getElementById("synopsis");
  const priceInput = document.getElementById("price");

  //Validatoins for Edit Book
  form.addEventListener("submit", (event) => {
    let isValid = true;

    // Validate Title
    if (titleInput.value.trim().length > 45) {
      isValid = false;
      alert("Title must be 45 characters or fewer.");
    }

    // Validate Synopsis
    if (synopsisInput.value.trim().length > 255) {
      isValid = false;
      alert("Synopsis must be 255 characters or fewer.");
    }

    // Validate Price
    const price = parseFloat(priceInput.value);
    if (isNaN(price) || price < 0) {
      isValid = false;
      alert("Price must be a positive number or zero.");
    }

    // Prevent form submission if any validation fails
    if (!isValid) {
      event.preventDefault();
    }
  });
});
