document.addEventListener("DOMContentLoaded", function () {
  const collectionBtn = document.getElementById("createCollectionBtn");
  const cancelBtn_collection = document.querySelector(
    ".discard-change-btn-collection"
  );
  const collectionOverlay = document.querySelector(
    ".create-collection-overlay"
  );
  const cancelOverlayBtn_collection = document.getElementById(
    "collection-cancelOverlayBtn"
  );
  const form = document.getElementById("collectionForm");
  const titleInput = document.getElementById("title");
  const descriptionInput = document.getElementById("Collect_description");
  const titleError = document.getElementById("titleError");
  const descriptionError = document.getElementById("descriptionError");

  if (collectionBtn && collectionOverlay) {
    collectionBtn.addEventListener("click", (e) => {
      e.preventDefault();

      collectionOverlay.style.display =
        collectionOverlay.style.display != "flex" ? "flex" : "none";
    });

    cancelOverlayBtn_collection.addEventListener("click", (e) => {
      e.preventDefault();

      collectionOverlay.style.display = "none";
    });
    cancelBtn_collection.addEventListener("click", (e) => {
      e.preventDefault();

      collectionOverlay.style.display = "none";
    });
  } else {
    console.error("CollectionBtn or its Overlay not found in the DOM.");
  }

  const validateTitle = () => {
    const value = titleInput.value.trim();
    if (!value) {
      titleError.textContent = "Title is required";
      return false;
    }
    if (value.length < 3) {
      titleError.textContent = "Title must be at least 3 characters long";
      return false;
    }
    if (value.length > 100) {
      titleError.textContent = "Title must be less than 100 characters";
      return false;
    }
    if (value.length > 45) {
      titleError.textContent = "Title is getting long (over 45 characters)";
    }
    titleError.textContent = "";
    return true;
  };

  const validateDescription = () => {
    const value = descriptionInput.value.trim();
    if (value === "") {
      descriptionError.textContent = "Description is required";
      return false;
    }
    if (value.length < 10) {
      descriptionError.textContent =
        "Description must be at least 10 characters long";
      return false;
    }
    if (value.length > 500) {
      descriptionError.textContent =
        "Description must be less than 500 characters";
      return false;
    }
    if (value.length > 255) {
      descriptionError.textContent =
        "Description is getting long (over 255 characters)";
    }
    descriptionError.textContent = "";
    return true;
  };

  titleInput.addEventListener("input", validateTitle);
  descriptionInput.addEventListener("input", validateDescription);

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const isTitleValid = validateTitle();
    const isDescriptionValid = validateDescription();

    if (isTitleValid && isDescriptionValid) {
      const submitButton = form.querySelector(".create-btn");
      submitButton.innerHTML = "<span>Creating...</span>";
      submitButton.disabled = true;

      form.submit();
    }
  });
});
