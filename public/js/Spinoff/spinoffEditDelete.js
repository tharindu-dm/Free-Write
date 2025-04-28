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

  if (deleteOverlay) deleteOverlay.style.display = "none";
  if (saveEditOverlay) saveEditOverlay.style.display = "none";

  if (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
      showDeleteOverlay();
    });
  }

  if (saveEditBtn) {
    saveEditBtn.addEventListener("click", function (e) {
      e.preventDefault();
      showsaveEditOverlay();
    });
  }

  function showDeleteOverlay() {
    console.log("Showing delete overlay");
    if (deleteOverlay) {
      deleteOverlay.style.display = "flex";

      const confirmDeleteBtn = document.getElementById("deleteChapterBtn");
      if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", function (e) {
          e.preventDefault();
          deleteForm.submit();
        });
      }
    }
  }

  function showsaveEditOverlay() {
    console.log("Showing delete overlay");
    if (saveEditOverlay) {
      saveEditOverlay.style.display = "flex";

      const confirmDeleteBtn = document.getElementById("deleteChapterBtn");
      if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener("click", function (e) {
          e.preventDefault();
          deleteForm.submit();
        });
      }
    }
  }

  document.querySelectorAll(".discard-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showsaveEditOverlay();
    });
  });

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

  if (saveChangesBtn) {
    saveChangesBtn.addEventListener("click", function (e) {
      e.preventDefault();
      editSpinoffForm.submit();
    });
  }

  window.addEventListener("click", function (e) {
    if (e.target.classList.contains("overlay-container")) {
      e.target.parentElement.style.display = "none";
    }
  });
});
