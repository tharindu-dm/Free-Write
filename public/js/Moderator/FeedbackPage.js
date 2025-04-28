function showFeedbackDetails(row) {
  const cells = row.getElementsByTagName("td");

  document.getElementById("FeedbackID").value = cells[0].innerText;
  document.getElementById("userEmail").value = cells[1].innerText;

  let rawDescription = cells[2].innerText;

  let formattedDescription = rawDescription
    .replace(/-body:/i, "Body:\n")
    .replace(/-Recommendation:/i, "\n\nRecommendation: ")
    .trim();

  document.getElementById("FeedbackDescription").value = formattedDescription;
  document.getElementById("Feedbackstatus").value =
    cells[3].innerText.trim() === "Unread" ? "unread" : "read";
}
