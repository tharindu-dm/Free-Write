document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const titleInput = document.getElementById("story-editor-chapter");
  const titleWarning = document.getElementById("title-warning");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    if (titleInput.value.trim().length > 45) {
      isValid = false;
      titleWarning.style.display = "block";
    } else {
      titleWarning.style.display = "none";
    }

    if (!isValid) {
      event.preventDefault();
    }
  });

  titleInput.addEventListener("input", function () {
    if (titleInput.value.trim().length > 45) {
      titleWarning.style.display = "block";
    } else {
      titleWarning.style.display = "none";
    }
  });
});
