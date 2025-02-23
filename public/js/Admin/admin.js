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
