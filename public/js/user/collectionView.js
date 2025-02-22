// Modal functionality
document.addEventListener("DOMContentLoaded", function () {
  // Get modal elements
  const editModal = document.getElementById("editModal");
  const deleteModal = document.getElementById("deleteModal");

  // Get buttons
  const editBtn = document.querySelector(".btn-edit");
  const deleteBtn = document.querySelector(".btn-delete");
  const cancelBtns = document.querySelectorAll(".btn-cancel");

  // Make sure we have the current collection ID
  const collectionID = document.querySelector(
    'input[name="collectionID"]'
  ).value;

  // Open edit modal
  editBtn.addEventListener("click", function () {
    // Ensure the form has the collection ID
    const editForm = editModal.querySelector("form");
    if (!editForm.querySelector('input[name="id"]')) {
      const idInput = document.createElement("input");
      idInput.type = "hidden";
      idInput.name = "id";
      idInput.value = collectionID;
      editForm.appendChild(idInput);
    }

    // Set the correct status option as selected
    const currentStatus = document
      .querySelector(".collection-status")
      .classList.contains("public")
      ? "1"
      : "0";
    const statusSelect = document.getElementById("collectionStatus");
    for (let i = 0; i < statusSelect.options.length; i++) {
      if (statusSelect.options[i].value === currentStatus) {
        statusSelect.options[i].selected = true;
        break;
      }
    }

    editModal.style.display = "flex";
  });

  // Open delete modal
  deleteBtn.addEventListener("click", function () {
    deleteModal.style.display = "flex";
  });

  // Close modals when clicking cancel buttons
  cancelBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent form submission
      editModal.style.display = "none";
      deleteModal.style.display = "none";
    });
  });

  // Close modals when clicking outside
  window.addEventListener("click", function (event) {
    if (event.target === editModal) {
      editModal.style.display = "none";
    }
    if (event.target === deleteModal) {
      deleteModal.style.display = "none";
    }
  });

  // Form validation
  const editForm = document.querySelector("#editModal form");
  editForm.addEventListener("submit", function (event) {
    const titleInput = document.getElementById("collectionTitle");
    if (!titleInput.value.trim()) {
      event.preventDefault();
      alert("Collection title cannot be empty");
      titleInput.focus();
    }
    // Form will submit normally if validation passes
  });

  // Confirm delete action
  const deleteForm = document.querySelector("#deleteModal form");
  deleteForm.addEventListener("submit", function (event) {
    if (
      !confirm(
        "Are you sure you want to delete this collection? This action cannot be undone."
      )
    ) {
      event.preventDefault();
    }
    // Form will submit normally if confirmed
  });
});
