document.addEventListener("DOMContentLoaded", function () {
  const deleteCompBtn = document.getElementById("DeleteCompetition");
  const cancelDeleteBtn = document.getElementById("cancelDelete");
  const deleteOverlay = document.querySelector(".deleteOverlay-container");

  // Check if elements exist before adding event listeners
  if (deleteCompBtn && cancelDeleteBtn && deleteOverlay) {
    deleteCompBtn.addEventListener("click", (e) => {
      e.preventDefault();
      deleteOverlay.style.display = "flex";
    });

    cancelDeleteBtn.addEventListener("click", (e) => {
      e.preventDefault();
      deleteOverlay.style.display = "none";
    });
  } else {
   alert("One or more elements not found");
  }
});