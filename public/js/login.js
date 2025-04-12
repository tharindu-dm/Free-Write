document.getElementById("sign-up-btn").addEventListener("click", function () {
  swapSignup("signup");
});

document.getElementById("login-btn").addEventListener("click", function () {
  swapSignup("login");
});

function swapSignup(forwardTo) {
  if (forwardTo == "signup") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "block";
    //document.getElementById("institution-form-div").style.display = "none";
  } else if (forwardTo == "login") {
    document.getElementById("login-form-div").style.display = "block";
    document.getElementById("register-form-div").style.display = "none";
  }
}

//REGISTRAION FORM VALIDATION
document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("login-form");
  const registerForm = document.getElementById("register-form");
  const logEmail = document.getElementById("log-email");
  const emailReg = document.getElementById("emailReg");

  const passwordLogin = document.getElementById("log-password");
  const passwordReg = document.getElementById("passwordReg");
  const confpass = document.getElementById("confpass");

  function hashPassword(password) {
    let hash = 0;
    for (let i = 0; i < password.length; i++) {
      const char = password.charCodeAt(i);
      hash = (hash << 5) - hash + char;
      hash = hash & hash; // Convert to 32-bit integer
    }
    return Math.abs(hash).toString(36);
  }

  function checkpwMatch() {
    if (passwordReg.value !== confpass.value) {
      alert("Passwords do not match");
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

  logEmail.addEventListener("change", function () {
    this.style.borderColor = validateEmail(this.value) ? "" : "red";
  });

  emailReg.addEventListener("change", function () {
    this.style.borderColor = validateEmail(this.value) ? "" : "red";
  });

  passwordReg.addEventListener("change", function () {
    this.style.borderColor = checkPassStrength(this.value) ? "" : "red";
  });

  confpass.addEventListener("change", checkpwMatch);

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

  loginForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateEmail(logEmail.value)) {
      passwordLogin.value = hashPassword(passwordLogin.value);
      this.submit();
    } else {
      logEmail.style.borderColor = "red";
    }
  });
});
