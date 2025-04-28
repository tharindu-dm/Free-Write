document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const titleInput = document.getElementById("story-editor-chapter");
    const titleWarning = document.getElementById("title-warning");
    

    form.addEventListener("submit", (event) => {
        let isValid = true;

        // Validate Title
        if (titleInput.value.trim().length > 45) {
            isValid = false;
            titleWarning.style.display = "block"; // ✅ Show warning
        } else {
            titleWarning.style.display = "none"; // ✅ Hide warning if valid
        }

        // Prevent form submission if any validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Optional: Live validation while typing
    titleInput.addEventListener("input", function () {
        if (titleInput.value.trim().length > 45) {
            titleWarning.style.display = "block";
        } else {
            titleWarning.style.display = "none";
        }
    });
});
