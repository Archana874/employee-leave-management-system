loadDashboard();

function loadDashboard(){

    fetch("../php/manager_dashboard.php")
    .then(res => res.json())
    .then(data => {

        document.getElementById("totalRequests")
        .innerText = data.total;

        document.getElementById("totalRequestsCount")
        .innerText = data.total;

        document.getElementById("pendingRequests")
        .innerText = data.pending;

        document.getElementById("approvedRequests")
        .innerText = data.approved;

        document.getElementById("rejectedRequests")
        .innerText = data.rejected;

    })
    .catch(error => {
    });

}
function logout(){

    window.location.href =
    "../php/logout.php";

}