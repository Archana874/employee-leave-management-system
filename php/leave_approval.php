<?php
include 'database.php';
require 'audit_helper.php';

session_start();
$action = $_REQUEST['action'] ?? '';
if($action == 'get'){

$sql = "
SELECT

leave_requests.*,

employees.employee_name,
employees.employee_id,
employees.department,

leave_types.leave_name

FROM leave_requests

INNER JOIN employees
ON leave_requests.employee_id =
employees.id

INNER JOIN leave_types
ON leave_requests.leave_type_id =
leave_types.id

ORDER BY leave_requests.id DESC
";

$result =
mysqli_query($conn,$sql);

$data = [];

while(
$row =
mysqli_fetch_assoc($result)
){
$data[] = $row;
}

echo json_encode($data);

}

elseif($action == 'approve'){

$id = $_POST['id'];

$getSql = "
SELECT *
FROM leave_requests
WHERE id='$id'
";

$request =
mysqli_fetch_assoc(
mysqli_query($conn,$getSql)
);

$approveResult = mysqli_query(
$conn,

"UPDATE leave_requests
SET
status='Approved',
approved_by='{$_SESSION['user_id']}',
approval_date=NOW()
WHERE id='$id'"
);

if($approveResult){

    echo "Update Success";

    addAuditLog(
        $conn,
        $_SESSION['user_id'],
        'Approved Leave ID ' . $id
    );

}
else{

    echo mysqli_error($conn);
    exit;

}

mysqli_query(
$conn,

"UPDATE leave_balance

SET

available_days =
available_days -
{$request['total_days']}

WHERE

employee_id =
{$request['employee_id']}

AND

leave_type_id =
{$request['leave_type_id']}"
);

echo "Leave Approved";

}
elseif($action == 'reject'){

    $id = $_POST['id'];
    $remarks = $_POST['remarks'];

    if(empty($remarks)){
        echo "Remarks Required";
        exit;
    }

    $sql = "
    UPDATE leave_requests
    SET
        status='Rejected',
        manager_remark='$remarks'
    WHERE id='$id'
    ";

    if(mysqli_query($conn, $sql)){

    addAuditLog(
        $conn,
        $_SESSION['user_id'],
        'Rejected Leave ID ' . $id
    );

    echo "Leave Rejected";

}else{

    echo mysqli_error($conn);

}

    exit;
}