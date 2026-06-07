<?php

require 'database.php';

/* Total Employees */

$sql = "
SELECT COUNT(*) total
FROM employees
";

$result = mysqli_query($conn, $sql);

$totalEmployees = mysqli_fetch_assoc($result);


/* Active Employees */

$sql = "
SELECT COUNT(*) total
FROM employees e
INNER JOIN users u
ON e.user_id = u.id
WHERE u.status='Active'
";

$result = mysqli_query($conn, $sql);

$activeEmployees = mysqli_fetch_assoc($result);


/* Inactive Employees */

$sql = "
SELECT COUNT(*) total
FROM employees e
INNER JOIN users u
ON e.user_id = u.id
WHERE u.status='Inactive'
";

$result = mysqli_query($conn, $sql);

$inactiveEmployees = mysqli_fetch_assoc($result);


/* Total Requests */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
";

$result = mysqli_query($conn, $sql);

$totalRequests = mysqli_fetch_assoc($result);


/* Approved Leaves */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Approved'
";

$result = mysqli_query($conn, $sql);

$approvedLeaves = mysqli_fetch_assoc($result);


/* Rejected Leaves */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Rejected'
";

$result = mysqli_query($conn, $sql);

$rejectedLeaves = mysqli_fetch_assoc($result);


/* Pending Leaves */

$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Pending'
";

$result = mysqli_query($conn, $sql);

$pendingLeaves = mysqli_fetch_assoc($result);


echo json_encode([

    "totalEmployees"   => $totalEmployees['total'],
    "activeEmployees"  => $activeEmployees['total'],
    "inactiveEmployees"=> $inactiveEmployees['total'],
    "totalRequests"    => $totalRequests['total'],
    "approvedLeaves"   => $approvedLeaves['total'],
    "rejectedLeaves"   => $rejectedLeaves['total'],
    "pendingLeaves"    => $pendingLeaves['total']

]);