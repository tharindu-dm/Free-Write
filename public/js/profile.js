const reportBtn = document.getElementById('reportBtn');
const profileEditBtn = document.getElementById('profileEditBtn');
const overlay = document.querySelector(".edit-profile");

profileEditBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action
  
    overlay.style.display = overlay.style.display != "flex" ? "flex" : "none";
  });
  
  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default action
  
    overlay.style.display = "none";
  });