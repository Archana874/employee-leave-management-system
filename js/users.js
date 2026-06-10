loadUsers();
document.getElementById("userForm")
    .addEventListener("submit", function (e) {

        e.preventDefault();

        let userId =
            document.getElementById("userId").value;

        let action =
            userId ? "update" : "add";

        let formData = new FormData();

        formData.append("action", action);

        formData.append(
            "id",
            userId
        );

        formData.append(
            "employee_id",
            document.getElementById("employee_id").value
        );

        formData.append(
            "employee_name",
            document.getElementById("employee_name").value
        );

        formData.append(
            "email",
            document.getElementById("email").value
        );

        formData.append(
            "mobile",
            document.getElementById("mobile").value
        );

        formData.append(
            "department",
            document.getElementById("department").value
        );

        formData.append(
            "designation",
            document.getElementById("designation").value
        );

        formData.append(
            "role",
            document.getElementById("role").value
        );

        fetch("../php/user.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.text())
            .then(data => {

                Swal.fire(
                    "Success",
                    data,
                    "success"
                );

                document
                    .getElementById("userForm")
                    .reset();

                document
                    .getElementById("userId")
                    .value = "";

                loadUsers();

            });

    });
function loadUsers() {

    fetch("../php/user.php?action=get")
        .then(res => res.json())
        .then(showUsers);

}

function disableUser(id) {

    let formData = new FormData();

    formData.append("action", "disable");
    formData.append("id", id);

    fetch("../php/user.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.text())
        .then(data => {

            Swal.fire(
                "Success",
                data,
                "success"
            );
            loadUsers();

        });

}
function searchUser() {

    let keyword =
        document.getElementById("search").value;

    fetch(
        "../php/user.php?action=search&keyword="
        + keyword
    )
        .then(res => res.json())
        .then(showUsers);

}

function showUsers(data) {

    let rows = "";

    data.forEach(user => {

        rows += `
        <tr>
            <td>${user.id}</td>
            <td>${user.employee_id}</td>
            <td>${user.employee_name}</td>
            <td>${user.mobile}</td>
            <td>${user.department}</td>
            <td>${user.designation}</td>
            <td>${user.role}</td>
            <td>${user.status}</td>

            <td>

<button
class="edit-btn"
onclick="editUser(${user.id})">
<i class="bi bi-pencil-fill"></i>
Edit
</button>

<button
class="disable-btn"
onclick="disableUser(${user.id})">
<i class="bi bi-x-circle-fill"></i>
Disable
</button>

</td>
        </tr>`;
    });

    document
        .getElementById("userTable")
        .innerHTML = rows;

}
function editUser(id) {

    document.getElementById("formCard")
        .style.display = "block";

    document.getElementById("tableCard")
        .style.display = "none";

    fetch(
        "../php/user.php?action=single&id=" + id
    )
        .then(res => res.json())
        .then(user => {

            document.getElementById("userId").value = user.user_id;
            document.getElementById("employee_id").value = user.employee_id;
            document.getElementById("employee_name").value = user.employee_name;
            document.getElementById("email").value = user.email;
            document.getElementById("mobile").value = user.mobile;
            document.getElementById("department").value = user.department;
            document.getElementById("designation").value = user.designation;

        });

}
document
    .getElementById("search")
    .addEventListener("keyup", function () {

        let keyword = this.value.trim();

        if (keyword === "") {

            loadUsers();
            return;

        }

        fetch(
            "../php/user.php?action=search&keyword="
            + encodeURIComponent(keyword)
        )
            .then(res => res.json())
            .then(showUsers);

    });
function showForm() {

    document.getElementById("formCard")
        .style.display = "block";

    document.getElementById("tableCard")
        .style.display = "none";

    document.getElementById("userForm")
        .reset();

}

function hideForm() {

    document.getElementById("formCard")
        .style.display = "none";

    document.getElementById("tableCard")
        .style.display = "block";

}