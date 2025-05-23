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
                            <div class="time">${record.sentDate || 'Unknown time'}</div>
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
const Notification_toggleBtn = document.getElementById('notification-toggle');
const Notification_overlay = document.getElementById('notification-overlay');
if (Notification_toggleBtn && Notification_overlay) {
    Notification_toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent event bubbling
        Notification_overlay.style.display = Notification_overlay.style.display === 'block' ? 'none' : 'block';
    });

    // Close overlay when clicking outside
    document.addEventListener('click', (e) => {
        if (!Notification_overlay.contains(e.target) && e.target !== Notification_toggleBtn) {
            Notification_overlay.style.display = 'none';
        }
    });
}

// View All button
document.getElementById('view-all-btn').addEventListener('click', () => {
    window.location.href = '/Free-Write/public/User/Notifications';
});

// Mark All as Read (placeholder)
document.getElementById('mark-all-read-btn').addEventListener('click', () => {
    fetch('/Free-Write/public/User/MarkAllRead', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Marked all as read:', data);
        // Update UI by removing the notification badge
    })
    .catch(error => {
        console.error('Error marking all as read:', error);
    });
});



// Initial call and interval
updateNotificationCount();
setInterval(updateNotificationCount, 5000);