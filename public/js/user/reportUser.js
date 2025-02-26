document.addEventListener("DOMContentLoaded", () => {
  const reportBtn = document.getElementById("reportBtn");
  const reportOverlay = document.getElementById("report-profile");
  const cancelOverlayBtn = document.getElementById("report-cancelOverlayBtn");
  const cancelBtn = document.querySelector(".discard-change-btn");
  const form = document.getElementById("report-profile-form");

  if (reportBtn && reportOverlay) {
    reportBtn.addEventListener("click", (e) => {
      e.preventDefault(); // Prevent the default action
      reportOverlay.style.display =
        reportOverlay.style.display !== "flex" ? "flex" : "none";
    });
  } else {
    console.error("reportBtn or reportOverlay not found in the DOM.");
  }

  // Close the overlay when the cancel/discard button is clicked
  cancelOverlayBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action
    reportOverlay.style.display = "none";
  });

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action
    reportOverlay.style.display = "none";
  });

  // Form validation function
  if (reportBtn && reportOverlay) {
    window.validateForm = function () {
      const firstName = document.getElementById("firstName").value.trim();
      const lastName = document.getElementById("lastName").value.trim();
      const selectReason = document.getElementById("selectReason").value;
      const description = document.getElementById("description").value.trim();
      const email = document.getElementById("email").value.trim();

      // Validate first name
      if (!firstName) {
        alert("First Name is required.");
        return false;
      }

      // Validate last name
      if (!lastName) {
        alert("Last Name is required.");
        return false;
      }

      // Validate reason selection
      if (selectReason === "") {
        alert("Please select a reason.");
        return false;
      }

      // Validate description
      if (description.length > 600) {
        alert("Description cannot exceed 600 characters.");
        return false;
      }

      // Validate email
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }

      return true; // All validations passed
    };
  }
});
