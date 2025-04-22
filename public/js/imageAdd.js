document.addEventListener("DOMContentLoaded", () => {
  const dropZone = document.getElementById("drop-zone");
  const fileInput = document.getElementById("PlaceImage");

  dropZone.addEventListener("dragover", (event) => {
    event.preventDefault(); // Prevent default behavior (Prevent file from being opened)
    dropZone.classList.add("drag-over"); // Add class for visual feedback
  });

  dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("drag-over"); // Remove class when dragging leaves
  });

  dropZone.addEventListener("drop", (event) => {
    event.preventDefault(); // Prevent default behavior
    dropZone.classList.remove("drag-over"); // Remove class on drop

    const files = event.dataTransfer.files; // Get dropped files
    if (files.length > 0) {
      fileInput.files = files; // Assign files to the input element
    }
  });
});
