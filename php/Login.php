<?php

session_start();

require 'database.php';
require 'audit_helper.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "
SELECT *
FROM users
WHERE email = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "s",
    $email
);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $user = $result->fetch_assoc();

    if(
        password_verify(
            $password,
            $user['password']
        )
    ){

        $_SESSION['user_id']
            = $user['id'];

        $_SESSION['role']
            = $user['role'];

        

        $employeeSql = "
        SELECT id
        FROM employees
        WHERE user_id = ?
        ";

        $employeeStmt =
        $conn->prepare($employeeSql);

        $employeeStmt->bind_param(
            "i",
            $user['id']
        );

        $employeeStmt->execute();

        $employeeResult =
        $employeeStmt->get_result();

        $employee =
        $employeeResult->fetch_assoc();

        if($employee){

            $_SESSION['employee_id']
                = $employee['id'];

        }

        echo json_encode([
            "status" => "success",
            "role"   => $user['role']
        ]);
        addAuditLog(
    $conn,
    $user['id'],
    'User Logged In'
);

    }
    else{

        echo json_encode([
            "status"  => "error",
            "message" => "Invalid Password"
        ]);

    }

}
else{

    echo json_encode([
        "status"  => "error",
        "message" => "User Not Found"
    ]);

}