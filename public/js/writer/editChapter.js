window.onload = function () {
    const deleteCompBtn = document.getElementById("delete-details");
    const cancelDeleteBtn = document.getElementById("cancelDelete");
    const deleteOverlay = document.querySelector(".deleteOverlay-container");

    if (!deleteCompBtn || !cancelDeleteBtn || !deleteOverlay) {
        console.warn("Missing elements: Check IDs in HTML.");
        return;
    }

    // Show delete confirmation
    deleteCompBtn.addEventListener("click", (e) => {
        e.preventDefault();
        deleteOverlay.style.display = "flex";
    });

    // Hide delete confirmation
    cancelDeleteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        deleteOverlay.style.display = "none";
    });
};

