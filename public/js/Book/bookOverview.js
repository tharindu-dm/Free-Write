const btn_addToList = document.getElementById("btn-addToList");
const cancelBtn = document.getElementById("cancel-button");
const overlay = document.querySelector(".add-to-list");

btn_addToList.addEventListener("click", (e) => {
  e.preventDefault();

  overlay.style.display = overlay.style.display != "flex" ? "flex" : "none";
});

cancelBtn.addEventListener("click", (e) => {
  e.preventDefault();

  overlay.style.display = "none";
});

const btn_spinoff_redirect = document.getElementById("btn-create-spinoff");

btn_spinoff_redirect.addEventListener("click", (e) => {
  e.preventDefault();

  const url = new URL(window.location.href);

  const book_id = url.pathname.split("/").pop();

  window.location.href = `/Free-Write/public/Spinoff/New/${book_id}`;
});

const reviewText = document.getElementById("reviewText");
const feedback = document.getElementById("charFeedback");

reviewText.addEventListener("input", () => {
  const len = reviewText.value.trim().length;

  if (len === 0) {
    feedback.textContent = "";
  } else if (len < 5) {
    feedback.textContent = "Too short – minimum 5 characters required.";
    feedback.style.color = "red";
  } else if (len > 255) {
    feedback.textContent = "Too long – maximum 255 characters allowed.";
    feedback.style.color = "red";
  } else {
    feedback.textContent = "ready to send?";
    feedback.style.color = "green";
  }
});
