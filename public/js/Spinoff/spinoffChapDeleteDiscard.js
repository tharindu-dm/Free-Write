document.addEventListener("DOMContentLoaded", () => {
  const deleteOverlay = document.querySelector(
    ".delete_spinoff_chapter_overlay"
  );
  const discardOverlay = document.querySelector(
    ".discard_spinoff_chapter_overlay"
  );
  const cancelDiscardBtn = document.getElementById("cancelDiscardBtn");
  const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
  const discardChangesBtn = document.getElementById("discardChangesBtn");
  const deleteForm = document.getElementById("deleteOverlayForm");
  const deleteBtn = document.getElementById("spinoff_chapter_delete_btn");
  const spinoffid = document.getElementById("spinoffID_hidden").value;

  if (deleteOverlay) deleteOverlay.style.display = "none";
  if (discardOverlay) discardOverlay.style.display = "none";

  if (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
      showDeleteOverlay();
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

  function showDiscardOverlay() {
    if (discardOverlay) {
      discardOverlay.style.display = "flex";
    }
  }

  document.querySelectorAll(".discard-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showDiscardOverlay();
    });
  });

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

  if (discardChangesBtn) {
    discardChangesBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = "../Overview/" + spinoffid;
    });
  }

  window.addEventListener("click", function (e) {
    if (e.target.classList.contains("overlay-container")) {
      e.target.parentElement.style.display = "none";
    }
  });
});
