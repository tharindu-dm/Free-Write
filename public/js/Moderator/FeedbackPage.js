// this is for the when clicked on the row of the table details section to be autofilled
function showFeedbackDetails(row) {
  // Get the cells of the clicked row
  const cells = row.getElementsByTagName("td");

  // Populate the detail section with the row data
  document.getElementById("FeedbackID").value = cells[0].innerText;
  document.getElementById("userEmail").value = cells[1].innerText;

  let rawDescription = cells[2].innerText;

  // Insert newlines before each dash-keyword pattern
  let formattedDescription = rawDescription
    .replace(/-body:/i, "Body:\n")
    .replace(/-Recommendation:/i, "\n\nRecommendation: ")
    .trim();

  document.getElementById("FeedbackDescription").value = formattedDescription;
  document.getElementById("Feedbackstatus").value =
    cells[3].innerText.trim() === "Unread" ? "unread" : "read";
}
