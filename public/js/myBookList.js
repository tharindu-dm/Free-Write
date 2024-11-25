const readingTable = document.getElementById("reading-table");
const completedTable = document.getElementById("completed-table");
const onholdTable = document.getElementById("onhold-table");
const droppedTable = document.getElementById("dropped-table");
const plannedTable = document.getElementById("planned-table");

//button
const readingBtn = document.getElementById("reading-btn");
const completedBtn = document.getElementById("completed-btn");
const onholdBtn = document.getElementById("onhold-btn");
const droppedBtn = document.getElementById("dropped-btn");
const plannedBtn = document.getElementById("planned-btn");

document.addEventListener("DOMContentLoaded", function () {
  const url = window.location.href.split("/");
  const type = url[url.length - 1];
  console.log("URL type:", type); // Debug the extracted type
  switchTable(type);
});

readingBtn.addEventListener("click", () => {
  switchTable("Reading");
});

completedBtn.addEventListener("click", () => {
  switchTable("Completed");
});

onholdBtn.addEventListener("click", () => {
  switchTable("Onhold");
});

droppedBtn.addEventListener("click", () => {
  switchTable("Dropped");
});

plannedBtn.addEventListener("click", () => {
  switchTable("Planned");
});

function switchTable(type) {
  switch (type) {
    case "Reading":
      readingTable.style.display = "flex";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";

      break;
    case "Completed":
      readingTable.style.display = "none";
      completedTable.style.display = "flex";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      break;
    case "Onhold":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "flex";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      break;
    case "Dropped":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "flex";
      plannedTable.style.display = "none";
      break;
    case "Planned":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "flex";
      break;
    default:
      readingTable.style.display = "flex";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      break;
  }
}

///////////////////////////////////////////////////////////////////////////////////
const cancelBtn = document.getElementById("cancel-button"); //in the overlay
const overlay = document.querySelector(".add-to-list");

document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("listEdit-btn")) {
    // Get the parent tr element
    const row = e.target.closest("tr");

    // Get the data from data attributes
    const bookId = row.dataset.bookId;
    const bookTitle = row.dataset.bookTitle;
    const chapterCount = row.dataset.chapterProgress;
    const getBookStatus = row.dataset.status;

    // Set the values in the inputs
    const bookID_input = document.getElementById("List_bid");
    const bookTitle_header = document.getElementById("bookTitle-header");
    const chapterCounter = document.getElementById("chapterCount");
    const bookStatus_Select = document.getElementById("status-select");

    bookID_input.value = bookId;
    bookTitle_header.innerHTML = bookTitle;
    chapterCounter.value = chapterCount;
    bookStatus_Select.value = getBookStatus;

    // Toggle the overlay display
    overlay.style.display = overlay.style.display !== "flex" ? "flex" : "none";
  }
});

cancelBtn.addEventListener("click", (e) => {
  e.preventDefault(); // Prevent the default action

  overlay.style.display = "none";
});

///////////////////////////////////////////////////////////////////////////////////
const cancelBtn_delete = document.getElementById("cancel-delete-button"); //in the overlay
const overlay_delete = document.querySelector(".delete-from-list");

document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("listDelete-btn")) {
    // Get the parent tr element
    const row = e.target.closest("tr");

    // Get the data from data attributes
    const bookId = row.dataset.bookId;
    const bookTitle = row.dataset.bookTitle;

    // Set the values in the inputs
    const bookID_input = document.getElementById("List_bid_delete");
    const bookTitle_header = document.getElementById("bookTitle-header-delete");

    bookID_input.value = bookId;
    bookTitle_header.innerHTML = bookTitle;

    // Toggle the overlay display
    overlay_delete.style.display =
      overlay_delete.style.display !== "flex" ? "flex" : "none";
  }
});

cancelBtn_delete.addEventListener("click", (e) => {
  e.preventDefault(); // Prevent the default action

  overlay_delete.style.display = "none";
});
