window.onload = function () {
  const deleteCompBtn = document.getElementById("delete-details");
  const cancelDeleteBtn = document.getElementById("cancelDelete");
  const deleteOverlay = document.querySelector(".deleteOverlay-container");

  if (!deleteCompBtn || !cancelDeleteBtn || !deleteOverlay) {
    console.warn("Missing elements: Check IDs in HTML.");
    return;
  }

  deleteCompBtn.addEventListener("click", (e) => {
    e.preventDefault();
    deleteOverlay.style.display = "flex";
  });

  cancelDeleteBtn.addEventListener("click", (e) => {
    e.preventDefault();
    deleteOverlay.style.display = "none";
  });
};

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const titleInput = document.getElementById("story-editor-chapter");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    if (titleInput.value.trim().length > 45) {
      isValid = false;
      alert("Title must be 45 characters or fewer.");
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});
