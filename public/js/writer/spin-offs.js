        document.addEventListener('DOMContentLoaded', () => {
            // Initialize by showing the pending section
            showSection('pending');
        });

        function showSection(sectionId) {
            // Hide all sections first
            const sections = document.querySelectorAll('.spinoff-section');
            sections.forEach(section => {
                section.style.display = 'none';
                section.classList.remove('active');
            });

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
                selectedSection.classList.add('active');
            }

            // Add active class to the clicked button
            const activeButton = document.querySelector(`.tab-btn[onclick="showSection('${sectionId}')"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }