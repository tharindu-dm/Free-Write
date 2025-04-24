// Global variables
let loginAttempts = 0;
const maxAttempts = 3;
let timeoutActive = false;

document.addEventListener("DOMContentLoaded", function () {
  // Form switching functionality
  document.getElementById("sign-up-btn").addEventListener("click", function () {
    swapSignup("signup");
  });

  document.getElementById("login-btn").addEventListener("click", function () {
    swapSignup("login");
  });

  // Form elements
  const loginForm = document.getElementById("login-form");
  const registerForm = document.getElementById("register-form");
  const logEmail = document.getElementById("log-email");
  const emailReg = document.getElementById("emailReg");
  const passwordLogin = document.getElementById("log-password");
  const passwordReg = document.getElementById("passwordReg");
  const confpass = document.getElementById("confpass");

  // Validation functions
  function hashPassword(password) {
    let hash = 0;
    for (let i = 0; i < password.length; i++) {
      const char = password.charCodeAt(i);
      hash = (hash << 5) - hash + char;
      hash = hash & hash;
    }
    return Math.abs(hash).toString(36);
  }

  function checkpwMatch() {
    if (passwordReg.value !== confpass.value) {
      showLoginError("Passwords do not match");
      return false;
    }
    return true;
  }

  function validateEmail(email) {
    const emailRegEx = /\S+@\S+\.\S+/;
    return emailRegEx.test(email);
  }

  function checkPassStrength(password) {
    const passwordRegEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    return passwordRegEx.test(password);
  }

  // Input validation event listeners
  logEmail.addEventListener("change", function () {
    this.style.borderColor = validateEmail(this.value) ? "" : "red";
  });

  emailReg.addEventListener("change", function () {
    this.style.borderColor = validateEmail(this.value) ? "" : "red";
  });

  passwordReg.addEventListener("change", function () {
    this.style.borderColor = checkPassStrength(this.value) ? "" : "red";
    if (!checkPassStrength(this.value)) {
      showLoginError(
        "Password must contain at least 8 characters, including uppercase, lowercase, and numbers"
      );
    }
  });

  confpass.addEventListener("change", checkpwMatch);

  // Register form submission
  registerForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (
      checkpwMatch() &&
      validateEmail(emailReg.value) &&
      checkPassStrength(passwordReg.value)
    ) {
      passwordReg.value = hashPassword(passwordReg.value);
      this.submit();
    }
  });

  // Login form submission
  loginForm.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!validateEmail(logEmail.value)) {
      logEmail.style.borderColor = "red";
      showLoginError("Please enter a valid email address");
      return;
    }

    const hashedPassword = hashPassword(passwordLogin.value);
    const formData = new FormData(this);
    formData.set("log-password", hashedPassword);

    fetch("/Free-Write/public/Login/login", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        switch (data.message) {
          case "user_not_found":
            showLoginError("User not found. Please check your email.");
            break;

          case "invalid_password":
            showLoginError(
              `Invalid password. ${data.remainingAttempts} attempts remaining.`
            );
            break;

          case "account_locked":
            showTimeout(data.remainingTime);
            break;

          case "login_success":
            window.location.href = data.redirect;
            break;

          default:
            showLoginError("An unexpected error occurred.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        showLoginError("An unexpected error occurred.");
      });
  });
});

// Form switching function
function swapSignup(forwardTo) {
  if (forwardTo == "signup") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "block";
  } else if (forwardTo == "login") {
    document.getElementById("login-form-div").style.display = "block";
    document.getElementById("register-form-div").style.display = "none";
  }
}

// Overlay functions
function showLoginError(message) {
  if (!timeoutActive) {
    loginAttempts++;

    const overlay = document.getElementById("loginErrorOverlay");
    const messageElement = overlay.querySelector(".overlay-body p");
    messageElement.textContent = message;
    overlay.classList.add("show");

    setTimeout(() => {
      closeOverlay("loginErrorOverlay");
    }, 3000);
  }
}

function showTimeout(remainingSeconds) {
  timeoutActive = true;
  loginAttempts = 0;

  const overlay = document.getElementById("timeoutOverlay");
  overlay.classList.add("show");

  let timeLeft = remainingSeconds;
  const countdownElement = document.getElementById("countdown");

  if (window.countdownTimer) {
    clearInterval(window.countdownTimer);
  }

  window.countdownTimer = setInterval(() => {
    if (timeLeft <= 0) {
      clearInterval(window.countdownTimer);
      closeOverlay("timeoutOverlay");
      timeoutActive = false;
      return;
    }

    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    countdownElement.textContent = `${minutes}:${seconds
      .toString()
      .padStart(2, "0")}`;
    timeLeft--;
  }, 1000);
}

function closeOverlay(overlayId) {
  const overlay = document.getElementById(overlayId);
  overlay.classList.remove("show");

  if (overlayId === "timeoutOverlay") {
    timeoutActive = false;
    if (window.countdownTimer) {
      clearInterval(window.countdownTimer);
    }
  }
}

// Cleanup function
function cleanup() {
  if (window.countdownTimer) {
    clearInterval(window.countdownTimer);
  }
}

window.addEventListener("unload", cleanup);