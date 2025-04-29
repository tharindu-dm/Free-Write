document.addEventListener("DOMContentLoaded", function () {
  const editModal = document.getElementById("editModal");
  const deleteModal = document.getElementById("deleteModal");

  const editBtn = document.querySelector(".btn-edit");
  const deleteBtn = document.querySelector(".btn-delete");
  const cancelBtns = document.querySelectorAll(".btn-cancel");

  const collectionID = document.querySelector(
    'input[name="collectionID"]'
  ).value;

  editBtn.addEventListener("click", function () {
    const editForm = editModal.querySelector("form");
    if (!editForm.querySelector('input[name="id"]')) {
      const idInput = document.createElement("input");
      idInput.type = "hidden";
      idInput.name = "id";
      idInput.value = collectionID;
      editForm.appendChild(idInput);
    }

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

  deleteBtn.addEventListener("click", function () {
    deleteModal.style.display = "flex";
  });

  cancelBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      editModal.style.display = "none";
      deleteModal.style.display = "none";
    });
  });

  window.addEventListener("click", function (event) {
    if (event.target === editModal) {
      editModal.style.display = "none";
    }
    if (event.target === deleteModal) {
      deleteModal.style.display = "none";
    }
  });

  const editForm = document.querySelector("#editModal form");
  editForm.addEventListener("submit", function (event) {
    const titleInput = document.getElementById("collectionTitle");
    if (!titleInput.value.trim()) {
      event.preventDefault();
      alert("Collection title cannot be empty");
      titleInput.focus();
    }
  });

  const deleteForm = document.querySelector("#deleteModal form");
  deleteForm.addEventListener("submit", function (event) {
    if (
      !confirm(
        "Are you sure you want to delete this collection? This action cannot be undone."
      )
    ) {
      event.preventDefault();
    }
  });
});
