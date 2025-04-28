document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const titleInput = document.getElementById("title");
  const synopsisInput = document.getElementById("Synopsis");
  const priceInput = document.getElementById("price");
  const titleWarning = document.getElementById("title-warning");
  const synopsisWarning = document.getElementById("synopsis-warning");

 
  titleInput.addEventListener('input', function () {
    if (titleInput.value.length > 45) {
      titleWarning.style.display = 'block';
      titleInput.style.borderColor = 'red';
    } else {
      titleWarning.style.display = 'none';
      titleInput.style.borderColor = '';
    }
  });


  synopsisInput.addEventListener('input', function () {
    if (synopsisInput.value.length > 255) {
      synopsisWarning.style.display = 'block';
      synopsisInput.style.borderColor = 'red';
    } else {
      synopsisWarning.style.display = 'none';
      synopsisInput.style.borderColor = '';
    }
  });


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

    if (!isValid) {
      event.preventDefault();
    }
  });
});
