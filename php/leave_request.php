<?php

require 'database.php';
require 'audit_helper.php';
session_start();
$employeeId = $_SESSION['employee_id'];

$action = $_REQUEST['action'] ?? '';

if($action == 'getLeaveTypes'){

    $sql = "
    SELECT *
    FROM leave_types
   
    ";

    $result = mysqli_query($conn,$sql);

    $data = [];

    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }

    echo json_encode($data);
}

elseif($action == 'apply'){

   $employeeId = $_SESSION['employee_id'];

    $leaveType = $_POST['leave_type'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $totalDays = $_POST['total_days'];
    $reason = $_POST['reason'];
    if(
        strtotime($startDate)
        <
        strtotime(date('Y-m-d'))
    ){
        echo "Start date cannot be earlier than today";
        exit;
    }
    if(
        strtotime($endDate)
        <
        strtotime($startDate)
    ){
        echo "End date cannot be earlier than Start Date";
        exit;
    }
$balanceSql = "
SELECT available_days
FROM leave_balance
WHERE employee_id='$employeeId'
AND leave_type_id='$leaveType'
";

$balanceResult =
mysqli_query($conn,$balanceSql);

$balance =
mysqli_fetch_assoc($balanceResult);

if(!$balance){

    echo "Leave Balance Not Configured";
    exit;
}

if(
    $totalDays >
    $balance['available_days']
){
    echo "Insufficient Leave Balance";
    exit;
}
   
    $overlapSql = "
    SELECT *
    FROM leave_requests
    WHERE employee_id='$employeeId'
    AND
    (
        '$startDate'
        BETWEEN start_date
        AND end_date

        OR

        '$endDate'
        BETWEEN start_date
        AND end_date
    )
    ";

    $overlapResult =
    mysqli_query($conn,$overlapSql);

    if(
        mysqli_num_rows($overlapResult) > 0
    ){
        echo "Overlapping Leave Exists";
        exit;
    }
$insertSql = "
INSERT INTO leave_requests
(
    employee_id,
    leave_type_id,
    start_date,
    end_date,
    total_days,
    reason
)
VALUES
(
    '$employeeId',
    '$leaveType',
    '$startDate',
    '$endDate',
    '$totalDays',
    '$reason'
)
";

if(mysqli_query($conn, $insertSql)){

    addAuditLog(
        $conn,
        $_SESSION['user_id'],
        'Applied Leave Request'
    );

    echo "Leave Applied Successfully";

}else{

    echo mysqli_error($conn);

}
}