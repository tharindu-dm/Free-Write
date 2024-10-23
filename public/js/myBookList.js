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
