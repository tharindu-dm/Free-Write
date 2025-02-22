document.addEventListener("DOMContentLoaded", () => {
  const deleteOverlay = document.querySelector(
    ".delete_spinoff_chapter_overlay"
  );
  const saveEditOverlay = document.querySelector(
    ".edit_spinoff_chapter_overlay"
  );

  const cancelSaveEditBtn = document.getElementById("cancelSaveEditBtn");
  const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
  const saveChangesBtn = document.getElementById("saveChangesBtn");
  const saveEditBtn = document.getElementById("saveSpinoffDetailsButton");

  const deleteForm = document.getElementById("deleteOverlayForm");
  const editSpinoffForm = document.getElementById("editSpinoffForm");
  const deleteBtn = document.getElementById("deleteSpinoffButton");

  // Initially hide the overlays
  if (deleteOverlay) deleteOverlay.style.display = "none";
  if (saveEditOverlay) saveEditOverlay.style.display = "none";

  // Show delete overlay when delete button is clicked
  if (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent form submission
      showDeleteOverlay();
    });
  }

  if (saveEditBtn) {
    saveEditBtn.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent form submission
      showsaveEditOverlay();
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

  // Function to show save edits overlay
  function showsaveEditOverlay() {
    console.log("Showing delete overlay");
    if (saveEditOverlay) {
      saveEditOverlay.style.display = "flex";

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

  // Save changes button
  document.querySelectorAll(".discard-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showsaveEditOverlay();
    });
  });

  // Cancel buttons
  if (cancelSaveEditBtn) {
    cancelSaveEditBtn.addEventListener("click", function (e) {
      e.preventDefault();
      saveEditOverlay.style.display = "none";
    });
  }

  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
      deleteOverlay.style.display = "none";
    });
  }

  // save changes confirmation
  if (saveChangesBtn) {
    saveChangesBtn.addEventListener("click", function (e) {
      e.preventDefault();
      editSpinoffForm.submit();
    });
  }

  // Close overlay when clicking outside
  window.addEventListener("click", function (e) {
    if (e.target.classList.contains("overlay-container")) {
      e.target.parentElement.style.display = "none";
    }
  });
});
