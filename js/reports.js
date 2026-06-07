loadReports();

function loadReports(status = ""){

fetch(
"../php/reports.php?action=get&status="
+ status
)

.then(res => res.json())

.then(showReports);

}

function showReports(data){

let rows = "";

data.forEach(report => {

rows += `
<tr>

<td>${report.employee_name}</td>

<td>${report.employee_id}</td>

<td>${report.department}</td>

<td>${report.leave_name}</td>

<td>${report.start_date}</td>

<td>${report.end_date}</td>

<td>${report.total_days}</td>

<td>${report.status}</td>

<td>${report.approved_by ?? '-'}</td>

<td>${report.approval_date ?? '-'}</td>

<td>${report.manager_remark ?? ''}</td>

</tr>
`;

});

document
.getElementById("reportTable")
.innerHTML = rows;

}

document
.getElementById("statusFilter")
.addEventListener(
"change",
function(){

loadReports(this.value);

});
document
.getElementById("search")
.addEventListener("keyup", function(){

    let keyword =
    this.value.toLowerCase();

    let rows =
    document.querySelectorAll("#reportTable tr");

    rows.forEach(row => {

        row.style.display =
        row.innerText
        .toLowerCase()
        .includes(keyword)

        ? ""

        : "none";

    });

});