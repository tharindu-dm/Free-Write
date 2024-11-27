document.addEventListener("DOMContentLoaded", () => {
  const profileEditBtn = document.getElementById("profileEditBtn");
  const overlay = document.querySelector(".edit-profile");
  const cancelBtn = document.querySelector(".discard-change-btn");
  const editForm = document.getElementById("edit-profile-form");

  profileEditBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action

    overlay.style.display = overlay.style.display != "flex" ? "flex" : "none";
  });

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action

    overlay.style.display = "none";
  });

  /* Edit profile front-end validation */

  editForm.addEventListener("submit", (e) => {
    function validateAge() {
      const dob = document.getElementById("dob");
      const today = new Date();
      const birthDate = new Date(dob.value);
      let age = today.getFullYear() - birthDate.getFullYear();
      const monthDiff = today.getMonth() - birthDate.getMonth();

      if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < birthDate.getDate())
      ) {
        age--;
      }

      if (age < 13) {
        alert("You must be at least 13 years old to register");
        dob.focus();
        return false;
      }
      return true;
    }

    // Validation
    if (!validateAge()) {
      e.preventDefault(); // Prevent form submission
      return;
    }

    const firstName = document.getElementById("firstName");
    const lastName = document.getElementById("lastName");
    const nameRegex = /^[A-Za-z\s]+$/;

    //Full name format check
    if (!nameRegex.test(firstName.value.trim())) {
      alert("First name can only contain letters and spaces");
      firstName.focus();
      e.preventDefault(); // Prevent form submission
      return;
    }

    if (!nameRegex.test(lastName.value.trim())) {
      alert("Last name can only contain letters and spaces");
      lastName.focus();
      e.preventDefault(); // Prevent form submission
      return;
    }

    //bio length check
    const bio = document.getElementById("bio");
    if (bio.value.trim().length > 255) {
      alert("Bio cannot exceed 255 characters");
      bio.focus();
      e.preventDefault(); // Prevent form submission
      return;
    }

    //email validation
    const email = document.getElementById("email");
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value.trim())) {
      alert("Please enter a valid email address");
      email.focus();
      e.preventDefault(); // Prevent form submission
      return;
    }
  });
});
