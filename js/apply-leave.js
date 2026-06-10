
loadLeaveTypes();

function loadLeaveTypes() {

    fetch(
        "../php/leave_request.php?action=getLeaveTypes"
    )

        .then(res => res.json())

        .then(data => {

            let options = "";

            data.forEach(type => {

                options += `
<option value="${type.id}">
${type.leave_name}
</option>
`;

            });

            document
                .getElementById("leave_type")
                .innerHTML = options;

        });

}
document
    .getElementById("end_date")
    .addEventListener("change", calculateDays);

document
    .getElementById("start_date")
    .addEventListener("change", calculateDays);

function calculateDays() {

    let start =
        new Date(
            document.getElementById("start_date").value
        );

    let end =
        new Date(
            document.getElementById("end_date").value
        );

    if (start && end) {

        let diff =
            (end - start) / (1000 * 60 * 60 * 24) + 1;

        document
            .getElementById("total_days")
            .value = diff;

    }

}
document
    .getElementById("leaveForm")
    .addEventListener("submit", function (e) {

        e.preventDefault();

        let formData =
            new FormData();

        formData.append(
            "action",
            "apply"
        );

        formData.append(
            "leave_type",
            document.getElementById("leave_type").value
        );

        formData.append(
            "start_date",
            document.getElementById("start_date").value
        );

        formData.append(
            "end_date",
            document.getElementById("end_date").value
        );

        formData.append(
            "total_days",
            document.getElementById("total_days").value
        );

        formData.append(
            "reason",
            document.getElementById("reason").value
        );

        fetch(
            "../php/leave_request.php",
            {
                method: "POST",
                body: formData
            }
        )

            .then(res => res.text())

            .then(data => {

                Swal.fire(
                    "Result",
                    data,
                    "info"
                );

            });

    });