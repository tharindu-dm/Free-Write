document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;

  const sidebarItems = document.querySelectorAll("#sidebar-nav li");

  sidebarItems.forEach((item) => {
    const itemPath = item.getAttribute("data-href");

    if (currentPath.endsWith(itemPath)) {
      item.classList.add("active-menu-item");
    }
  });
});
