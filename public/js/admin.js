document.addEventListener('DOMContentLoaded', () => {
    const publishForm = document.querySelector('.publish-form');
    const subjectInput = document.querySelector('.subject-input');
    const descriptionInput = document.querySelector('.description-input');
    const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]');

    publishForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const subject = subjectInput.value;
        const description = descriptionInput.value;
        const selectedGroups = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.parentElement.textContent.trim());

        if (subject && description && selectedGroups.length > 0) {
            console.log('Publishing:');
            console.log('Subject:', subject);
            console.log('Description:', description);
            console.log('Selected Groups:', selectedGroups);

            // Here you would typically send this data to your backend
            // For now, we'll just reset the form
            publishForm.reset();
        } else {
            alert('Please fill in all fields and select at least one group.');
        }
    });

    // Add active class to the clicked sidebar item
    const sidebarItems = document.querySelectorAll('aside nav ul li');
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            sidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
});