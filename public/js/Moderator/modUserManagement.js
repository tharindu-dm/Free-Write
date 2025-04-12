// this is for the when clicked on the row of the table details section to be autofilled
function showReportDetails(row) {
  // Get the cells of the clicked row
  const cells = row.getElementsByTagName("td");

  // Populate the detail section with the row data
  document.getElementById("reportID").value = cells[0].innerText;
  document.getElementById("userEmail").value = cells[1].innerText;
  document.getElementById("reportType").value = cells[2].innerText;
  document.getElementById("reportDescription").value = cells[3].innerText;
  document.getElementById("submitDate").value = cells[4].innerText;
  document.getElementById("reportstatus").value = cells[5].innerText;
  document.getElementById("reportHandler").value = cells[6].innerText;
  //document.getElementById("modResponse").value =  cells[7].innerText == "None" ? "" : cells[7].innerText;

  const fullModResponse = cells[7].querySelector("span").innerText;
  document.getElementById("modResponse").value =
    fullModResponse === "None" ? "" : fullModResponse;
}

/////////////////////////////////////
// update and delete buttons and overlays
const updateModal = document.getElementById("updatePreviewModal");
const deleteModal = document.getElementById("deleteConfirmModal");
const originalForm = document.getElementById("userDetailsForm");
const deleteSubmitBtn = document.getElementById("deleteSubmitBtn");

// Show update preview modal
function showUpdateModal() {
    // Get all form values from the original form
    const formData = new FormData(originalForm);
    
    // Clear existing preview form
    const previewContainer = updateModal.querySelector(".preview-form");
    previewContainer.innerHTML = "";
    
    // Create display-only elements to show the data
    for (let [name, value] of formData.entries()) {
        const displayDiv = document.createElement('div');
        displayDiv.className = 'preview-item';
        
        // Create label
        const label = document.createElement('label');
        label.textContent = name.charAt(0).toUpperCase() + name.slice(1).replace(/([A-Z])/g, ' $1');
        
        // Create display span
        const span = document.createElement('span');
        span.textContent = value;
        span.style.backgroundColor = "#f5f5f5";
        span.style.padding = "5px";
        span.style.display = "block";
        
        // Create hidden input to hold the actual value
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = name;
        hiddenInput.value = value;
        
        displayDiv.appendChild(label);
        displayDiv.appendChild(span);
        displayDiv.appendChild(hiddenInput);
        previewContainer.appendChild(displayDiv);
    }
    
    // Set user name in notice
    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;
    document.getElementById("update-user-name").textContent = `${firstName} ${lastName}`;
    
    // Show the modal
    updateModal.style.display = "block";
    
    // Update the form action
    const modalForm = document.getElementById("updateModalForm");
    modalForm.action = "/Free-Write/public/Mod/UpdateUser";
}

// Show delete confirmation modal
function showDeleteModal() {
  const userId = document.getElementById("userId").value;
  const email = document.getElementById("email").value;
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  const userType = document.querySelector('select[name="userType"]').value;
  const premium = document.getElementById("premium").value;

  document.getElementById("delete-uid").textContent = userId;
  document.getElementById("delete-email").textContent = email;
  document.getElementById("delete-name").textContent =
    firstName + " " + lastName;
  document.getElementById("delete-usertype").textContent = userType;
  document.getElementById("delete-premium").textContent = premium;
  document.getElementById("deleteUserId").value = userId;

  // Reset confirmation text
  document.getElementById("deleteConfirmText").value = "";
  deleteSubmitBtn.disabled = true;

  deleteModal.style.display = "block";
}

function validateDeleteConfirmation() {
  const confirmText = document.getElementById("deleteConfirmText").value;
  deleteSubmitBtn.disabled = confirmText !== "DELETE THIS USER";
}

// Close modals
function closeUpdateModal() {
    updateModal.style.display = "none";
}

function closeDeleteModal() {
    deleteModal.style.display = "none";
    document.getElementById("deleteConfirmText").value = "";
    deleteSubmitBtn.disabled = true;
}

// Add event listeners when page loads
document.addEventListener("DOMContentLoaded", function() {
    const updateButton = document.getElementById("mod-update-user");
    const deleteButton = document.getElementById("mod-delete-user");
    
    if (updateButton) {
        updateButton.addEventListener("click", function(e) {
            e.preventDefault();
            showUpdateModal();
        });
    }
    
    if (deleteButton) {
        deleteButton.addEventListener("click", function(e) {
            e.preventDefault();
            showDeleteModal();
        });
    }
    
    // Close modals when clicking outside
    window.addEventListener("click", function(e) {
        if (e.target === updateModal) {
            closeUpdateModal();
        }
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });
});