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