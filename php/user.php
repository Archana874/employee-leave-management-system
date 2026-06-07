<?php

require 'database.php';

$action = $_REQUEST['action'] ?? '';

if($action == 'add'){

    $employee_id = $_POST['employee_id'];
    $employee_name = $_POST['employee_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $role = $_POST['role'];

    $password =
    password_hash(
        'admin123',
        PASSWORD_DEFAULT
    );

    $sql = "
    INSERT INTO users
    (
        email,
        password,
        role,
        status
    )
    VALUES
    (
        '$email',
        '$password',
        '$role',
        'Active'
    )";

    mysqli_query($conn,$sql);

    $userId = mysqli_insert_id($conn);

    $sql2 = "
    INSERT INTO employees
    (
        user_id,
        employee_id,
        employee_name,
        mobile,
        department,
        designation
    )
    VALUES
    (
        '$userId',
        '$employee_id',
        '$employee_name',
        '$mobile',
        '$department',
        '$designation'
    )";

    mysqli_query($conn,$sql2);
    $employeeDbId = mysqli_insert_id($conn);
    mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',1,12)"
);

mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',2,10)"
);

mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',3,15)"
);

mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',1,12)"
);

mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',2,10)"
);

mysqli_query(
$conn,
"INSERT INTO leave_balance
(employee_id,leave_type_id,available_days)
VALUES
('$employeeDbId',3,15)"
);

    echo "User Added";

}

elseif($action == 'get'){

    $sql = "
    SELECT
    users.id,
    users.role,
    users.status,
    employees.employee_id,
    employees.employee_name,
    employees.department,
    employees.designation,
    employees.mobile
    FROM users
    INNER JOIN employees
    ON users.id = employees.user_id
    ";

    $result = mysqli_query($conn,$sql);

    $users = [];

    while($row =
        mysqli_fetch_assoc($result))
    {
        $users[] = $row;
    }

    echo json_encode($users);

}

elseif($action == 'disable'){

    $id = $_POST['id'];

    $sql = "
    UPDATE users
    SET status='Inactive'
    WHERE id='$id'
    ";

    mysqli_query($conn,$sql);

    echo "User Disabled";

}
elseif($action == 'search'){

    $keyword = $_GET['keyword'];

    $sql = "
SELECT
    users.id,
    users.role,
    users.status,
    employees.employee_id,
    employees.employee_name,
    employees.mobile,
    employees.department,
    employees.designation

FROM users

INNER JOIN employees
ON users.id = employees.user_id

WHERE
employees.employee_name LIKE '%$keyword%'
OR employees.employee_id LIKE '%$keyword%'
OR employees.department LIKE '%$keyword%'
";
    $result =
    mysqli_query($conn,$sql);

    $users = [];

    while(
        $row =
        mysqli_fetch_assoc($result)
    ){
        $users[] = $row;
    }

    echo json_encode($users);

}

elseif($action == 'single'){

    $id = $_GET['id'];

    $sql = "
    SELECT *

    FROM users

    INNER JOIN employees

    ON users.id =
    employees.user_id

    WHERE users.id='$id'
    ";

    $result =
    mysqli_query($conn,$sql);

    echo json_encode(
        mysqli_fetch_assoc($result)
    );

}

elseif($action == 'update'){

    $id = $_POST['id'];

    $employeeQuery = "
    UPDATE employees
    SET
        employee_name = '{$_POST['employee_name']}',
        mobile = '{$_POST['mobile']}',
        department = '{$_POST['department']}',
        designation = '{$_POST['designation']}'
    WHERE user_id = '$id'
    ";
 
    $employeeResult = mysqli_query($conn, $employeeQuery);

    $userQuery = "
    UPDATE users
    SET
        email = '{$_POST['email']}',
        role = '{$_POST['role']}'
    WHERE id = '$id'
    ";

    $userResult = mysqli_query($conn, $userQuery);

    if($employeeResult && $userResult){
        echo "User Updated Successfully";
    } else {
        echo mysqli_error($conn);
    }
}