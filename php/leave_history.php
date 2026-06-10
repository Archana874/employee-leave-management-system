<?php

require 'database.php';

session_start();

$employeeId = $_SESSION['employee_id'];

$action = $_REQUEST['action'] ?? '';

if($action == 'get'){

    $status = $_GET['status'] ?? '';
    $leaveType = $_GET['leave_type'] ?? '';
    $fromDate = $_GET['from_date'] ?? '';
    $toDate = $_GET['to_date'] ?? '';

    $sql = "
    SELECT
        leave_requests.*,
        leave_types.leave_name
    FROM leave_requests
    INNER JOIN leave_types
    ON leave_requests.leave_type_id = leave_types.id
    WHERE leave_requests.employee_id = '$employeeId'
    ";

    if($status != ''){

        $sql .= "
        AND leave_requests.status = '$status'
        ";
    }
    if($leaveType != ''){

        $sql .= "
        AND leave_types.leave_name = '$leaveType'
        ";
    }

    if($fromDate != ''){

        $sql .= "
        AND leave_requests.start_date >= '$fromDate'
        ";
    }

    if($toDate != ''){

        $sql .= "
        AND leave_requests.end_date <= '$toDate'
        ";
    }
        $sql .= "
        ORDER BY leave_requests.id DESC
        ";

        $result = mysqli_query($conn,$sql);

        $data = [];

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        echo json_encode($data);
    }