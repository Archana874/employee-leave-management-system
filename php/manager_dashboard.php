<?php

require 'database.php';

$response = [];



$sql = "
SELECT COUNT(*) total
FROM leave_requests
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['total'] = $row['total'];




$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Pending'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['pending'] = $row['total'];




$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Approved'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['approved'] = $row['total'];




$sql = "
SELECT COUNT(*) total
FROM leave_requests
WHERE status='Rejected'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$response['rejected'] = $row['total'];




echo json_encode($response);

?>