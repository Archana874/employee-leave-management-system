<?php

require 'database.php';

$action =
$_REQUEST['action'] ?? '';

if($action == 'get'){

    $sql =
    "SELECT * FROM leave_types";

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

elseif($action == 'update'){

    $id =
    $_POST['id'];

    $allocation =
    $_POST['allocation'];

    $sql = "
    UPDATE leave_types

    SET

    default_allocation =
    '$allocation',
    leave_name =
    '{$_POST['leave_name']}'

    WHERE id='$id'
    ";

    mysqli_query($conn,$sql);

    echo "Allocation Updated";

}