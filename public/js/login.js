document.getElementById("sign-up-btn").addEventListener("click", function () {
  swapSignup("signup");
});

document.getElementById("login-btn").addEventListener("click", function () {
  swapSignup("login");
});


/*document.getElementById("institution-btn").addEventListener("click", function () {
  swapSignup("instLog");
});*/

function swapSignup(forwardTo) {
  if (forwardTo == "signup") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "block";
    //document.getElementById("institution-form-div").style.display = "none";
  } else if (forwardTo == "login") {
    document.getElementById("login-form-div").style.display = "block";
    document.getElementById("register-form-div").style.display = "none";
    //document.getElementById("institution-form-div").style.display = "none";
  }/* else if (forwardTo == "instLog") {
    document.getElementById("login-form-div").style.display = "none";
    document.getElementById("register-form-div").style.display = "none";
    document.getElementById("institution-form-div").style.display = "block";
  }*/
}

function hashPassword() {
  var password = document.getElementById("passwordREG").value
  var hash = CryptoJS.SHA256.create(password).toString();
  document.getElementById("passwordREG").value = hash;
}

function checkpwMatch(){
  var password = document.getElementById("passwordREG").value
  var password2 = document.getElementById("confpass").value
  if (password != password2){
    alert("Passwords do not match")
    return false
  }
  return true
}

function validateEmail(){
  var email = document.getElementById("emailREG").value
  var emailRegEx = /\S+@\S+\.\S+/;
  if (!emailRegEx.test(email)){
    document.getElementById("log-email").style.borderColor = "red"
    return false
  }
  return true
}

function checkPassStrength(){
  
}