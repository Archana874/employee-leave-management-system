loadLeaveTypes();

function loadLeaveTypes() {

    fetch("../php/leave_type.php?action=get")

        .then(res => res.json())

        .then(showLeaveTypes);

}

function showLeaveTypes(data) {

    let rows = "";

    data.forEach(leave => {

        rows += `
        <tr>

            <td>${leave.id}</td>

            <td>${leave.leave_name}</td>

            <td>${leave.default_allocation}</td>


            <td>

<button
class="btn btn-warning btn-sm action-btn"
onclick="editLeave(
${leave.id},
'${leave.leave_name}',
${leave.default_allocation}
)">
<i class="bi bi-pencil-square"></i>
 Edit
</button>
</td>
        </tr>
        `;
    });

    document
        .getElementById("leaveTable")
        .innerHTML = rows;
}
function editLeave(
    id,
    leaveName,
    allocation
) {

    Swal.fire({

        title: "Edit Leave Type",

        html: `
            <input
                id="leaveName"
                class="swal2-input"
                value="${leaveName}"
                placeholder="Leave Name">

            <input
                id="allocation"
                class="swal2-input"
                type="number"
                value="${allocation}"
                placeholder="Allocation">
        `,

        showCancelButton: true,

        preConfirm: () => {

            return {

                leaveName:
                    document.getElementById("leaveName").value,

                allocation:
                    document.getElementById("allocation").value

            };

        }

    }).then(result => {

        if (result.isConfirmed) {

            let formData =
                new FormData();

            formData.append(
                "action",
                "update"
            );

            formData.append(
                "id",
                id
            );

            formData.append(
                "leave_name",
                result.value.leaveName
            );

            formData.append(
                "allocation",
                result.value.allocation
            );

            fetch(
                "../php/leave_type.php",
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

                    loadLeaveTypes();

                });

        }

    });

}