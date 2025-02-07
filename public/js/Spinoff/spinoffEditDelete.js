document.addEventListener("DOMContentLoaded", () => {
  const deleteOverlay = document.querySelector(".delete_spinoff_chapter_overlay");
  const discardOverlay = document.querySelector(".discard_spinoff_chapter_overlay");
  const cancelDiscardBtn = document.getElementById("cancelDiscardBtn");
  const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
  const discardChangesBtn = document.getElementById("discardChangesBtn");
  const deleteForm = document.getElementById('deleteOverlayForm');
  const deleteBtn = document.getElementById('spinoff_chapter_delete_btn');


  // Initially hide the overlays
  if (deleteOverlay) deleteOverlay.style.display = "none";
  if (discardOverlay) discardOverlay.style.display = "none";

  // Show delete overlay when delete button is clicked
  if (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent form submission
      showDeleteOverlay();
    });
  }

  // Function to show delete overlay
  function showDeleteOverlay() {
    console.log("Showing delete overlay");
    if (deleteOverlay) {
      deleteOverlay.style.display = "flex";

      // Add event listener to the confirmation button in the overlay
      const confirmDeleteBtn = document.getElementById("deleteChapterBtn");
      if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", function (e) {
          e.preventDefault(); // Prevent default form submission
          deleteForm.submit(); // Submit the form when confirmed
        });
      }
    }
  }

  // Function to show discard overlay
  function showDiscardOverlay() {
    if (discardOverlay) {
      discardOverlay.style.display = "flex";
    }
  }

  // Discard changes button
  document.querySelectorAll(".discard-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showDiscardOverlay();
    });
  });

  // Cancel buttons
  if (cancelDiscardBtn) {
    cancelDiscardBtn.addEventListener("click", function (e) {
      e.preventDefault();
      discardOverlay.style.display = "none";
    });
  }

  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
      deleteOverlay.style.display = "none";
    });
  }

  // Discard changes confirmation
  if (discardChangesBtn) {
    discardChangesBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.reload();
    });
  }

  // Close overlay when clicking outside
  window.addEventListener("click", function (e) {
    if (e.target.classList.contains("overlay-container")) {
      e.target.parentElement.style.display = "none";
    }
  });
});