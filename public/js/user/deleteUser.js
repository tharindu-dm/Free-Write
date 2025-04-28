// Function to open the delete confirmation modal
function openDeleteModal() {
  const modal = document.getElementById("deleteConfirmModal");
  if (modal) {
    modal.style.display = "flex";
    // Reset the confirmation text field
    document.getElementById("deleteConfirmText").value = "";
    // Disable the submit button until proper confirmation is typed
    document.getElementById("deleteSubmitBtn").disabled = true;
  }
}

// Function to close the delete confirmation modal
function closeDeleteModal() {
  const modal = document.getElementById("deleteConfirmModal");
  if (modal) {
    modal.style.display = "none";
  }
}

// Function to validate the deletion confirmation text
function validateDeleteConfirmation() {
  const confirmText = document.getElementById("deleteConfirmText").value;
  const deleteBtn = document.getElementById("deleteSubmitBtn");

  if (confirmText != null) {
    deleteBtn.disabled = false;
  } else {
    deleteBtn.disabled = true;
  }
}

// Initialize event listeners when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  const deleteAccountBtn = document.querySelector(".delete-account-btn");

  if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener("click", (e) => {
      e.preventDefault(); // Prevent immediate form submission
      openDeleteModal();
    });
  } else {
    console.error("Delete account button not found in the DOM.");
  }

  // Handle form submission from the modal
  const deleteModalForm = document.getElementById("deleteModalForm");
  if (deleteModalForm) {
    deleteModalForm.addEventListener("submit", (e) => {
      console.log("Account deletion form submitted");
      // The form will submit normally to "/Free-Write/public/User/DeleteUser"
    });
  }

  // Close modal when clicking outside (optional)
  const modalOverlay = document.querySelector(".modal-overlay");
  if (modalOverlay) {
    modalOverlay.addEventListener("click", (e) => {
      if (e.target === modalOverlay) {
        closeDeleteModal();
      }
    });
  }
});
