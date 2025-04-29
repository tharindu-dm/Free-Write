document.addEventListener("DOMContentLoaded", () => {
  showSection("pending");
});

function showSection(sectionId) {
  const sections = document.querySelectorAll(".spinoff-section");
  sections.forEach((section) => {
    section.style.display = "none";
    section.classList.remove("active");
  });

  const buttons = document.querySelectorAll(".tab-btn");
  buttons.forEach((button) => {
    button.classList.remove("active");
  });

  const selectedSection = document.getElementById(sectionId);
  if (selectedSection) {
    selectedSection.style.display = "block";
    selectedSection.classList.add("active");
  }

  const activeButton = document.querySelector(
    `.tab-btn[onclick="showSection('${sectionId}')"]`
  );
  if (activeButton) {
    activeButton.classList.add("active");
  }
}
