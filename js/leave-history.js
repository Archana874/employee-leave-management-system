loadHistory();

function loadHistory() {

    let status =
        document.getElementById("statusFilter").value;

    let leaveType =
        document.getElementById("leaveTypeFilter").value;

    let fromDate =
        document.getElementById("fromDate").value;

    let toDate =
        document.getElementById("toDate").value;

    fetch(
        "../php/leave_history.php?action=get"
        + "&status=" + status
        + "&leave_type=" + leaveType
        + "&from_date=" + fromDate
        + "&to_date=" + toDate
    )

        .then(res => res.json())
        .then(showHistory);

}

function showHistory(data) {

    let rows = "";

    data.forEach(row => {

        rows += `
        <tr>

            <td>${row.id}</td>

            <td>${row.leave_name}</td>

            <td>${row.start_date}</td>

            <td>${row.end_date}</td>

            <td>${row.total_days}</td>

            <td>${row.created_at}</td>

            <td>
                <span class="${row.status === 'Approved'
                ? 'status-approved'
                : row.status === 'Rejected'
                    ? 'status-rejected'
                    : 'status-pending'
            }">

                ${row.status}

                </span>
            </td>

            <td>${row.manager_remark ?? ''}</td>

        </tr>
        `;

    });

    document
        .getElementById("historyTable")
        .innerHTML = rows;

}

document
    .getElementById("statusFilter")
    .addEventListener("change", loadHistory);

document
    .getElementById("leaveTypeFilter")
    .addEventListener("change", loadHistory);

document
    .getElementById("fromDate")
    .addEventListener("change", loadHistory);

document
    .getElementById("toDate")
    .addEventListener("change", loadHistory);