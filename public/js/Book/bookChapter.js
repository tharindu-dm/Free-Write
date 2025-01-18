document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".comment-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      alert("Comment submitted");
      this.reset();
    });
});
