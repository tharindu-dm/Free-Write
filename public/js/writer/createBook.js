document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const titleInput = document.getElementById("title");
  const synopsisInput = document.getElementById("synopsis");
  const priceInput = document.getElementById("price");
  const typeRadios = document.getElementsByName("type");
  const privacyRadios = document.getElementsByName("privacy");
  const coverInput = document.getElementById("cover");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    if (titleInput.value.trim().length > 45) {
      isValid = false;
      alert("Title must be 45 characters or fewer.");
    }

    if (synopsisInput.value.trim().length > 255) {
      isValid = false;
      alert("Synopsis must be 255 characters or fewer.");
    }

    const price = parseFloat(priceInput.value);
    if (isNaN(price) || price < 0) {
      isValid = false;
      alert("Price must be a positive number or zero.");
    }

    if (!Array.from(typeRadios).some((radio) => radio.checked)) {
      isValid = false;
      alert("Please select a release type.");
    }

    if (!Array.from(privacyRadios).some((radio) => radio.checked)) {
      isValid = false;
      alert("Please select a privacy option.");
    }

    if (!coverInput.value) {
      isValid = false;
      alert("Please upload a cover image.");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});
