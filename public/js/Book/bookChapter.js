document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;
  const chapterLinks = document.querySelectorAll("li a");

  chapterLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPath) {
      link.parentElement.classList.add("active");
    }
  });

  document
    .querySelector(".comment-form")
    .addEventListener("submit", function (e) {
      alert("Comment submitted");
    });
});
