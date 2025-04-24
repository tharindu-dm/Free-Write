
// Function to show delete confirmation overlay
function showDeleteConfirmation(adID) {
  const deleteOverlay = document.querySelector(".deleteOverlay-container");
  const adIDLabel = document.getElementById("adID-label");
  const deleteAdIDInput = document.getElementById("deleteAdID");

  // Set the values
  adIDLabel.value = adID;
  deleteAdIDInput.value = adID;

  // Show the overlay
  deleteOverlay.style.display = "flex";
}

// Function to handle delete confirmation
document
  .getElementById("deleteAdForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("/Free-Write/public/Publisher/deleteAdvertisement", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          alert("Advertisement deleted successfully!");
          location.reload();
        } else {
          alert("Failed to delete advertisement.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

function hideDeleteOverlay() {
  document.querySelector(".deleteOverlay-container").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
  const deleteAdBtns = document.querySelectorAll(".delete-btn");
  const deleteOverlay = document.querySelector(".deleteOverlay-container");

  deleteAdBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      deleteOverlay.style.display = "flex";
    });
  });
});

function showEditOverlay(adID, currentDate) {
  document.getElementById("editAdID").value = adID;
  document.getElementById("currentEndDate").value = currentDate;
  document.querySelector(".editOverlay-container").style.display = "flex";
}

function hideEditOverlay() {
  document.querySelector(".editOverlay-container").style.display = "none";
}

// Add click handler to edit buttons
document.querySelectorAll(".edit-btn").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    const row = e.target.closest("tr");
    const adID = row.dataset.adId;
    const currentDate = row.querySelector("td:nth-child(3)").textContent;
    showEditOverlay(adID, currentDate);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const editBtns = document.querySelectorAll(".edit-btn");
  const editOverlay = document.querySelector(".editOverlay-container");

  editBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const row = btn.closest("tr");
      const adID = row.dataset.adId;
      const currentEndDate = row.querySelector("td:nth-child(3)").textContent;

      document.getElementById("editAdID").value = adID;
      document.getElementById("currentEndDate").value = currentEndDate;

      editOverlay.style.display = "flex";
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const editForm = document.querySelector(".editOverlay form");
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    // Add validation logic here
    this.submit();
  });
});
