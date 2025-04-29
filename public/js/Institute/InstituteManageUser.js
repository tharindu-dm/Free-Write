document.addEventListener("DOMContentLoaded", () => {
  const openPopupBtn = document.getElementById("openPopupBtn");
  const popupForm = document.getElementById("popupForm");
  const closePopupBtn = document.getElementById("closePopupBtn");
  const addUserError = document.getElementById("addUserError");

  const form = document.getElementById("addInstitutionForm");
  const passwordInput = document.getElementById("password");

  const cancelBtn = document.getElementById("cancel-button");
  const overlay = document.querySelector(".update-to-list");

  const editUserForm = document.getElementById("editUserForm");

  editUserForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const userId = document.getElementById("user_update_post").value;
    const newEmail = document.getElementById("user_username").value.trim();

    fetch(
      `/Free-Write/public/Institute/checkEmailExists?email=${encodeURIComponent(
        newEmail
      )}&userID=${encodeURIComponent(userId)}`
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.exists) {
          alert(
            "This email is already taken by another user. Please use a different email."
          );
        } else {
          editUserForm.submit();
          alert("Your email changed successfully.");
        }
      })
      .catch((error) => {
        console.error("Error checking email:", error);
        alert("An error occurred while checking the email. Please try again.");
      });
  });

  const cancelBtn_delete = document.getElementById("cancel-delete-button");
  const overlay_delete = document.querySelector(".delete-from-list");

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

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const password = passwordInput.value;
    if (
      password.length < 8 ||
      !/[A-Z]/.test(password) ||
      !/[0-9]/.test(password)
    ) {
      alert(
        "Password must be at least 8 characters long, contain an uppercase letter, and a number."
      );
      return;
    }

    form.submit();
  });

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("listEdit-btn")) {
      const row = e.target.closest("tr");

      const userId = row.dataset.userId;
      const firstName = row.dataset.userFirstname;
      const lastName = row.dataset.userLastname;
      const userEmail = row.dataset.userEmail;

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

      overlay.style.display =
        overlay.style.display !== "flex" ? "flex" : "none";
    }
  });

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();

    overlay.style.display = "none";
  });

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("listDelete-btn")) {
      const row = e.target.closest("tr");

      const userId = row.dataset.userId;
      const firstName = row.dataset.userFirstname;
      const lastName = row.dataset.userLastname;

      const userID_input = document.getElementById("user_delete");
      const userID_input_post = document.getElementById("user_delete_post");
      const userName_input = document.getElementById("user_name_delete");

      userID_input.value = userId;
      userID_input_post.value = userId;

      userName_input.value = firstName + " " + lastName;

      overlay_delete.style.display =
        overlay_delete.style.display !== "flex" ? "flex" : "none";
    }
  });

  cancelBtn_delete.addEventListener("click", (e) => {
    e.preventDefault();

    overlay_delete.style.display = "none";
  });
});
