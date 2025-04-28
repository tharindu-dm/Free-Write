function openDeleteModal() {
  const modal = document.getElementById("deleteConfirmModal");
  if (modal) {
    modal.style.display = "flex";

    document.getElementById("deleteConfirmText").value = "";

    document.getElementById("deleteSubmitBtn").disabled = true;
  }
}

function closeDeleteModal() {
  const modal = document.getElementById("deleteConfirmModal");
  if (modal) {
    modal.style.display = "none";
  }
}

function validateDeleteConfirmation() {
  const confirmText = document.getElementById("deleteConfirmText").value;
  const deleteBtn = document.getElementById("deleteSubmitBtn");

  if (confirmText != null) {
    deleteBtn.disabled = false;
  } else {
    deleteBtn.disabled = true;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const deleteAccountBtn = document.querySelector(".delete-account-btn");

  if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener("click", (e) => {
      e.preventDefault();
      openDeleteModal();
    });
  } else {
    console.error("Delete account button not found in the DOM.");
  }

  const deleteModalForm = document.getElementById("deleteModalForm");
  if (deleteModalForm) {
    deleteModalForm.addEventListener("submit", (e) => {
      console.log("Account deletion form submitted");
    });
  }

  const modalOverlay = document.querySelector(".modal-overlay");
  if (modalOverlay) {
    modalOverlay.addEventListener("click", (e) => {
      if (e.target === modalOverlay) {
        closeDeleteModal();
      }
    });
  }
});
