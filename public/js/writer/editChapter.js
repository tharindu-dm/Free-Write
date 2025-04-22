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

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const titleInput = document.getElementById("story-editor-chapter");

    form.addEventListener("submit", (event) => {
        let isValid = true;

        // Validate Title
        if (titleInput.value.trim().length > 45) {
            isValid = false;
            alert("Title must be 45 characters or fewer.");
        }

        // Prevent form submission if any validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
});

