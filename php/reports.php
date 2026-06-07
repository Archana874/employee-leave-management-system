<?php

require 'database.php';

$action =
$_REQUEST['action'] ?? '';

if($action == 'get'){

$status =
$_GET['status'] ?? '';

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

";

if($status != ''){

$sql .= "
WHERE leave_requests.status =
'$status'
";

}

$sql .= "
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