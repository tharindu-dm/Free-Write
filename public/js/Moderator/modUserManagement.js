function showReportDetails(row) {
  const cells = row.getElementsByTagName("td");

  document.getElementById("reportID").value = cells[0].innerText;
  document.getElementById("userEmail").value = cells[1].innerText;
  document.getElementById("reportType").value = cells[2].innerText;
  document.getElementById("reportDescription").value = cells[3].innerText;
  document.getElementById("submitDate").value = cells[4].innerText;
  document.getElementById("reportstatus").value = cells[5].innerText;
  document.getElementById("reportHandler").value = cells[6].innerText;

  const fullModResponse = cells[7].querySelector("span").innerText;
  document.getElementById("modResponse").value =
    fullModResponse === "None" ? "" : fullModResponse;
}

const updateModal = document.getElementById("updatePreviewModal");
const deleteModal = document.getElementById("deleteConfirmModal");
const originalForm = document.getElementById("userDetailsForm");
const deleteSubmitBtn = document.getElementById("deleteSubmitBtn");

function showUpdateModal() {
  const formData = new FormData(originalForm);

  const previewContainer = updateModal.querySelector(".preview-form");
  previewContainer.innerHTML = "";

  for (let [name, value] of formData.entries()) {
    const displayDiv = document.createElement("div");
    displayDiv.className = "preview-item";

    const label = document.createElement("label");
    label.textContent =
      name.charAt(0).toUpperCase() + name.slice(1).replace(/([A-Z])/g, " $1");

    const span = document.createElement("span");
    span.textContent = value;
    span.style.backgroundColor = "#f5f5f5";
    span.style.padding = "5px";
    span.style.display = "block";

    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = name;
    hiddenInput.value = value;

    displayDiv.appendChild(label);
    displayDiv.appendChild(span);
    displayDiv.appendChild(hiddenInput);
    previewContainer.appendChild(displayDiv);
  }

  const firstName = document.getElementById("firstName").value;
  const lastName = document.getElementById("lastName").value;
  document.getElementById(
    "update-user-name"
  ).textContent = `${firstName} ${lastName}`;

  updateModal.style.display = "block";

  const modalForm = document.getElementById("updateModalForm");
  modalForm.action = "/Free-Write/public/Mod/UpdateUser";
}

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

  document.getElementById("deleteConfirmText").value = "";
  deleteSubmitBtn.disabled = true;

  deleteModal.style.display = "block";
}

function validateDeleteConfirmation() {
  const confirmText = document.getElementById("deleteConfirmText").value;
  deleteSubmitBtn.disabled = confirmText !== "DELETE THIS USER";
}

function closeUpdateModal() {
  updateModal.style.display = "none";
}

function closeDeleteModal() {
  deleteModal.style.display = "none";
  document.getElementById("deleteConfirmText").value = "";
  deleteSubmitBtn.disabled = true;
}

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

  window.addEventListener("click", function (e) {
    if (e.target === updateModal) {
      closeUpdateModal();
    }
    if (e.target === deleteModal) {
      closeDeleteModal();
    }
  });
});
