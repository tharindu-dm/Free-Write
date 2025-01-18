document.addEventListener("DOMContentLoaded", function () {
  const deleteCompBtn = document.getElementById("delete-details");
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

  //Spinoff section redirect
  const btn_spinoff_redirect = document.getElementById("btn-create-spinoff");

  btn_spinoff_redirect.addEventListener("click", (e) => {
    e.preventDefault();

    //get URL
    const url = new URL(window.location.href);
    //get last part of URL
    const book_id = url.pathname.split("/").pop();
    //redirect to spinoff creation page
    window.location.href = `/Free-Write/public/Spinoff/New/${book_id}`;
  });
});
