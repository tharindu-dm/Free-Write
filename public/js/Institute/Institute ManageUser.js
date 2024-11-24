document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentPage = 1;
    let currentTab = 'all';
    
    // Load initial data
    loadUsers();

    // Event Listeners
    document.getElementById('searchInput').addEventListener('input', debounce(function(e) {
        searchUsers(e.target.value);
    }, 300));

    document.querySelector('.tabs').addEventListener('click', function(e) {
        if (e.target.classList.contains('tab-btn')) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            e.target.classList.add('active');
            currentTab = e.target.dataset.type;
            loadUsers();
        }
    });

    document.querySelector('.pagination').addEventListener('click', function(e) {
        if (e.target.classList.contains('page-number')) {
            currentPage = parseInt(e.target.textContent);
            loadUsers();
        }
    });

    // Modal functionality
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveUserChanges();
    });
});

// Functions
function loadUsers() {
    fetch(`api/users.php?page=${currentPage}&type=${currentTab}`)
        .then(response => response.json())
        .then(data => {
            renderUsers(data.users);
            updatePagination(data.totalPages);
        })
        .catch(error => console.error('Error:', error));
}

function renderUsers(users) {
    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = '';

    users.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <div class="user-profile">
                    <img src="${user.profileImage}" alt="${user.fullName}" class="profile-image">
                </div>
            </td>
            <td>${user.username}</td>
            <td>${user.fullName}</td>
            <td>${user.role}</td>
            <td>${formatDate(user.joinDate)}</td>
            <td>
                <button onclick="editUser(${user.id})" class="edit-btn">Edit</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

function editUser(userId) {
    fetch(`api/users.php?id=${userId}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('userId').value = user.id;
            document.getElementById('username').value = user.username;
            document.getElementById('fullName').value = user.fullName;
            document.getElementById('role').value = user.role;
            document.getElementById('editModal').style.display = "block";
        })
        .catch(error => console.error('Error:', error));
}

function saveUserChanges() {
    const userData = {
        id: document.getElementById('userId').value,
        username: document.getElementById('username').value,
        fullName: document.getElementById('fullName').value,
        role: document.getElementById('role').value
    };

    fetch('api/users.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData)
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('editModal').style.display = "none";
        loadUsers();
    })
    .catch(error => console.error('Error:', error));
}

function searchUsers(query) {
    fetch(`api/users.php?search=${query}`)
        .then(response => response.json())
        .then(data => {
            renderUsers(data.users);
            updatePagination(data.totalPages);
        })
        .catch(error => console.error('Error:', error));
}

function updatePagination(totalPages) {
    const paginationDiv = document.querySelector('.page-numbers');
    paginationDiv.innerHTML = '';
    
    for (let i = 1; i <= totalPages; i++) {
        const span = document.createElement('span');
        span.classList.add('page-number');
        if (i === currentPage) span.classList.add('active');
        span.textContent = i;
        paginationDiv.appendChild(span);
    }
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        month: 'numeric',
        day: 'numeric',
        year: '2-digit'
    });
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// JavaScript for Popup Window
document.addEventListener("DOMContentLoaded", () => {
    const openPopupBtn = document.getElementById("openPopupBtn");
    const popupForm = document.getElementById("popupForm");
    const closePopupBtn = document.getElementById("closePopupBtn");

    openPopupBtn.addEventListener("click", () => {
        popupForm.style.display = "flex";
    });

    closePopupBtn.addEventListener("click", () => {
        popupForm.style.display = "none";
    });

    popupForm.addEventListener("click", (event) => {
        if (event.target === popupForm) {
            popupForm.style.display = "none";
        }
    });
});

