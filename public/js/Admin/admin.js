document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname; // Get the current path of the page
  //console.log("outting cp", currentPath);
  const sidebarItems = document.querySelectorAll("#sidebar-nav li");

  sidebarItems.forEach((item) => {
    // Loop through each item in the sidebar and match the url to data-href
    const itemPath = item.getAttribute("data-href");
    //console.log("outting ip", itemPath);
    if (currentPath.endsWith(itemPath)) {
      item.classList.add("active-menu-item");
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const publishForm = document.querySelector(".publish-form");
  const subjectInput = document.querySelector(".subject-input");
  const descriptionInput = document.querySelector(".description-input");
  const checkboxes = document.querySelectorAll(
    '.checkbox-group input[type="checkbox"]'
  );

  publishForm.addEventListener("submit", (e) => {
    // Add event listener to the form
    e.preventDefault();

    const subject = subjectInput.value;
    const description = descriptionInput.value;
    const selectedGroups = Array.from(checkboxes)
      .filter((checkbox) => checkbox.checked)
      .map((checkbox) => checkbox.parentElement.textContent.trim());

    if (subject && description && selectedGroups.length > 0) {
      console.log("Publishing:");
      console.log("Subject:", subject);
      console.log("Description:", description);
      console.log("Selected Groups:", selectedGroups);

      // implement to send this data to the backend
    } else {
      alert("Please fill in all fields and select at least one group.");
    }
  });
});
