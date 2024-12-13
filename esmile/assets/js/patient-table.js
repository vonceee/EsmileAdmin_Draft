document.addEventListener("DOMContentLoaded", function () {
  fetch("esmile/fetch_patients.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data.error) {
        console.error("Error:", data.error);
        return;
      }

      const table = document.getElementById("patientTable");
      const headers = ["First Name", "Last Name", "Date of Birth", "Mobile Number", "Gender", "Email"];
      const thead = table.createTHead();
      const headerRow = thead.insertRow();
      headers.forEach((header) => {
        const th = document.createElement("th");
        th.textContent = header;
        headerRow.appendChild(th);
      });

      const tbody = table.createTBody();
      data.forEach((row) => {
        const tr = tbody.insertRow();
        Object.values(row).forEach((cellData) => {
          const td = tr.insertCell();
          td.textContent = cellData;
        });
      });

      new simpleDatatables.DataTable("#patientTable");
    })
    .catch((error) => {
      console.error("Fetch Error:", error);
    });
});
