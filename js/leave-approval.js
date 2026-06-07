loadRequests();

function loadRequests(){

    fetch(
        "../php/leave_approval.php?action=get"
    )
    .then(res => res.json())
    .then(showRequests);

}

function showRequests(data){

    let rows = "";

    data.forEach(request => {

        let actionButtons = "";

        if(request.status == "Pending"){

            actionButtons = `
            
            <button
            class="approve-btn"
            onclick="approveLeave(${request.id})">

            Approve

            </button>

            <button
            class="reject-btn"
            onclick="rejectLeave(${request.id})">

            Reject

            </button>

            `;
        }

        rows += `
        
        <tr>

            <td>${request.id}</td>

            <td>${request.employee_name}</td>

            <td>${request.employee_id}</td>

            <td>${request.department}</td>

            <td>${request.leave_name}</td>

            <td>${request.start_date}</td>

            <td>${request.end_date}</td>

            <td>${request.total_days}</td>

            <td>${request.reason}</td>

            <td>${request.status}</td>

            <td>
                ${actionButtons}
            </td>

        </tr>

        `;
    });

    document
    .getElementById("approvalTable")
    .innerHTML = rows;

}
function approveLeave(id){

    Swal.fire({

        title: "Approve Leave?",

        icon: "question",

        showCancelButton: true,

        confirmButtonText: "Approve"

    })

    .then(result => {

        if(result.isConfirmed){

            let formData =
            new FormData();

            formData.append(
                "action",
                "approve"
            );

            formData.append(
                "id",
                id
            );

            fetch(
                "../php/leave_approval.php",
                {
                    method: "POST",
                    body: formData
                }
            )

            .then(res => res.text())

            .then(data => {

                Swal.fire(
                    "Success",
                    data,
                    "success"
                );

                loadRequests();

            });

        }

    });

}
function rejectLeave(id){

    Swal.fire({

        title: "Reject Leave",

        input: "textarea",

        inputLabel: "Remarks",

        inputPlaceholder:
        "Enter rejection remarks",

        showCancelButton: true

    })

    .then(result => {

        if(result.isConfirmed){

            let formData =
            new FormData();

            formData.append(
                "action",
                "reject"
            );

            formData.append(
                "id",
                id
            );

            formData.append(
                "remarks",
                result.value
            );

            fetch(
                "../php/leave_approval.php",
                {
                    method: "POST",
                    body: formData
                }
            )

            .then(res => res.text())

            .then(data => {

                Swal.fire(
                    "Success",
                    data,
                    "success"
                );

                loadRequests();

            });

        }

    });

}
document
.getElementById("search")
.addEventListener("keyup", function(){

    let keyword =
    this.value.toLowerCase();

    let rows =
    document.querySelectorAll(
        "#approvalTable tr"
    );

    rows.forEach(row => {

        row.style.display =
        row.innerText
        .toLowerCase()
        .includes(keyword)

        ? ""

        : "none";

    });

});