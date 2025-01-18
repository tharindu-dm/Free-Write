document.addEventListener("DOMContentLoaded", function () {
  //Validations for Create Book
  const form = document.querySelector("form");
  const titleInput = document.getElementById("title");
  const synopsisInput = document.getElementById("synopsis");
  const priceInput = document.getElementById("price");
  const typeRadios = document.getElementsByName("type");
  const privacyRadios = document.getElementsByName("privacy");
  const coverInput = document.getElementById("cover");

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

    // Validate Release Type
    if (!Array.from(typeRadios).some((radio) => radio.checked)) {
      isValid = false;
      alert("Please select a release type.");
    }

    // Validate Privacy
    if (!Array.from(privacyRadios).some((radio) => radio.checked)) {
      isValid = false;
      alert("Please select a privacy option.");
    }

    // Validate Cover Image
    if (!coverInput.value) {
      isValid = false;
      alert("Please upload a cover image.");
    }

    // Prevent form submission if any validation fails
    if (!isValid) {
      event.preventDefault();
    }
  });
});
