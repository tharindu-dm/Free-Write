document.getElementById("joinLink").addEventListener("click", function () {
  swapSignup("signup");
});

document.getElementById("loginLink").addEventListener("click", function () {
  swapSignup("login");
});
document.getElementById("instTOread").addEventListener("click", function () {
  swapSignup("login");
});
document.getElementById("instLog").addEventListener("click", function () {
  swapSignup("instLog");
});

function swapSignup(forwardTo) {
  if (forwardTo == "signup") {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "block";
    document.getElementById("inst-form").style.display = "none";
  } else if (forwardTo == "login") {
    document.getElementById("login-form").style.display = "block";
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("inst-form").style.display = "none";
  } else if (forwardTo == "instLog") {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("inst-form").style.display = "block";
  }
}

function hashPassword(password) {
  var hash = CryptoJS.SHA256.create(password).toString();
  return hash;
}
