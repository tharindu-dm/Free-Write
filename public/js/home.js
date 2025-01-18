// script.js
document.addEventListener('DOMContentLoaded', () => {
    // Add smooth scrolling to navigation links
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Add hover effect to feature boxes
    const features = document.querySelectorAll('.feature');
    features.forEach(feature => {
        feature.addEventListener('mouseenter', () => {
            feature.style.transform = 'scale(1.05)';
            feature.style.transition = 'transform 0.3s ease-in-out';
        });
        feature.addEventListener('mouseleave', () => {
            feature.style.transform = 'scale(1)';
        });
    });

    // Add click event to the "Join Freewrite" button
    const joinButton = document.querySelector('.join-btn');
    joinButton.addEventListener('click', () => {
        window.location.href = '/Free-Write/public/Login';
    });
});