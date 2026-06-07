<?php

require 'database.php';

session_start();

$employeeId = $_SESSION['employee_id'];

$response = [];


/* Total Requests */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE employee_id='$employeeId'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['total_requests'] = $row['total'];


/* Approved Requests */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE employee_id='$employeeId'
AND status='Approved'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['approved_requests'] = $row['total'];


/* Rejected Requests */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE employee_id='$employeeId'
AND status='Rejected'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['rejected_requests'] = $row['total'];


/* Pending Requests */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE employee_id='$employeeId'
AND status='Pending'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['pending_requests'] = $row['total'];


/* Leave Balance */

$sql = "
SELECT
SUM(available_days) AS balance
FROM leave_balance
WHERE employee_id='$employeeId'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['leave_balance'] = $row['balance'];


/* Return JSON */

echo json_encode($response);

?>