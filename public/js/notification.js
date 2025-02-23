function updateNotificationCount() {
    let rawText = '';
    fetch('/Free-Write/public/fetch_notifications.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(text => {
            rawText = text;
            console.log('Raw response:', rawText);
            if (!text || text.trim() === '') {
                throw new Error('Empty response from server');
            }
            const data = JSON.parse(text);
            const badge = document.getElementById('notification-badge');
            const list = document.getElementById('notification-list');
            if (badge) {
                badge.textContent = data.unread_count;
            }
            if (list) {
                list.innerHTML = ''; // Clear existing items
                if (data.records && data.records.length > 0) {
                    data.records.slice(0, 5).forEach(record => { // Limit to 5
                        const item = document.createElement('div');
                        item.className = 'notification-item';
                        item.innerHTML = `
                            <div class="subject">${record.subject || 'No subject'}</div>
                            <div class="time">${record.received_time || 'Unknown time'}</div>
                        `;
                        list.appendChild(item);
                    });
                } else {
                    list.innerHTML = '<p>No unread notifications</p>';
                }
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
            console.log('Raw response causing error:', rawText || 'No response received');
        });
}

// Toggle overlay visibility
const toggleBtn = document.getElementById('notification-toggle');
const overlay = document.getElementById('notification-overlay');
if (toggleBtn && overlay) {
    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent event bubbling
        overlay.style.display = overlay.style.display === 'block' ? 'none' : 'block';
    });

    // Close overlay when clicking outside
    document.addEventListener('click', (e) => {
        if (!overlay.contains(e.target) && e.target !== toggleBtn) {
            overlay.style.display = 'none';
        }
    });
}

// View All button
document.getElementById('view-all-btn').addEventListener('click', () => {
    window.location.href = '/Free-Write/public/Notifications';
});

// Mark All as Read (placeholder)
document.getElementById('mark-all-read-btn').addEventListener('click', () => {
    alert('Mark all as read functionality to be implemented');
    // Add AJAX call here later
});

// Initial call and interval
updateNotificationCount();
setInterval(updateNotificationCount, 5000);
