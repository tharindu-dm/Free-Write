// Update the profile statistics when the page loads
document.addEventListener('DOMContentLoaded', () => {
    // Get the profile statistics elements
    const readingCount = document.getElementById('reading-count');
    const completedCount = document.getElementById('completed-count');
    const onHoldCount = document.getElementById('onhold-count');
    const droppedCount = document.getElementById('dropped-count');
    const planToReadCount = document.getElementById('plan-to-read-count');

    // Update the profile statistics
    readingCount.textContent = '15';
    completedCount.textContent = '11';
    onHoldCount.textContent = '10';
    droppedCount.textContent = '7';
    planToReadCount.textContent = '12';

    // Add event listeners for the profile actions
    const editProfileBtn = document.querySelector('.edit-profile-btn');
    const reportBtn = document.querySelector('.report-btn');

    editProfileBtn.addEventListener('click', () => {
        // Handle the edit profile functionality
        console.log('Edit profile button clicked');
    });

    reportBtn.addEventListener('click', () => {
        // Handle the report functionality
        console.log('Report button clicked');
    });
});