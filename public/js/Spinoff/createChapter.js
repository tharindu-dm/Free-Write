document.addEventListener("DOMContentLoaded", function () {
  const chapterContent = document.getElementById("chapter-content");
  const wordCountError = document.getElementById("word-count-error");
  const wordCountDisplay = document.getElementById("word-count-display");
  const form = document.getElementById("chapter-form");

  if (chapterContent) {
    chapterContent.style.height = "auto";
    chapterContent.style.height = chapterContent.scrollHeight + "px";

    const content = chapterContent.value;
    const wordCount = content.trim().split(/\s+/).length;
    wordCountDisplay.textContent = `${wordCount}/3000 words`;
  }

  chapterContent.addEventListener("input", function () {
    chapterContent.style.height = "auto";

    chapterContent.style.height = chapterContent.scrollHeight + "px";

    const content = chapterContent.value;
    const wordCount = content.trim().split(/\s+/).length;
    wordCountDisplay.textContent = `${wordCount}/3000 words`;

    if (wordCount > 3000) {
      wordCountError.style.display = "block";
      chapterContent.style.borderColor = "#ff6c6c";
    } else {
      wordCountError.style.display = "none";
      chapterContent.style.borderColor = "#ccc";
    }
  });

  form.addEventListener("submit", function (e) {
    const content = chapterContent.value;
    const wordCount = content.trim().split(/\s+/).length;

    if (wordCount > 3000) {
      e.preventDefault();
      wordCountError.style.display = "block";
      chapterContent.style.borderColor = "#ff6c6c";
    }
  });
});
