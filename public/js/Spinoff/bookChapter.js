document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".comment-form")
    .addEventListener("submit", function (e) {
      alert("Comment submitted");
    });
});
