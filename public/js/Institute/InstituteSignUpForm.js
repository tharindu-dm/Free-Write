document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("institutionSignupForm");
  const institutionNameInput = document.getElementById("institutionName");
  const usernameInput = document.getElementById("username");
  const emaildomainInput = document.getElementById("emaildomain");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmPassword");

  function validateInstitutionName() {
    const institutionName = institutionNameInput.value.trim();
    if (institutionName.length < 3) {
      showError(
        institutionNameInput,
        "Institution name must be at least 3 characters long"
      );
      return false;
    }
    clearError(institutionNameInput);
    return true;
  }

  function validateUsername() {
    const username = usernameInput.value.trim();
    const usernameRegex = /^[a-zA-Z0-9_]+$/;

    if (username.length < 4) {
      showError(usernameInput, "Username must be at least 4 characters long");
      return false;
    }

    if (!usernameRegex.test(username)) {
      showError(
        usernameInput,
        "Username can only contain letters, numbers, and underscore"
      );
      return false;
    }

    clearError(usernameInput);
    return true;
  }

  function validatePasswordStrength() {
    const password = passwordInput.value;

    if (password.length < 8) {
      showError(passwordInput, "Password must be at least 8 characters long");
      return false;
    }

    const strongRegex = new RegExp(
      "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])"
    );
    if (!strongRegex.test(password)) {
      showError(
        passwordInput,
        "Password must include uppercase, lowercase, number, and special character"
      );
      return false;
    }

    clearError(passwordInput);
    return true;
  }

  function validateConfirmPassword() {
    if (passwordInput.value !== confirmPasswordInput.value) {
      showError(confirmPasswordInput, "Passwords do not match");
      return false;
    }

    clearError(confirmPasswordInput);
    return true;
  }

  function showError(input, message) {
    clearError(input);
    const errorElement = document.createElement("div");
    errorElement.className = "error-message";
    errorElement.textContent = message;
    input.parentNode.insertBefore(errorElement, input.nextSibling);
    input.classList.add("input-error");
  }

  function clearError(input) {
    input.classList.remove("input-error");
    const existingError = input.parentNode.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }
  }

  institutionNameInput.addEventListener("input", validateInstitutionName);
  usernameInput.addEventListener("input", validateUsername);
  passwordInput.addEventListener("input", () => {
    validatePasswordStrength();
    validateConfirmPassword();
  });
  confirmPasswordInput.addEventListener("input", validateConfirmPassword);

  form.addEventListener("submit", function (event) {
    const isInstitutionNameValid = validateInstitutionName();
    const isUsernameValid = validateUsername();
    const isPasswordStrong = validatePasswordStrength();
    const isPasswordConfirmed = validateConfirmPassword();

    if (
      !isInstitutionNameValid ||
      !isUsernameValid ||
      !isPasswordStrong ||
      !isPasswordConfirmed
    ) {
      event.preventDefault();
    }
  });
});
