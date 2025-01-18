document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("institutionSignupForm");
  const institutionNameInput = document.getElementById("institutionName");
  const usernameInput = document.getElementById("username");
  const emaildomainInput = document.getElementById("emaildomain");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmPassword");

  // Validaion function for Institution Name
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

  // Validaion function for Username
  function validateUsername() {
    const username = usernameInput.value.trim();
    const usernameRegex = /^[a-zA-Z0-9_]+$/;

    if (username.length < 4) {
      showError(
        emaildomainInput,
        "Username must be at least 4 characters long"
      );
      return false;
    }

    if (!usernameRegex.test(username)) {
      showError(
        emaildomainInput,
        "Username can only contain letters, numbers, and underscore"
      );
      return false;
    }

    clearError(emaildomainInput);
    return true;
  }

  // Password strrength validation
  function validatePasswordStrength() {
    const password = passwordInput.value;

    // Check length
    if (password.length < 8) {
      showError(passwordInput, "Password must be at least 8 characters long");
      return false;
    }

    // Check complexity
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

  // Confirm password validation
  function validateConfirmPassword() {
    if (passwordInput.value !== confirmPasswordInput.value) {
      showError(confirmPasswordInput, "Passwords do not match");
      return false;
    }

    clearError(confirmPasswordInput);
    return true;
  }

  // Password hashing function
  function hashPassword(password) {
    let hash = 0;
    for (let i = 0; i < password.length; i++) {
      const char = password.charCodeAt(i);
      hash = (hash << 5) - hash + char;
      hash = hash & hash; // Convert to 32-bit integer
    }
    return Math.abs(hash).toString(36);
  }

  // Error display function
  function showError(input, message) {
    // Remove any existing error
    clearError(input);

    // Create error element
    const errorElement = document.createElement("div");
    errorElement.className = "error-message";
    errorElement.textContent = message;

    // Insert error message after input
    input.parentNode.insertBefore(errorElement, input.nextSibling);
    input.classList.add("input-error");
  }

  // Clear error function
  function clearError(input) {
    input.classList.remove("input-error");
    const existingError = input.parentNode.querySelector(".error-message");
    if (existingError) {
      existingError.remove();
    }
  }

  // Real-time validation
  institutionNameInput.addEventListener("input", validateInstitutionName);
  usernameInput.addEventListener("input", validateUsername);
  passwordInput.addEventListener("input", () => {
    validatePasswordStrength();
    validateConfirmPassword();
  });
  confirmPasswordInput.addEventListener("input", validateConfirmPassword);

  // Form submission validation
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const isInstitutionNameValid = validateInstitutionName();
    const isUsernameValid = validateUsername();
    const isPasswordStrong = validatePasswordStrength();
    const isPasswordConfirmed = validateConfirmPassword();

    if (
      isInstitutionNameValid &&
      isUsernameValid &&
      isPasswordStrong &&
      isPasswordConfirmed
    ) {
      
      // If all validations pass, submit the form
      passwordInput.value = hashPassword(passwordInput.value);
      form.submit();
    }
  });
});
