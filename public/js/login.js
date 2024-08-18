document.getElementById("sign-up-btn").addEventListener("click", function () {
  swapSignup("signup");
});

document.getElementById("login-btn").addEventListener("click", function () {
  swapSignup("login");
});

document.getElementById("user-login-btn").addEventListener("click", function () {
  swapSignup("login");
});

document.getElementById("institution-btn").addEventListener("click", function () {
  swapSignup("instLog");
});

function swapSignup(forwardTo) {
  if (forwardTo == "signup") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "block";
    document.getElementById("institution-form-div").style.display = "none";
  } else if (forwardTo == "login") {
    document.getElementById("login-form-div").style.display = "block";
    document.getElementById("register-form-div").style.display = "none";
    document.getElementById("institution-form-div").style.display = "none";
  } else if (forwardTo == "instLog") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "none";
    document.getElementById("institution-form-div").style.display = "block";
  }
}

function hashPassword(password) {
  var hash = CryptoJS.SHA256.create(password).toString();
  return hash;
}
