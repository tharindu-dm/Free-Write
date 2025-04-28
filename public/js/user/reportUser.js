document.addEventListener("DOMContentLoaded", () => {
  const reportBtn = document.getElementById("reportBtn");
  const reportOverlay = document.getElementById("report-profile");
  const cancelOverlayBtn = document.getElementById("report-cancelOverlayBtn");
  const cancelBtn = document.querySelector(".discard-change-btn");
  const form = document.getElementById("report-profile-form");

  if (reportBtn && reportOverlay) {
    reportBtn.addEventListener("click", (e) => {
      e.preventDefault();
      reportOverlay.style.display =
        reportOverlay.style.display !== "flex" ? "flex" : "none";
    });
  } else {
    console.error("reportBtn or reportOverlay not found in the DOM.");
  }

  cancelOverlayBtn.addEventListener("click", (e) => {
    e.preventDefault();
    reportOverlay.style.display = "none";
  });

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();
    reportOverlay.style.display = "none";
  });

  window.validateForm = function () {
    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const selectReason = document.getElementById("selectReason").value;
    const description = document.getElementById("description").value.trim();
    const email = document.getElementById("email").value.trim();

    if (!firstName) {
      alert("First Name is required.");
      return false;
    }

    if (!lastName) {
      alert("Last Name is required.");
      return false;
    }

    if (selectReason === "") {
      alert("Please select a reason.");
      return false;
    }

    if (description.length > 600) {
      alert("Description cannot exceed 600 characters.");
      return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      return false;
    }

    return true;
  };
});
