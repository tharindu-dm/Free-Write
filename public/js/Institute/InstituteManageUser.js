document.addEventListener("DOMContentLoaded", () => {
  const openPopupBtn = document.getElementById("openPopupBtn");
  const popupForm = document.getElementById("popupForm");
  const closePopupBtn = document.getElementById("closePopupBtn");
  const addUserError = document.getElementById("addUserError");

  const form = document.getElementById("addInstitutionForm");
  const passwordInput = document.getElementById("password");

  // Display the edit user form
  const cancelBtn = document.getElementById("cancel-button"); //in the overlay
  const overlay = document.querySelector(".update-to-list");

  const editUserForm = document.getElementById("editUserForm");

  editUserForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Stop form from submitting immediately

    const userId = document.getElementById("user_update_post").value;
    const newEmail = document.getElementById("user_username").value.trim();

      // Check if the email already exists via AJAX
      fetch(`/Free-Write/public/Institute/checkEmailExists?email=${encodeURIComponent(newEmail)}&userID=${encodeURIComponent(userId)}`)
      .then(response => response.json())
      .then(data => {
        if (data.exists) {
          alert("This email is already taken by another user. Please use a different email.");
        } else {
          editUserForm.submit(); // Safe to submit
        }
      })
      .catch(error => {
        console.error("Error checking email:", error);
        alert("An error occurred. Please try again.");
      });
  });

  //Display the delete user form
  const cancelBtn_delete = document.getElementById("cancel-delete-button"); //in the overlay
  const overlay_delete = document.querySelector(".delete-from-list");

  /////////////////////////////////////////////////////////////////////////////
  //display popups
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

  // Password hashing function
  // function hashPassword(password) {
  //   let hash = 0;
  //   for (let i = 0; i < password.length; i++) {
  //     const char = password.charCodeAt(i);
  //     hash = (hash << 5) - hash + char;
  //     hash = hash & hash; // Convert to 32-bit integer
  //   }
  //   return Math.abs(hash).toString(36);
  // }

  // Form submission validation
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    // If all validations pass, submit the form
    //passwordInput.value = hashPassword(passwordInput.value);
    form.submit();
  });

  ///////////////////////////////////////////////////////////////////////////////////
  // Display the edit user form
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("listEdit-btn")) {
      // Get the parent tr element
      const row = e.target.closest("tr");

      // Get the data from data attributes
      const userId = row.dataset.userId;
      const firstName = row.dataset.userFirstname;
      const lastName = row.dataset.userLastname;
      const userEmail = row.dataset.userEmail;

      // Set the values in the inputs
      const userID_input = document.getElementById("user_update");
      const userID_input_post = document.getElementById("user_update_post");
      const firstName_input = document.getElementById("user_firstName");
      const lastName_input = document.getElementById("user_lastName");
      const userEmail_input = document.getElementById("user_username");

      userID_input.value = userId;
      userID_input_post.value = userId;
      firstName_input.value = firstName;
      lastName_input.value = lastName;
      userEmail_input.value = userEmail;

      // Toggle the overlay display
      overlay.style.display =
        overlay.style.display !== "flex" ? "flex" : "none";
    }
  });

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action

    overlay.style.display = "none";
  });

  ///////////////////////////////////////////////////////////////////////////////////
  //Display the delete user form
  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("listDelete-btn")) {
      // Get the parent tr element
      const row = e.target.closest("tr");

      // Get the data from data attributes
      const userId = row.dataset.userId;

      // Set the values in the inputs
      const userID_input = document.getElementById("user_delete");
      const userID_input_post = document.getElementById("user_delete_post");

      userID_input.value = userId;
      userID_input_post.value = userId;

      // Toggle the overlay display
      overlay_delete.style.display =
        overlay_delete.style.display !== "flex" ? "flex" : "none";
    }
  });

  cancelBtn_delete.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action

    overlay_delete.style.display = "none";
  });
});

document.getElementById('addInstitutionForm').addEventListener('submit', function(e) {
  const password = document.getElementById('password').value;
  if (password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
      e.preventDefault();
      alert("Password must be at least 8 characters long, contain an uppercase letter, and a number.");
  }
});
