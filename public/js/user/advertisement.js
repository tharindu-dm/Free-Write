// // Function to toggle edit mode for the advertisement section
// function toggleEditMode() {
//     document.querySelector('.advertisement-container').classList.add('editing');
//     document.querySelectorAll('.editable').forEach(el => {
//         el.contentEditable = true;
//         el.style.backgroundColor = '#fff8e8';
//     });
//     document.querySelector('.edit-btn').style.display = 'none';
//     document.querySelector('.save-btn').style.display = 'inline-block';
//     document.querySelector('.cancel-btn').style.display = 'inline-block';
// }

// // Function to save changes for the advertisement section
// function saveChanges() {
//     // Get values with null checks
//     const adID = document.querySelector('input[name="adID"]').value;
//     const endDate = document.querySelector('.editable')?.textContent || '';

//     // Create form data
//     const formData = new FormData();
//     formData.append('adID', adID);
//     formData.append('endDate', endDate);

//     // Add console.log to debug
//     console.log('Sending data:', Object.fromEntries(formData));

//     // Send data to the server
//     fetch('/Free-Write/public/Publisher/updateAdvertisement', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log('Response:', data);
//         if (data.status === 'success') {
//             alert('Advertisement updated successfully!');
//             location.reload();
//         } else {
//             alert('Failed to update advertisement.');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// }

// // Function to cancel edit mode for the advertisement section
// function cancelEdit() {
//     document.querySelector('.advertisement-container').classList.remove('editing');
//     document.querySelectorAll('.editable').forEach(el => {
//         el.contentEditable = false;
//         el.style.backgroundColor = 'transparent';
//         // Revert to original content (if needed)
//     });
//     document.querySelector('.edit-btn').style.display = 'inline-block';
//     document.querySelector('.save-btn').style.display = 'none';
//     document.querySelector('.cancel-btn').style.display = 'none';
// }

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
