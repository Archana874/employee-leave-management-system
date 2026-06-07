loadDashboard();

function loadDashboard(){

fetch(
"../php/admin_dashboard.php"
)

.then(res => res.json())

.then(data => {

document.getElementById(
"totalEmployees"
).innerText =
data.totalEmployees;
document.getElementById(
"totalEmployeesCount"
).innerText =
data.totalEmployees;

document.getElementById(
"activeEmployees"
).innerText =
data.activeEmployees;

document.getElementById(
"inactiveEmployees"
).innerText =
data.inactiveEmployees;

document.getElementById(
"totalRequests"
).innerText =
data.totalRequests;

document.getElementById(
"approvedLeaves"
).innerText =
data.approvedLeaves;

document.getElementById(
"rejectedLeaves"
).innerText =
data.rejectedLeaves;

document.getElementById(
"pendingLeaves"
).innerText =
data.pendingLeaves;

});

}
function logout(){

    window.location.href =
    "../php/logout.php";

}