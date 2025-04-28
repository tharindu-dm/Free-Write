document.addEventListener("DOMContentLoaded", function () {
    const deleteBtn = document.getElementById('delete-details');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const deleteOverlay = document.querySelector('.deleteOverlay-container');

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            deleteOverlay.style.display = 'flex';
        });
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function () {
            deleteOverlay.style.display = 'none';
        });
    }
});
