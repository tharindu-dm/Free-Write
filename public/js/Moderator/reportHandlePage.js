function showReportDetails(row) {
  const cells = row.getElementsByTagName("td");

  document.getElementById("reportID").value = cells[0].innerText;
  document.getElementById("userEmail").value = cells[1].innerText;
  document.getElementById("reportType").value = cells[2].innerText;
  document.getElementById("reportDescription").value = cells[3].innerText;
  document.getElementById("submitDate").value = cells[4].innerText;
  document.getElementById("reportstatus").value = cells[5].innerText;
  document.getElementById("reportHandler").value = cells[6].innerText;

  const fullModResponse = cells[7].querySelector("span").innerText;
  document.getElementById("modResponse").value =
    fullModResponse === "None" ? "" : fullModResponse;
}
