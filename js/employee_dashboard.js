loadDashboard();

function loadDashboard() {

    fetch(
        "../php/employee_dashboard.php"
    )
        .then(res => res.json())
        .then(data => {

            document
                .getElementById("totalRequests")
                .innerText =
                data.total_requests;
            document.getElementById("totalRequests").innerText =
                data.total_requests;

            document.getElementById("totalRequestsCount").innerText =
                data.total_requests;

            document
                .getElementById("approvedRequests")
                .innerText =
                data.approved_requests;

            document
                .getElementById("rejectedRequests")
                .innerText =
                data.rejected_requests;

            document
                .getElementById("pendingRequests")
                .innerText =
                data.pending_requests;

            document
                .getElementById("leaveBalance")
                .innerText =
                data.leave_balance;
        });

}
function logout() {

    window.location.href =
        "../php/logout.php";

}