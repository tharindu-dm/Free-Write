document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname; // Get current URL path
  const chapterLinks = document.querySelectorAll("li a"); // Get all chapter links

  chapterLinks.forEach((link) => {
    // loop and check if the link's href matches
    if (link.getAttribute("href") === currentPath) {
      link.parentElement.classList.add("active");
    }
  });

  document
    .querySelector(".comment-form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      alert("Comment submitted");
      this.reset();
    });
});
