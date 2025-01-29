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
// Get modal elements
const updateModal = document.getElementById("updatePreviewModal");
const deleteModal = document.getElementById("deleteConfirmModal");
const originalForm = document.getElementById("userDetailsForm");
const deleteSubmitBtn = document.getElementById("deleteSubmitBtn");

// Show update preview modal
function showUpdateModal() {
  // Clone the form content
  const previewForm = originalForm.cloneNode(true);

  // Set user name in notice
  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  document.getElementById(
    "update-user-name"
  ).textContent = `${firstName} ${lastName}`;

  // Make all inputs readonly
  const inputs = previewForm.getElementsByTagName("input");
  const selects = previewForm.getElementsByTagName("select");
  const textareas = previewForm.getElementsByTagName("textarea");

  for (let input of inputs) {
    const clonedInput = input.cloneNode(true);
    clonedInput.setAttribute("readonly", true);
    clonedInput.style.backgroundColor = "#f5f5f5";
    input.parentNode.replaceChild(clonedInput, input);
  }

  for (let select of selects) {
    const clonedSelect = select.cloneNode(true);
    clonedSelect.setAttribute("disabled", true);
    clonedSelect.style.backgroundColor = "#f5f5f5";
    select.parentNode.replaceChild(clonedSelect, select);
  }

  for (let textarea of textareas) {
    const clonedTextarea = textarea.cloneNode(true);
    clonedTextarea.setAttribute("readonly", true);
    clonedTextarea.style.backgroundColor = "#f5f5f5";
    textarea.parentNode.replaceChild(clonedTextarea, textarea);
  }

  // Remove existing buttons
  const buttonContainer = previewForm.querySelector(".special-btns");
  if (buttonContainer) {
    buttonContainer.remove();
  }

  // Clear existing preview and add new one
  const previewContainer = updateModal.querySelector(".preview-form");
  previewContainer.innerHTML = "";
  previewContainer.appendChild(previewForm);

  updateModal.style.display = "block";
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
document.addEventListener("DOMContentLoaded", function () {
  const updateButton = document.getElementById("mod-update-user");
  const deleteButton = document.getElementById("mod-delete-user");

  if (updateButton) {
    updateButton.addEventListener("click", function (e) {
      e.preventDefault();
      showUpdateModal();
    });
  }

  if (deleteButton) {
    deleteButton.addEventListener("click", function (e) {
      e.preventDefault();
      showDeleteModal();
    });
  }

  // Close modals when clicking outside
  window.addEventListener("click", function (e) {
    if (e.target === updateModal) {
      closeUpdateModal();
    }
    if (e.target === deleteModal) {
      closeDeleteModal();
    }
  });
});
