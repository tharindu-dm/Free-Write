document.addEventListener("DOMContentLoaded", function () {
  const chapterContent = document.getElementById("chapter-content");
  const wordCountError = document.getElementById("word-count-error");
  const wordCountDisplay = document.getElementById("word-count-display");
  const form = document.getElementById("chapter-form");

  if (chapterContent) {
    chapterContent.style.height = 'auto'; // Reset for proper calculation
    chapterContent.style.height = chapterContent.scrollHeight + 'px'; // Set height based on content
    
    const content = chapterContent.value;
    const wordCount = content.trim().split(/\s+/).length;
    wordCountDisplay.textContent = `${wordCount}/3000 words`;
  }

  // Function to auto-expand the textarea
  chapterContent.addEventListener("input", function () {
    // Reset the height to auto to recalculate
    chapterContent.style.height = "auto";
    // Set the height based on the scrollHeight
    chapterContent.style.height = chapterContent.scrollHeight + "px";

    // Update the word count
    const content = chapterContent.value;
    const wordCount = content.trim().split(/\s+/).length;
    wordCountDisplay.textContent = `${wordCount}/3000 words`;

    // Word count validation
    if (wordCount > 3000) {
      wordCountError.style.display = "block";
      chapterContent.style.borderColor = "#ff6c6c";
    } else {
      wordCountError.style.display = "none";
      chapterContent.style.borderColor = "#ccc";
    }
  });

  // Form submission validation
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
