const btn_addToList = document.getElementById("btn-addToList");
const cancelBtn = document.getElementById("cancel-button"); //in the overlay
const overlay = document.querySelector(".add-to-list");

btn_addToList.addEventListener("click", (e) => {
  e.preventDefault(); // Prevent the default action

  overlay.style.display = overlay.style.display != "flex" ? "flex" : "none";
});

cancelBtn.addEventListener("click", (e) => {
  e.preventDefault(); // Prevent the default action

  overlay.style.display = "none";
});
