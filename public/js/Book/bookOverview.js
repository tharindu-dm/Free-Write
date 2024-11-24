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

//Spinoff section redirect
const btn_spinoff_redirect = document.getElementById("btn-create-spinoff");

btn_spinoff_redirect.addEventListener("click", (e) => {
  e.preventDefault();

  //get URL
  const url = new URL(window.location.href);
  //get last part of URL
  const book_id = url.pathname.split("/").pop();
  //redirect to spinoff creation page
  window.location.href = `/Free-Write/public/Spinoff/New/${book_id}`;

});
