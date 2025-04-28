const readingTable = document.getElementById("reading-table");
const completedTable = document.getElementById("completed-table");
const onholdTable = document.getElementById("onhold-table");
const droppedTable = document.getElementById("dropped-table");
const plannedTable = document.getElementById("planned-table");

const readingBtn = document.getElementById("reading-btn");
const completedBtn = document.getElementById("completed-btn");
const onholdBtn = document.getElementById("onhold-btn");
const droppedBtn = document.getElementById("dropped-btn");
const plannedBtn = document.getElementById("planned-btn");

document.addEventListener("DOMContentLoaded", function () {
  const url = window.location.href.split("/");
  const type = url[url.length - 1].split("?")[0];

  console.log("URL type:", window.location.href);
  switchTable(type);
});

let urlFull = new URL(window.location.href);
let segments = urlFull.pathname.split("/");

readingBtn.addEventListener("click", () => {
  segments[4] = "Reading";

  urlFull.pathname = segments.join("/");
  window.location.href = urlFull.toString();
});

completedBtn.addEventListener("click", () => {
  segments[4] = "Completed";

  urlFull.pathname = segments.join("/");
  window.location.href = urlFull.toString();
});

onholdBtn.addEventListener("click", () => {
  segments[4] = "Onhold";

  urlFull.pathname = segments.join("/");
  window.location.href = urlFull.toString();
});

droppedBtn.addEventListener("click", () => {
  segments[4] = "Dropped";

  urlFull.pathname = segments.join("/");
  window.location.href = urlFull.toString();
});

plannedBtn.addEventListener("click", () => {
  segments[4] = "Planned";

  urlFull.pathname = segments.join("/");
  window.location.href = urlFull.toString();
});

function switchTable(type) {
  switch (type) {
    case "Reading":
      readingTable.style.display = "flex";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      readingBtn.style.backgroundColor = "#000000";
      readingBtn.style.color = "#ffd700";

      break;
    case "Completed":
      readingTable.style.display = "none";
      completedTable.style.display = "flex";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      completedBtn.style.backgroundColor = "#000000";
      completedBtn.style.color = "#ffd700";

      break;
    case "Onhold":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "flex";
      droppedTable.style.display = "none";
      plannedTable.style.display = "none";
      onholdBtn.style.backgroundColor = "#000000";
      onholdBtn.style.color = "#ffd700";

      break;
    case "Dropped":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "flex";
      plannedTable.style.display = "none";
      droppedBtn.style.backgroundColor = "#000000";
      droppedBtn.style.color = "#ffd700";

      break;
    case "Planned":
      readingTable.style.display = "none";
      completedTable.style.display = "none";
      onholdTable.style.display = "none";
      droppedTable.style.display = "none";
      plannedTable.style.display = "flex";
      plannedBtn.style.backgroundColor = "#000000";
      plannedBtn.style.color = "#ffd700";

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

const cancelBtn = document.getElementById("cancel-button");
const overlay = document.querySelector(".add-to-list");

document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("listEdit-btn")) {
    const row = e.target.closest("tr");

    const bookId = row.dataset.bookId;
    const bookTitle = row.dataset.bookTitle;
    const chapterCount = row.dataset.chapterProgress;
    const getBookStatus = row.dataset.status;

    const bookID_input = document.getElementById("List_bid");
    const bookTitle_header = document.getElementById("bookTitle-header");
    const chapterCounter = document.getElementById("chapterCount");
    const bookStatus_Select = document.getElementById("status-select");

    bookID_input.value = bookId;
    bookTitle_header.innerHTML = bookTitle;
    chapterCounter.value = chapterCount;
    bookStatus_Select.value = getBookStatus;

    overlay.style.display = overlay.style.display !== "flex" ? "flex" : "none";
  }
});

cancelBtn.addEventListener("click", (e) => {
  e.preventDefault();

  overlay.style.display = "none";
});

const cancelBtn_delete = document.getElementById("cancel-delete-button");
const overlay_delete = document.querySelector(".delete-from-list");

document.addEventListener("click", function (e) {
  if (e.target && e.target.classList.contains("listDelete-btn")) {
    const row = e.target.closest("tr");

    const bookId = row.dataset.bookId;
    const bookTitle = row.dataset.bookTitle;

    const bookID_input = document.getElementById("List_bid_delete");
    const bookTitle_header = document.getElementById("bookTitle-header-delete");

    bookID_input.value = bookId;
    bookTitle_header.innerHTML = bookTitle;

    overlay_delete.style.display =
      overlay_delete.style.display !== "flex" ? "flex" : "none";
  }
});

cancelBtn_delete.addEventListener("click", (e) => {
  e.preventDefault();

  overlay_delete.style.display = "none";
});
